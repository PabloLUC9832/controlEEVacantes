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
            'nPersonal'=> 'nullable|numeric|min:1',
            'nombre'=> 'required|string|min:1',
            'apellidoPaterno'=> 'required|string|min:1',
            'apellidoMaterno'=> 'nullable|string|min:1',
            'email'=> 'nullable|email',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'apellidoPaterno.required' => 'El apellido paterno es obligatorio',
        ];
    }

}
