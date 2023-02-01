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
            'id_zona' => 'required|string|min:1',
            //'nombreZona' => 'required|string|min:1',
            'claveDependencia' => 'required|numeric|min:1',
            'nombreDependencia' => 'required|string|min:1',
        ];
    }

    public function messages()
    {
        return [
            'id_zona.required' => 'La zona es obligatoria',
            //'nombreZona.required' => 'El nombre de la zona es obligatorio',
            'claveDependencia.required' => 'La clave de la dependencia es obligatorio',
            'nombreDependencia.required' => 'El nombre de la dependencia es obligatorio',
        ];
    }
}
