<?php

namespace App\Http\Requests;

use Facades\App\Facades\Sexo;
use Facades\App\Facades\TipoEstudiante;
use Facades\App\Facades\Documento;
use Illuminate\Foundation\Http\FormRequest;

class AcudienteEstudianteRequest extends FormRequest
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
        $foto_estu = 'required|file|image|max:1024|dimensions:max_width=1000,max_height=1000';
        $copi_docu = 'required|file|mimes:pdf|max:1024';

        if ($this->isMethod('PUT'))
        {
            $foto_estu = str_replace_first('required', 'nullable', $foto_estu);
            $copi_docu = str_replace_first('required', 'nullable', $copi_docu);
        }
        
        return [

            /**
             * Estudiante
             */
            'tipo_docu_estu' => 'required|in:'. implode(',', Documento::tipos()), 
            'docu_estu' => 'required|min:7|max:10|regex:/^[0-9]+$/i|unique:estudiantes,docu_estu,' . optional($this->route('estudiante'))->id, 
            'nomb_estu' => 'required|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i', 
            'pape_estu' => 'required|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',  
            'sape_estu' => 'required|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i', 
            'sexo_estu' => 'required|in:'. implode(',', Sexo::indexados()),
            'fech_naci' => 'required|date',
            'dire_estu' => 'required|min:5|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',  
            'barr_estu' => 'nullable|min:3|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i', 
            'corr_estu' => 'required|email|max:50|unique:users,email,' . optional(optional($this->route('estudiante'))->user)->id, 
            'tele_estu' => 'nullable|min:7|max:10|regex:/^[0-9]+$/i', 
            'padr_estu' => 'required|in:'. implode(',', Parentesco::indexados()), 
            'madr_estu' => 'required|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',  
            'pare_acud' => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',   
            'cole_prov' => 'required|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',   
            'eps_estu'  => 'required|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'copi_docu' => $copi_docu, // 1MB
            'copi_grad' => 'nullable|file|mimes:pdf|max:1024',
            'tipo_estu' => 'required|in:'. implode(',', TipoEstudiante::indexados()),
            'carn_vacu' => 'nullable|file|mimes:pdf|max:1024',
            'foto_estu' => $foto_estu,
            'obse_estu' => 'nullable|min:3|max:250|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',

             /**
             * Sub grado
             */

            'sub_grado_id'  =>'required|string|exists:sub_grados,id', 

            // /**
            //  * Acudientes
            //  */  
            'acudiente_id' =>'nullable|string|exists:acudientes,id', 
            'tipo_docu' => 'nullable|required_if:acudiente_id,|in:'. implode(',', Documento::acudiente()),
            'docu_acud' => 'nullable|required_if:acudiente_id,|min:7|max:10|regex:/^[0-9]+$/i|unique:acudientes,docu_acud,' . optional($this->route('acudiente'))->id, 
            'nomb_acud' => 'nullable|required_if:acudiente_id,|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i', 
            'pape_acud' => 'nullable|required_if:acudiente_id,|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i', 
            'sape_acud' => 'nullable|required_if:acudiente_id,|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'sexo_acud' => 'nullable|required_if:acudiente_id,|in:'. implode(',', Sexo::indexados()),
            'dire_acud' => 'nullable|required_if:acudiente_id,|min:5|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i', 
            'barr_acud' => 'nullable|min:3|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i', 
            'corr_acud' => 'nullable|required_if:acudiente_id,|email|max:50|unique:users,email,' . optional(optional($this->route('acudiente'))->user)->id, 
            'tele_acud' => 'nullable|required_if:acudiente_id,|min:7|max:10|regex:/^[0-9]+$/i', 
            'prof_acud' => 'nullable|required_if:acudiente_id,|min:3|max:100|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            
        ];
    }
}
