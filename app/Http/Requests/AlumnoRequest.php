<?php

namespace App\Http\Requests;


use Facades\App\Facades\Sexo;
use Facades\App\Facades\Documento;
use Facades\App\Facades\Parentesco;
use Illuminate\Foundation\Http\FormRequest;

class AlumnoRequest extends FormRequest
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
            'tipo_docu' => 'required|in:'. implode(',', Documento::alumno()),
            'docu_alum' => 'required|min:7|max:10|regex:/^[0-9]+$/i|unique:acudientes,docu_acud,' . optional($this->route('alumno'))->id, 
            'nomb_alum' => 'required|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i', 
            'pape_alum' => 'required|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',  
            'sape_alum' => 'required|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i', 
            'sexo_alum' => 'required|in:'. implode(',', Sexo::indexados()),
            'fech_naci' => 'required|date', 
            'dire_alum' => 'required|min:5|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i', 
            'barr_alum' => 'nullable|min:3|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i', 
            'corr_alum' => 'required|email|max:50|unique:users,email,' . optional(optional($this->route('acudiente'))->user)->id, 
            'tele_alum' => 'required|min:7|max:10|regex:/^[0-9]+$/i', 
            'nomb_acud' => 'required|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i', 
            'pare_acud' => 'required|in:'. implode(',', Parentesco::indexados()),
            'obse_alum' => 'nullable|min:3|max:250|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
        ];
    }
}
