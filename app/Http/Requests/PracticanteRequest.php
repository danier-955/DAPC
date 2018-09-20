<?php

namespace App\Http\Requests;

use Facades\App\Facades\Documento;
use Facades\App\Facades\Sexo;
use Illuminate\Foundation\Http\FormRequest;

class PracticanteRequest extends FormRequest
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
            'tipo_docu'     => 'required|in:'. implode(',', Documento::tipos()),
            'docu_prac'     => 'required|min:7|max:12|regex:/^[0-9]+$/i|unique:practicantes,docu_prac,' . optional($this->route('practicante'))->id,
            'nomb_prac'     => 'required|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'pape_prac'     => 'required|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'sape_prac'     => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'sexo_prac'     => 'required|in:'. implode(',', Sexo::indexados()),
            'dire_prac'     => 'required|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'barr_prac'     => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'corr_prac'     => 'required|email|max:50|unique:practicantes,corr_prac,' . optional($this->route('practicante'))->id,
            'tele_prac'     => 'nullable|min:7|max:10|regex:/^[0-9]+$/i',
            'padr_prac'     => 'nullable|min:3|max:100|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'madr_prac'     => 'nullable|min:3|max:100|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'cole_prov'     => 'required|min:3|max:100|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'seme_curs'     => 'required|min:1|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'hora_paga'     => 'required|min:2|max:3|regex:/^[0-9]+$/i',
            'inic_prac'     => 'required|date',
            'fina_prac'     => 'required|date|after_or_equal:inic_prac',
            'obse_prac'     => 'nullable|min:3|max:500|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'sub_grado_id'  =>'required|string|exists:sub_grados,id',
        ];
    }
}
