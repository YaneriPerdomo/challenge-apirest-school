<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

use DB;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Support\Str;


class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with(['Subject' => function ($query) {
            $query->select('subject_id', 'name');
        }])->paginate(5);

        return view(
            'teacher.index',
            [
                'teachers' => $teachers,

            ]
        );
    }

    public function create()
    {

        $asignaturas = Subject::whereDoesntHave('teacher')
            ->select('subject_id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        return view('teacher.create', ['asignaturas' => $asignaturas]);
    }

    public function indexSearch($searchValue)
    {

        $partsOfSearch = explode('[', $searchValue);
        $cleanFilterValue = str_replace(']', '', $partsOfSearch[1]);

        $teachers = Teacher::whereLike('identity_document', '%' . trim($cleanFilterValue) . '%')
            ->orWhere('names', 'like', '%' . trim($cleanFilterValue) . '%')
            ->orWhere('lastnames', 'like', '%' . trim($cleanFilterValue) . '%')

            ->with(['Subject' => function ($query) {
                $query->select('subject_id', 'name');
            }])
            ->orderBy('created_at', 'desc')

            ->paginate(5);

        return view(
            'teacher.index',
            [
                'teachers' => $teachers,
                'searchValue' => $cleanFilterValue,
            ]
        );
    }

    public function store(StoreTeacherRequest $request)
    {
        try {
            DB::beginTransaction();


            $teacher = new Teacher();
            $teacher->names = $request->names;
            $teacher->lastnames = $request->lastnames;
            $teacher->identity_document = $request->identity_document;
            $teacher->subject_id = $request->subject_id;
            $teacher->gender = $request->gender;
            // Generación del slug único combinando Nombre + Apellido + Cédula
            $combinacion = $request->names . '-' . $request->lastnames . '-' . $request->identity_document;
            $teacher->slug = Str::slug($combinacion);

            $teacher->save();

            DB::commit();


            $art = $request->gender == 'M' ? 'El profesor' : 'La profesora';
            $action = $request->gender == 'M' ? 'registrado' : 'registrada';

            $msg = "{$art} \"{$request->names} {$request->lastnames}\" ha sido {$action} correctamente junto a su asignatura.";
            $request->session()->flash('alert-success', $msg);

            return redirect()->route('teacher.index');
        } catch (QueryException $ex) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('alert-danger', 'Error de base de datos al registrar el profesor: ' . $ex->getMessage());
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


        $teacher = Teacher::where('slug', $slug)->first();

        if (! $teacher) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        $asignaturas = Subject::whereDoesntHave('teacher')
            ->orWhere('subject_id', $teacher->subject_id)
            ->select('subject_id', 'name')
            ->orderBy('name', 'asc')
            ->get();


        return view('teacher.edit', ['asignaturas' => $asignaturas, 'teacher' => $teacher]);
    }


    public function update(UpdateTeacherRequest $request, $slug)
    {
        $teacher = Teacher::where('slug', $slug)->first();

        if (! $teacher) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        try {
            DB::beginTransaction();

            $teacher = Teacher::where('slug', $slug)->firstOrFail();

            $teacher->names = $request->names;
            $teacher->lastnames = $request->lastnames;
            $teacher->identity_document = $request->identity_document;
            $teacher->subject_id = $request->subject_id;
            $teacher->gender = $request->gender;

            $combinacion = $request->names . '-' . $request->lastnames . '-' . $request->identity_document;
            $teacher->slug = Str::slug($combinacion);

            $teacher->save();

            DB::commit();

             $art = $request->gender == 'M' ? 'El profesor' : 'La profesora';
            $action = $request->gender == 'M' ? 'actualizado' : 'actualizada';

            $msg = "{$art} \"{$request->names} {$request->lastnames}\" ha sido {$action} correctamente junto a su asignatura.";

            $request->session()->flash('alert-success', $msg);

            return redirect()->route('teacher.index');
        } catch (QueryException $ex) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('alert-danger', 'Error de base de datos al actualizar el profesor: ' . $ex->getMessage());
        } catch (PDOException $ex) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('alert-danger', 'Error de conexión al servidor de datos: ' . $ex->getMessage());
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('alert-danger', 'Ocurrió un error inesperado al actualizar: ' . $ex->getMessage());
        }
    }
    public function delete($slug)
    {

        $teacher = Teacher::where('slug', $slug)->first();

        if (! $teacher) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        return view('teacher.delete', ['teacher' => $teacher]);
    }

    public function destroy(Request $request, $slug)
    {
        $teacher = Teacher::where('slug', $slug)->first();

        if (! $teacher) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        try {
            $names = $teacher->names . " " . $teacher->lastnames;
            $articulo = $teacher->gender == 'M' ? 'El profesor "' . $names . '" ha sido eliminado ' : 'La profesora "' . $names . '" ha sido eliminada';
            DB::beginTransaction();
            $teacher->delete();
            DB::commit();
            $msg = $articulo . ' correctamente.';
            $request->session()->flash('alert-success', $msg);
            return redirect()->route('teacher.index');
        } catch (QueryException $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('alert-danger', 'Error de base de datos al eliminar: ' . $ex->getMessage());
        } catch (PDOException $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('alert-danger', 'Error de conexión: ' . $ex->getMessage());
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('alert-danger', 'Error inesperado: ' . $ex->getMessage());
        }
    }
}
