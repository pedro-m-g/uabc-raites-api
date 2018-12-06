<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterVehicle extends FormRequest
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
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'year' => 'required|numeric|digits:4|min:1950|max:' . (intval(date('Y')) + 1),
            'matricula' => 'required|alpha_num'
        ];
    }

    public function messages()
    {
        return [
            'brand' => 'Por favor ingrese la marca del automóvil',
            'model' => 'Por favor ingrese el modelo del automóvil',
            'year' => 'Por favor introduce el año del automóvil',
            'matricula' => 'Por favor ingrese una matricula válida'
        ];
    }

}
