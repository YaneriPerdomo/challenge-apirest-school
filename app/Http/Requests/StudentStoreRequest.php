<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u'
            ],
            'lastname' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u'
            ],
            'gender' => [
                'required',
                'in:M,F'
            ],
            // 'before_contract:1 year ago' evita que la edad calculada sea 0 (fuerza min 1 año)
            'birth' => [
                'required',
                'date',
                'before:today',
                'before:-1 year'
            ],
            // El documento del alumno es opcional, entero y único
            'identity_document' => [
                'nullable',
                'integer',
                'digits_between:5,9',
                'unique:students,identity_document'
            ],
            // El de la madre es obligatorio SOLO si el niño no tiene documento (required_without)
            'mother_s_identity_document' => [
                'required_without:identity_document',
                'nullable',
                'integer',
                'digits_between:5,9'
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.regex' => 'El nombre solo debe contener letras.',
            'lastname.required' => 'El apellido es obligatorio.',
            'lastname.regex' => 'El apellido solo debe contener letras.',
            'gender.required' => 'El género es obligatorio.',
            'gender.in' => 'El género seleccionado no es válido (Debe ser M o F).',

            // Mensajes para Fecha de Nacimiento / Edad
            'birth.required' => 'La fecha de nacimiento es obligatoria.',
            'birth.date' => 'La fecha ingresada no tiene un formato válido.',
            'birth.before' => 'La fecha de nacimiento no puede ser una fecha futura.',
            'birth.before_contract' => 'La edad del alumno no puede ser cero. Debe tener al menos 1 año de edad.',

            // Mensajes para las Cédulas
            'identity_document.integer' => 'La cédula del alumno debe ser un número entero sin puntos ni letras.',
            'identity_document.digits_between' => 'La cédula del alumno debe tener entre 5 y 9 dígitos.',
            'identity_document.unique' => 'Esta cédula de alumno ya se encuentra registrada en el sistema.',

            'mother_s_identity_document.required_without' => 'La cédula de la madre o representante es obligatoria si el alumno no posee documento.',
            'mother_s_identity_document.integer' => 'La cédula de la madre debe ser un número entero.',
            'mother_s_identity_document.digits_between' => 'La cédula de la madre debe tener entre 5 y 9 dígitos.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombres',
            'lastname' => 'apellidos',
            'gender' => 'género',
            'birth' => 'fecha de nacimiento',
            'identity_document' => 'cédula del alumno',
            'mother_s_identity_document' => 'cédula de la madre',
        ];
    }
}


?>
