<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateZonaDependenciaRequest extends FormRequest
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
            //'id_zona'=> 'required|numeric|min:1',
            //'nombre_zona' => 'require|string|min:1',
            //'clave_dependencia'=> 'required|string|min:1',
            //'nombre'=> 'required|string|min:1',
        ];
    }

    public function messages()
    {
        return [
            //'id_zona.required' => 'El id de la zona es requerido',
            //'nombre_zona' => 'La zona es requerida',
            //'clave_dependencia'=> 'La clave de la dependencia es requerida',
            //'nombre.required' => 'El nombre es obligatorio',
        ];
    }
}
