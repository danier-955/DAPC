<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Facades\App\Facades\Jornada;

class GradoRequest extends FormRequest
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
            'nomb_grad'     => 'required|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'abre_grad'     => 'required|min:1|max:2|regex:/^[0-9]+$/i',
            'jorn_grad'     => 'required|in:'. implode(',', Jornada::adminIndexados()),
        ];
    }
}
