<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExperienciaEducativaRequest extends FormRequest
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
            'nrc'=> 'required|numeric|min:1',
            'nombre'=> 'required|string|min:1',
            'horas'=> 'required|string|min:1',
        ];
    }

    public function messages()
    {
        return [
          'nrc.required' => 'El NRC de la ExperienciaEducativa es obligatorio',
          'nombre.required' => 'El nombre es obligatorio',
          'horas.required' => 'El número de horas es obligatorio',
        ];
    }

}
