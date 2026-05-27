<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'names'             => 'required|string|max:90|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/',
            'lastnames'         => 'required|string|max:90|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/',
            'identity_document' => 'required|max:20|unique:teachers,identity_document',
            'gender'            => 'required|in:M,F',
            'subject_id'        => 'required|exists:subjects,subject_id',
        ];
    }

     
    public function messages(): array
    {
        return [
            'names.required'             => 'El nombre del profesor es obligatorio.',
            'names.max'                  => 'El nombre no puede exceder los 90 caracteres.',
            'names.regex'                => 'El nombre solo puede contener letras y espacios, sin números ni caracteres especiales.', // <--- Nueva

            'lastnames.required'         => 'El apellido del profesor es obligatorio.',
            'lastnames.max'              => 'El apellido no puede exceder los 90 caracteres.',
            'lastnames.regex'            => 'El apellido solo puede contener letras y espacios, sin números ni caracteres especiales.', // <--- Nueva

            'identity_document.required' => 'La cédula de identidad es obligatoria.',
            'identity_document.unique'   => 'Esta cédula ya se encuentra registrada en el sistema.',
            'gender.required'            => 'Debe seleccionar el género del profesor.',
            'gender.in'                  => 'El género seleccionado no es válido.',
            'subject_id.required'        => 'Debe asignar una asignatura obligatoriamente.',
            'subject_id.exists'          => 'La asignatura seleccionada no existe en el sistema.',
        ];
    }

    /**
     * Preparar los datos antes de pasar por las reglas de validación.
     * Limpia la cédula extrayendo únicamente los dígitos numéricos.
     */
    protected function prepareForValidation()
    {
        if ($this->has('identity_document')) {
            // Remueve letras, guiones o puntos (Ej: "V-24.123.456" -> "24123456")
            $onlyNumbers = preg_replace('/[^0-9]/', '', $this->identity_document);

            $this->merge([
                'identity_document' => $onlyNumbers ? (int)$onlyNumbers : null,
            ]);
        }
    }
}
