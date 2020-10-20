<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class ExperienciaRequest extends FormRequest
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
            // 'puesto'=>['required'],
            'empresa' => ['required'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date', 'before_or_equal:' . Carbon::now()->toDateString(), 'after:fecha_inicio'],
            'actividades' => ['required'],
        ];
    }
}
