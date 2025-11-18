<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DenunciaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:100',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descripcion' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:150',
            'estado' => [
                'required',
                'string',
                'max:20',
                Rule::in(['pendiente', 'en proceso', 'resuelto']),
            ],
            'ciudadano' => 'required|string|max:100',
            'telefono_ciudadano' => 'required|string|max:15',
            'fecha_registro' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [

            // ----- TITULO -----
            'titulo.required'   => 'El título es obligatorio.',
            'titulo.string'     => 'El título debe ser un texto válido.',
            'titulo.max'        => 'El título no debe superar los 100 caracteres.',

            // ----- DESCRIPCION -----
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string'   => 'La descripción debe ser un texto válido.',
            'descripcion.max'      => 'La descripción no debe superar los 255 caracteres.',

            // ----- UBICACION -----
            'ubicacion.required' => 'La ubicación es obligatoria.',
            'ubicacion.string'   => 'La ubicación debe ser un texto válido.',
            'ubicacion.max'      => 'La ubicación no debe superar los 150 caracteres.',

            // ----- ESTADO -----
            'estado.required' => 'El estado es obligatorio.',
            'estado.string'   => 'El estado debe ser un texto válido.',
            'estado.max'      => 'El estado no debe superar los 20 caracteres.',
            'estado.in'       => 'El estado debe ser "pendiente", "en proceso" o "resuelto".',

            // ----- CIUDADANO -----
            'ciudadano.required' => 'El nombre del ciudadano es obligatorio.',
            'ciudadano.string'   => 'El nombre del ciudadano debe ser un texto válido.',
            'ciudadano.max'      => 'El nombre del ciudadano no debe superar los 100 caracteres.',

            // ----- TELEFONO -----
            'telefono_ciudadano.required' => 'El teléfono del ciudadano es obligatorio.',
            'telefono_ciudadano.string'   => 'El teléfono debe ser un texto válido.',
            'telefono_ciudadano.max'      => 'El teléfono no debe superar los 15 caracteres.',

            // ----- FECHA DE REGISTRO -----
            'fecha_registro.date' => 'La fecha de registro debe ser una fecha válida.',
        ];
    }
}
