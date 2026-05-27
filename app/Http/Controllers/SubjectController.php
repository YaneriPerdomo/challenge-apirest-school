<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectStoreRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Str;


class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::paginate(5);

        return view(
            'subject.index',
            [
                'subjects' => $subjects,

            ]
        );
    }

    public function indexSearch($searchValue)
    {
        $partsOfSearch = explode('[', $searchValue);
        $cleanFilterValue = str_replace(']', '', $partsOfSearch[1]);
        $subjects = Subject::whereLike('name', '%' . trim($cleanFilterValue) . '%')
            ->orderBy('created_at', 'desc')->paginate(5);

        return view(
            'subject.index',
            [
                'subjects' => $subjects,
                'searchValue' => $cleanFilterValue,
            ]
        );
    }

    public function create()
    {
        return view('subject.create');
    }

    public function store(SubjectStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $slug =  Str::slug($request->name);
            $insert_brand = new Subject();
            $insert_brand->slug = $slug;
            $insert_brand->name = $request->name;
            $insert_brand->description = $request->description;
            $insert_brand->save();
            DB::commit();
            $msg = 'La asignatura "' . $request->name . '" ha sido registrada correctamente.';
            $request->session()->flash('alert-success', $msg);

            return redirect()->route('subject.index');
        } catch (QueryException $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('alert-danger', 'Error de base de datos al registrar: ' . $ex->getMessage());
        } catch (PDOException $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('alert-danger', 'Error de conexión: ' . $ex->getMessage());
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('alert-danger', 'Error inesperado: ' . $ex->getMessage());
        }
    }

    public function edit($slug)
    {
        $subject = Subject::where('slug', $slug)->first();

        if (! $subject) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        return view('subject.edit', ['subject' => $subject]);
    }

    public function update(UpdateSubjectRequest $request, $slug)
    {
        $subject = Subject::where('slug', $slug)->first();

        if (!$subject) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        if (
            Subject::where('name', $request->name)
            ->whereNot('subject_id', $subject->subject_id)->exists()
        ) {
            return redirect()->back()
                ->withInput()
                ->withErrors(
                    [
                        'name' =>
                        'La nombre de la asignatura ya está en uso. Por favor, elige uno diferente'
                    ]
                );
        }


        try {
            DB::beginTransaction();
            $slug =  Str::slug($request->name);
            $insert_brand = Subject::where('slug', $request->slug)->first();
            $insert_brand->slug = $slug;
            $insert_brand->name = $request->name;
            $insert_brand->description = $request->description;
            $insert_brand->save();
            DB::commit();
            $msg = 'La asignatura "' . $request->name . '" ha sido actualizada correctamente.';
            $request->session()->flash('alert-success', $msg);
            return redirect()->route('subject.index');
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
        $subject = Subject::where('slug', $slug)->first();


        if (! $subject) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        $thereAssociateProfessor = [];
        if (Subject::where('slug', $slug)
            ->whereHas('teacher')
            ->exists()
        ) {
            $thereAssociateProfessor = Subject::where('slug', $slug)
                ->whereHas('teacher')
                ->with(['teacher' => function ($query) {
                    return $query;
                }])
                ->first();
        }

        $materia = Subject::where('slug', $slug)->withCount('qualifications')->first();


        $thereAssociateQualifications = $materia ? $materia->qualifications_count : 0;

        return view('subject.delete', ['subject' => $subject, 'thereAssociateProfessor' => $thereAssociateProfessor, 'thereAssociateQualifications' => $thereAssociateQualifications]);
    }

    public function destroy(Request $request, $slug)
    {


        $subject = Subject::where('slug', $slug)->first();
        if (! $subject) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        try {
            $name = $subject->name;
            DB::beginTransaction();
            $subject->delete();
            DB::commit();
            $msg = 'La asignatura "' . $name . '" ha sido eliminada correctamente.';
            $request->session()->flash('alert-success', $msg);
            return redirect()->route('subject.index');
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
