<?php

namespace App\Http\Requests;

use Facades\App\Facades\Jornada;
use Illuminate\Foundation\Http\FormRequest;

class CalendarioRequest extends FormRequest
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
            'titu_cale' => 'required|min:3|max:100|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i|unique:calendarios,titu_cale,' . optional($this->route('calendario'))->id,
            'fech_inic' => 'required|date_format:Y-m-d h:i a',
            'fech_fina' => 'required|date_format:Y-m-d h:i a|after_or_equal:fech_inic',
            'jorn_cale' => 'required|in:' . implode(',', jornada('indexados')),
            'desc_cale' => 'required|min:3|max:500|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'fina_cale' => 'required|min:3|max:500|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            // 'administrativo_id' => 'required|string|exists:administrativos,id',
        ];
    }
}
