<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class VacanteRequest extends FormRequest
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
            'titulo' => ['required'],
            'empresa' => ['required'],
            'sueldo' => ['required','numeric','gt:0'],
            'sexo' => ['required'],
            'fecha_publicacion' => ['required', 'date'
                // ,'min:'.Carbon::now()->toDateString()
            ],
            'requisitos' => ['required'],
        ];
    }
}
