<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocenteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nPersonal'=> 'required|numeric|min:1',
            'nombre'=> 'required|string|min:1',
            'apellidoPaterno'=> 'required|string|min:1',
            'apellidoMaterno'=> 'required|string|min:1',
            'email'=> 'nullable|email',
        ];
    }

    public function messages()
    {
        return [
            'nPersonal.required' => 'El número de personal es obligatorio',
            'nombre.required' => 'El nombre es obligatorio',
            'apellidoPaterno.required' => 'El apellido paterno es obligatorio',
            'apellidoMaterno.required' => 'El apellido materno es obligatorio',
        ];
    }

}
