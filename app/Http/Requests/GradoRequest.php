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
            'nomb_grad' => 'required|min:3|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i|unique:grados,nomb_grad,' . optional($this->route('grado'))->id,
            'abre_grad' => 'required|max:2|regex:/^[a-zA-Z0-9]+$/i',
            'jorn_grad' => 'required|in:'. implode(',', Jornada::indexados()),
        ];
    }
}
