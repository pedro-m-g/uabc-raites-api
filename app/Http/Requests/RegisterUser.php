<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUser extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'is_driver' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor ingrese su nombre',
            'name.max' => 'Sólo se permiten 255 letras (incluyendo espacios)',
            'email.required' => 'Por favor ingrese su correo electrónico',
            'email.email' => 'El correo electrónico que ingresó no es válido',
            'email.unique' => 'El correo electrónico ya está registrado',
            'password.required' => 'Por favor ingrese una contraseña',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
            'password.confirmed' => 'Falló la confirmación de contraseña',
            'is_driver.required' => 'Por favor seleccione la casilla si es conductor',
            'is_driver.boolean' => 'Por favor seleccione la casilla si es conductor'
        ];
    }

}
