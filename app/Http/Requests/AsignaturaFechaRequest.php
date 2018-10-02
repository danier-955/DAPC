<?php

namespace App\Http\Requests;

use Facades\App\Facades\Periodo;
use Facades\App\Facades\TipoNota;
use Illuminate\Foundation\Http\FormRequest;

class AsignaturaFechaRequest extends FormRequest
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
            'fech_inic' => 'required|date_format:"Y-m-d h:i a"',
            'fech_fina' => 'required|date_format:"Y-m-d h:i a"|after_or_equal:fech_inic',
            'peri_nota' => 'required|in:'. implode(',', Periodo::indexados()),
            'tipo_nota' => 'required|in:'. implode(',', TipoNota::indexados()),
            'moti_nota' => 'required|min:3|max:250|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
        ];
    }
}
