<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
class RegistroRequest extends FormRequest
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
            //
            'nombre'  => ['required'],
            'apellidos' => ['required'],
            'sexo' => ['required'],
            'fecha_nacimiento' => ['required','date','max:'.Carbon::now()->toDateString()],
            'email' => ['required','unique:usuarios,email'],
            'password' => ['required'],
        ];
    }
}
