<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        return $user && $user->is_driver;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'due_date' => 'required|date|after:' . date('Y-m-d H:i:s'),
            'available_seats' => 'required|integer|min:1|max:6',
            'comments' => 'present',
            'vehicle_id' => 'required|exists:vehicles,id',
            'route_id' => 'required|exists:routes,id'
        ];
    }

    public function messages()
    {
        return [
            'due_date.required' => 'Por favor introduce una fecha',
            'due_date.date' => 'Por favor introduce una fecha válida',
            'due_date.after' => 'La fecha que ingresaste ya pasó',
            'available_seats.required' => 'Por favor dime cuántos asientos disponibles tienes',
            'available_seats.integer' => 'La cantidad de asientos tiene que ser un número',
            'available_seats.min' => 'Para publicar un viaje necesitas al menos un asiento disponible',
            'available_seats.max' => 'El número máximo de asientos',
            'comments' => 'Ingresa un comentario. Puede estar vacío.'
        ];
    }

}
