<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'idZona' => 'required|numeric|min:1',
            'nombreZona' => 'required|string|min:1',
            //'claveDependencia' => 'required|numeric|min:1',
            'clave_dependencia' => [
                'required',
                'numeric',
                'min:1',
                Rule::unique('zona__dependencias')->ignore($this->route('id')),
            ],
            'nombreDependencia' => 'required|string|min:1',
        ];
    }

    public function messages()
    {
        return [
            'idZona.required' => 'El id de la zona es obligatorio',
            'nombreZona.required' => 'El nombre de la zona es obligatorio',
            'clave_dependencia.required' => 'La clave de la dependencia ingresada ya ha sido registrada',
            //'clave_dependencia.unique' => 'La clave de la dependencia ingresada ya ha sido registrada',
            'nombreDependencia.required' => 'El nombre de la dependencia es obligatorio',
        ];
    }
}
