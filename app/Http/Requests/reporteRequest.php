<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class reporteRequest extends FormRequest
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
            'accion' => 'required|in:generar,previsualizacion',
            'inicio' => 'required_if:accion,generar',
            'fin' => 'required_if:accion,generar|after_or_equal:inicio',
        ];
    }
    public function messages()
    {
        return [
            'accion.required' => 'Por favor, seleccione una acción.',
            'inicio.required_if' => 'Por favor, ingrese la fecha de inicio.',
            'fin.required_if' => 'Por favor, ingrese la fecha de fin.',
            'fin.after_or_equal' => 'La fecha de fin debe ser posterior o igual a la fecha de inicio.',
        ];
    }
}
