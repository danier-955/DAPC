<?php

namespace App\Http\Requests;

use Facades\App\Facades\Sexo;
use Facades\App\Facades\Parentesco;
use Facades\App\Facades\TipoEstudiante;
use Facades\App\Facades\Documento;
use Illuminate\Foundation\Http\FormRequest;

class EstudianteRequest extends FormRequest
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

            /**
             * Estudiante
             */
            'tipo_docu' => 'nullable|in:'. implode(',', Documento::tipos()), 
            'docu_estu' => 'nullable|min:7|max:10|regex:/^[0-9]+$/i|unique:estudiantes,docu_estu,' . optional($this->route('estudiante'))->id, 
            'nomb_estu' => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i', 
            'pape_estu' => 'nullable|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',  
            'sape_estu' => 'nullable|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i', 
            'sexo_estu' => 'nullable|in:'. implode(',', Sexo::indexados()),
            'fech_naci' => 'nullable|date',
            'dire_estu' => 'nullable|min:5|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',  
            'barr_estu' => 'nullable|min:3|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i', 
            'corr_estu' => 'nullable|email|max:50|unique:users,email,' . optional(optional($this->route('estudiante'))->user)->id, 
            'tele_estu' => 'nullable|min:7|max:10|regex:/^[0-9]+$/i', 
            'padr_estu' => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i', 
            'madr_estu' => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',  
            'pare_acud' => 'nullable|in:'. implode(',', Parentesco::indexados()),   
            'cole_prov' => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',   
            'eps_estu'  => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'copi_docu' => 'nullable|file|mimes:pdf|max:1024', // 1MB
            'copi_grad' => 'nullable|file|mimes:pdf|max:1024',
            'tipo_estu' => 'nullable|in:'. implode(',', TipoEstudiante::indexados()),
            'carn_vacu' => 'nullable|file|mimes:pdf|max:1024',
            'foto_estu' => 'nullable|file|image|max:2024|dimensions:max_width=3000,max_height=3000',
            'obse_estu' => 'nullable|min:3|max:250|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',

             /**
             * Sub grado
             */

            'sub_grado_id'  =>'nullable|string|exists:sub_grados,id', 
        ];
    }
}
