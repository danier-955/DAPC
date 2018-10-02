<?php

namespace App\Http\Requests;

use Facades\App\Facades\Sexo;
use Facades\App\Facades\Parentesco;
use Facades\App\Facades\TipoEstudiante;
use Facades\App\Facades\Documento;
use Illuminate\Foundation\Http\FormRequest;

class EstudianteEditRequest extends FormRequest
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
            'tipo_docu' => 'required|in:'. implode(',', Documento::tipos()),
            'docu_estu' => 'required|min:7|max:10|regex:/^[0-9]+$/i|unique:estudiantes,docu_estu,' . optional($this->route('estudiante'))->id,
            'nomb_estu' => 'required|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'pape_estu' => 'required|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'sape_estu' => 'nullable|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'sexo_estu' => 'required|in:'. implode(',', Sexo::indexados()),
            'fech_naci' => 'required|date',
            'dire_estu' => 'required|min:5|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'barr_estu' => 'nullable|min:3|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'corr_estu' => 'required|email|max:50|unique:users,email,' . optional(optional($this->route('estudiante'))->user)->id,
            'tele_estu' => 'nullable|min:7|max:10|regex:/^[0-9]+$/i',
            'padr_estu' => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'madr_estu' => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'pare_acud' => 'required|in:'. implode(',', Parentesco::indexados()),
            'cole_prov' => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'eps_estu'  => 'required|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'copi_docu' => 'required|file|mimes:pdf|max:1024',
            'copi_grad' => 'nullable|file|mimes:pdf|max:1024',
            'tipo_estu' => 'required|in:'. implode(',', TipoEstudiante::indexados()),
            'carn_vacu' => 'nullable|file|mimes:pdf|max:1024',
            'foto_estu' => 'required|file|image|max:2024|dimensions:max_width=3000,max_height=3000',
            'obse_estu' => 'nullable|min:3|max:250|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'sub_grado_id'  =>'required|string|exists:sub_grados,id',
        ];
    }
}
