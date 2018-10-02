<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Facades\App\Facades\Sexo;
use Facades\App\Facades\Cargo;
use Facades\App\Facades\Jornada;

class AdministrativoRequest extends FormRequest
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
            'docu_admi'     => 'required|min:7|max:10|regex:/^[0-9]+$/i|unique:administrativos,docu_admi,' . optional($this->route('administrativo'))->id,
            'nomb_admi'     => 'required|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'pape_admi'     => 'required|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'sape_admi'     => 'nullable|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'sexo_admi'     => 'required|in:'. implode(',', Sexo::indexados()),
            'dire_admi'     => 'required|min:5|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'barr_admi'     => 'nullable|min:3|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'corr_admi'     => 'required|email|max:50|unique:users,email,' . optional(optional($this->route('administrativo'))->user)->id,
            'tele_admi'     => 'nullable|min:7|max:10|regex:/^[0-9]+$/i',
            'carg_admi'     => 'required|in:'. implode(',', Cargo::indexados()),
            'jorn_admi'     => 'required|in:'. implode(',', Jornada::adminIndexados()),
            'titu_admi'     => 'required|min:3|max:100|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'espe_admi'     => 'nullable|min:3|max:250|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'expe_admi'     => 'nullable|min:3|max:500|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'obse_admi'     => 'nullable|min:3|max:250|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'fech_ingr'     => 'required|date',
            'obse_empl'     => 'nullable|min:3|max:250|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'tipo_empleado_id' => 'required|string|exists:tipo_empleados,id',
        ];
    }
}
