<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectStoreRequest extends FormRequest
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
                'min:3',
                'max:50',
                'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]+$/u',
                'unique:subjects,name',
            ],
            'description' => [
                'nullable',
                'string',
                'max:255'
            ],
        ];
    }

        public function messages(): array
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'name.string'   => 'El :attribute debe ser una cadena de texto.',
            'name.min'      => 'El :attribute debe tener al menos :min caracteres.',
            'name.max'      => 'El :attribute no debe exceder los :max caracteres.',
            'name.regex'    => 'El :attribute solo debe contener letras y espacios (sin caracteres especiales).',
            'name.unique' => 'El :attribute ya se encuentra registrada en el sistema.',

            'description.required' => 'La :attribute es obligatoria.',
            'description.string'   => 'La :attribute debe ser una cadena de texto.',
            'description.max'      => 'La :attribute no debe exceder los :max caracteres.',
        ];
    }


    public function attributes(): array
    {
        return [
            'name'      => 'nombre de la asignatura',
            'description' => 'descripcion de la asignatura',
        ];
    }
}
