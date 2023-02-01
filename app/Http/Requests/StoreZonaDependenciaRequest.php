<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreZonaDependenciaRequest extends FormRequest
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
            'claveDependencia' => 'unique:App\Models\Zona_Dependencia,clave_dependencia|required|numeric|min:1',
            'nombreDependencia' => 'required|string|min:1',
        ];
    }

    public function messages()
    {
        return [
            'idZona.required' => 'El id de la zona es obligatorio',
            'nombreZona.required' => 'El nombre de la zona es obligatorio',
            'claveDependencia.required' => 'La clave de la dependencia es obligatorio',
            'claveDependencia.unique' => 'La clave de la dependencia ingresada ya ha sido registrada',
            'nombreDependencia.required' => 'El nombre de la dependencia es obligatorio',
        ];
    }
}
