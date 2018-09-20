<?php

namespace App\Http\Requests;

use Facades\App\Facades\Cargo;
use Facades\App\Facades\Estado;
use Facades\App\Facades\Operacion;
use Facades\App\Facades\Periodo;
use Facades\App\Facades\TipoNota;
use Illuminate\Foundation\Http\FormRequest;

class BusquedaRequest extends FormRequest
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
             * Bitácoras
             */
            'fech_inic'     => 'nullable|required_with:fech_fina|date',
            'fech_fina'     => 'nullable|required_with:fech_inic|date|after_or_equal:fech_inic',
            'oper_bita'     => 'nullable|in:'. implode(',', Operacion::indexados()),
            'usua_bita'     => 'nullable|string|max:100|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',

            /**
             * Usuarios
             */
            'nombre'        => 'nullable|min:3|max:100|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'estado'        => 'nullable|in:'. implode(',', Estado::busquedaIndexados()),
            'rol'           => 'nullable|string|exists:roles,id',

            /**
             * Docentes
             */
            'docu_doce'     => 'nullable|min:7|max:10|regex:/^[0-9]+$/i',
            'nomb_doce'     => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'pape_doce'     => 'nullable|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'sape_doce'     => 'nullable|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',

            /**
             * Planeamientos
             */
            'titu_plan'     => 'nullable|min:3|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',

            /**
             * Practicantes
             */
            'docu_prac'     => 'nullable|min:7|max:10|regex:/^[0-9]+$/i',
            'nomb_prac'     => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'pape_prac'     => 'nullable|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'sape_prac'     => 'nullable|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',

            /**
             * Galerias
             */
            'titu_gale'     => 'nullable|min:5|max:100|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',

            /**
            *Administrativos
            */
            'docu_admi'     => 'nullable|min:7|max:10|regex:/^[0-9]+$/i',
            'nomb_admi'     => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'pape_admi'     => 'nullable|min:3|max:25|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'carg_admi'     => 'nullable|in:'. implode(',', Cargo::indexados()),

            /**
             * Fechas
             */
            'ano_fech'      => 'nullable|date_format:Y',
            'peri_nota'     => 'nullable|in:'. implode(',', Periodo::indexados()),
            'tipo_nota'     => 'nullable|in:'. implode(',', TipoNota::indexados()),

            /**
             * Eventos
             */
            'titu_even'     => 'nullable|min:5|max:100|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',

            /**
             * Asignaturas
             */
            'nomb_asig'     => 'nullable|min:3|max:50|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'area_id'       => 'nullable|string|exists:areas,id',
            'grado_id'      => 'nullable|string|exists:grados,id',
        ];
    }
}
