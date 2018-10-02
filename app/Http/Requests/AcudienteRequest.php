<?php

namespace App\Http\Requests;

use Facades\App\Facades\Sexo;
use Facades\App\Facades\Documento;
use Illuminate\Foundation\Http\FormRequest;

class AcudienteRequest extends FormRequest
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
            'tipo_docu' => 'required|in:'. implode(',', Documento::acudiente()),
            'docu_acud' => 'required|min:7|max:10|regex:/^[0-9]+$/i|unique:acudientes,docu_acud,' . optional($this->route('acudiente'))->id,
            'nomb_acud' => 'required|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'pape_acud' => 'required|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'sape_acud' => 'nullable|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'sexo_acud' => 'required|in:'. implode(',', Sexo::indexados()),
            'dire_acud' => 'required|min:5|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'barr_acud' => 'nullable|min:3|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'corr_acud' => 'required|email|max:50|unique:users,email,' . optional(optional($this->route('acudiente'))->user)->id,
            'tele_acud' => 'required|min:7|max:10|regex:/^[0-9]+$/i',
            'prof_acud' => 'required|min:3|max:100|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
        ];
    }
}
