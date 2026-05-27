<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQualificationRequest;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Qualification;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;
use PhpParser\Node\Stmt\Return_;


class StudentController extends Controller
{
    public function index()
    {
        $students = Student::paginate(5);

        return view(
            'student.index',
            [
                'students' => $students,

            ]
        );
    }

    public function indexSearch($searchValue)
    {
        $partsOfSearch = explode('[', $searchValue);
        $cleanFilterValue = str_replace(']', '', $partsOfSearch[1]);
        $students = Student::whereLike('name', '%' . trim($cleanFilterValue) . '%')
            ->orWhere('lastname', 'like','%' . trim($cleanFilterValue) . '%')
            ->orWhere('identity_document', 'like','%' . trim($cleanFilterValue) . '%')
            ->orWhere('mother_s_identity_document', 'like','%' . trim($cleanFilterValue) . '%')
            ->orderBy('created_at', 'desc')->paginate(5);

        return view(
            'student.index',
            [
                'students' => $students,
                'searchValue' => $cleanFilterValue,
            ]
        );
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(StudentStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $student = new Student();
            $student->name = $request->name;
            $student->lastname = $request->lastname;
            $student->gender = $request->gender;
            $student->birth = $request->birth;




            if (empty($request->identity_document)) {
                $anoNacimiento = date('Y', strtotime($request->birth));

                $student->identity_document = $anoNacimiento . $request->mother_s_identity_document;
            } else {
                $student->identity_document = $request->identity_document;
            }


            $student->mother_s_identity_document = $request->mother_s_identity_document;


            $combinacion = $request->name . ' ' . $request->lastname . ' ' . $student->identity_document;
            $student->slug = converter_slug($combinacion);


            $student->save();

            DB::commit();


            $articulo = $request->gender == 'M' ? 'El alumno "' : 'La alumna "';

            $msg = $articulo . $request->name . ' ' . $request->lastname . '" ha sido registrado correctamente.';
            $request->session()->flash('alert-success', $msg);

            return redirect()->route('student.index');
        } catch (QueryException $ex) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('alert-danger', 'Error de base de datos al registrar: ' . $ex->getMessage());
        } catch (PDOException $ex) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('alert-danger', 'Error de conexión al servidor de datos: ' . $ex->getMessage());
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('alert-danger', 'Ocurrió un error inesperado: ' . $ex->getMessage());
        }
    }

    public function edit($slug)
    {
        $student = Student::where('slug', $slug)->first();

        if (!$student) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        return view('student.edit', ['student' => $student]);
    }

    public function update(UpdateStudentRequest $request, $slug)
    {

        $student = Student::where('slug', $slug)->firstOrFail();


        $identityDocumentResolved = $request->identity_document;
        if (empty($identityDocumentResolved)) {
            $anoNacimiento = date('Y', strtotime($request->birth));
            $identityDocumentResolved = $anoNacimiento . $request->mother_s_identity_document;
        }


        $exists = Student::where('identity_document', $identityDocumentResolved)
            ->whereNot('student_id', $student->student_id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'identity_document' => 'El documento de identidad (o la cédula escolar generada) ya está asignado a otro alumno.'
                ]);
        }

        try {
            DB::beginTransaction();


            $student->name = $request->name;
            $student->lastname = $request->lastname;
            $student->gender = $request->gender;
            $student->birth = $request->birth;
            $student->mother_s_identity_document = $request->mother_s_identity_document;
            $student->identity_document = $identityDocumentResolved;




            $combinacion = $request->name . ' ' . $request->lastname . ' ' . $identityDocumentResolved;
            $student->slug = converter_slug($combinacion);


            $student->save();

            DB::commit();


            $articulo = $request->gender == 'M' ? 'El alumno "' : 'La alumna "';
            $msg = $articulo . $request->name . ' ' . $request->lastname . '" ha sido actualizado correctamente.';

            $request->session()->flash('alert-success', $msg);

            return redirect()->route('student.index');
        } catch (QueryException $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('alert-danger', 'Error de base de datos al actualizar: ' . $ex->getMessage());
        } catch (PDOException $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('alert-danger', 'Error de conexión: ' . $ex->getMessage());
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('alert-danger', 'Error inesperado: ' . $ex->getMessage());
        }
    }

    public function delete($slug)
    {
        $student = Student::where('slug', $slug)->first();

        if (!$student) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        return view('student.delete', ['student' => $student]);
    }

    public function destroy(Request $request, $slug)
    {
        $student = Student::where('slug', $slug)->first();

        if (!$student) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        try {
            $names = $student->name . " " . $student->lastname;
            $articulo = $request->gender == 'M' ? 'El alumno "' . $names . ' ha sido eliminado "' : 'La alumna "' . $names . ' ha sido eliminada"';
            DB::beginTransaction();
            $student->delete();
            DB::commit();

            $msg = $articulo . ' correctamente.';
            $request->session()->flash('alert-success', $msg);
            return redirect()->route('student.index');
        } catch (QueryException $ex) {
            echo $ex->getMessage() . ' ' . $ex->getLine();
        } catch (PDOException $ex) {
            echo $ex->getMessage() . ' ' . $ex->getLine();
        } catch (Exception $ex) {
            echo $ex->getMessage() . ' ' . $ex->getLine();
        }
    }

    public function subjects($slug)
    {

        $student = Student::where('slug', $slug)->first();

        if (!$student) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }


        $subjects = Qualification::with([
            'subject' => function ($query) {
                return $query;
            }
        ])->where('student_id', $student->student_id)

            ->paginate(5);


        return view('student.qualification.index', ['subjects' => $subjects, 'student' => $student, 'slug' => $slug]);
    }

    public function subjectCreate($slug)
    {

        $student = Student::where('slug', $slug)->first();

        if (!$student) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        $materiasSinCalificar = Subject::whereDoesntHave('qualifications', function ($query) use ($student) {
            $query->where('student_id', $student->student_id);
        })
            ->select('subject_id', 'name')
            ->orderBy('name', 'asc')
            ->get();


        return view('student.qualification.create', ['materiasSinCalificar' => $materiasSinCalificar, 'student' => $student]);
    }

    public function subjectStore(StoreQualificationRequest $request, $slug)
    {

        $student = Student::where('slug', $slug)->firstOrFail();

        try {

            $existe = Qualification::where('student_id', $student->student_id)
                ->where('subject_id', $request->subject_id)
                ->exists();

            if ($existe) {
                return back()->with('alert-danger', 'Este alumno ya tiene asignada esa asignatura.');
            }


            $qualification = new Qualification();
            $qualification->student_id = $student->student_id;
            $qualification->subject_id = $request->subject_id;


            $qualification->qualification = Null;


            $qualification->slug = converter_slug($student->slug . ' ' . $qualification->subject->name);



            $qualification->save();

            $subject = Subject::find($request->subject_id);

            $request->session()->flash('alert-success', "La materia \"{$subject->name}\" fue asignada correctamente al estudiante.");


            $routeName = ($student->gender === 'M') ? 'student.subjects-male' : 'student.subjects-female';
            return redirect()->route($routeName, $student->slug);
        } catch (QueryException $ex) {
            return back()->with('alert-danger', 'Error de base de datos al asignar la materia: ' . $ex->getMessage());
        } catch (Exception $ex) {
            return back()->with('alert-danger', 'Ocurrió un error inesperado: ' . $ex->getMessage());
        }
    }
    public function subjectsUpdate(Request $request, $slug,)
    {
        $student = Student::where('slug', $slug)->first();

        if (!$student) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        if (!ctype_digit((string)$request->qualification)) {
            return back()->with('alert-danger', 'La calificación debe ser un número entero válido.');
        }
        try {


            DB::beginTransaction();
            $subject = Qualification::where('qualification_id', $request->qualification_id)
                ->with([
                    'Subject' => function ($query) {
                        return $query;
                    }
                ])
                ->first();
            $subject->qualification = $request->qualification;
            $subject->save();
            DB::commit();


            $subjectName = $subject->subject->name;
            $request->session()->flash('alert-success', "Calificación de la materia \"{$subjectName}\" actualizada. Con una puntuación de \"{$request->qualification}\"");

            $routeName = ($student->gender === 'M')
                ? 'student.subjects-male'
                : 'student.subjects-female';
            return redirect()->route($routeName, ['slug' => $student->slug]);
        } catch (QueryException $ex) {
            echo $ex->getMessage() . ' ' . $ex->getLine();
        } catch (PDOException $ex) {
            echo $ex->getMessage() . ' ' . $ex->getLine();
        } catch (Exception $ex) {
            echo $ex->getMessage() . ' ' . $ex->getLine();
        }
    }

    public function subjectsDelete(Request $request, $slug, $slug_materia, $slug_cali)
    {

        $student = Student::where('slug', $slug)->first();

        if (!$student) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        $subject_cali = Qualification::with([
            'Subject' => function ($query) {
                return $query;
            }
        ])->where('slug', $slug_cali)->first();

        return view('student.qualification.delete', ['subject_cali' => $subject_cali, 'student' => $student]);
    }


    public function subjectsDestroy(Request $request, $slug_student, $slug_cali)
    {
        $student = Student::where('slug', $slug_student)->first();

        if (!$student) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        try {
            DB::beginTransaction();

            // 1. Buscamos la calificación y su asignatura dentro del bloque seguro
            $subject_cali = Qualification::with('Subject')->where('slug', $slug_cali)->first();

            if (!$subject_cali) {
                return back()->with('alert-danger', 'Sucedió un error: El registro de la calificación no existe.');
            }

            // Guardamos el nombre de la materia para el mensaje descriptivo
            $subjectName = $subject_cali->Subject->name ?? 'la asignatura';

            // 2. Ejecutamos la desvinculación/eliminación
            $subject_cali->delete();

            DB::commit();

            // 3. Redacción del mensaje de éxito dinámico y descriptivo
            $article = ($student->gender === 'M') ? 'El alumno' : 'La alumna';
            $gender = $student->gender == 'F' ? 'a' : 'o';
            $msg = "{$article} ha sido retirad\"$gender\" correctamente de la materia \"{$subjectName}\".";

            $request->session()->flash('alert-success', $msg);

            // Determinamos la ruta de regreso según tu lógica de género
            $routeName = ($student->gender === 'M') ? 'student.subjects-male' : 'student.subjects-female';
            return redirect()->route($routeName, $student->slug);
        } catch (QueryException $ex) {
            DB::rollBack();
            return redirect()->back()
                ->with('alert-danger', 'Error de base de datos al retirar la materia: ' . $ex->getMessage());
        } catch (PDOException $ex) {
            DB::rollBack();
            return redirect()->back()
                ->with('alert-danger', 'Error de conexión con el servidor: ' . $ex->getMessage());
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()
                ->with('alert-danger', 'Ocurrió un error inesperado: ' . $ex->getMessage());
        }
    }
}
