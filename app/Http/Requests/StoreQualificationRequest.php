<?php
 namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class StoreQualificationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        //   Buscamos el ID del estudiante usando el slug de la URL para la regla de unicidad
        $student = DB::table('students')
            ->where('slug', $this->route('slug'))
            ->first();

        $studentId = $student ? $student->student_id : null;

        return [
            'subject_id' => [
                'required',
                'exists:subjects,subject_id', // Verifica que la asignatura exista
                // Evita registros duplicados: valida que la combinación de student_id y subject_id sea única
                Rule::unique('qualifications', 'subject_id')->where(function ($query) use ($studentId) {
                    return $query->where('student_id', $studentId);
                }),
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'subject_id.required' => 'Debe seleccionar una asignatura obligatoriamente.',
            'subject_id.exists'   => 'La asignatura seleccionada no es válida.',
            'subject_id.unique'   => 'Este alumno ya tiene inscrita esta asignatura.',
        ];
    }
}
