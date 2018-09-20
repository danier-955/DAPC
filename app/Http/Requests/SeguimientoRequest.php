<?php

namespace App\Http\Requests;

use App\Rules\MayorCero;
use Illuminate\Foundation\Http\FormRequest;

class SeguimientoRequest extends FormRequest
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
            'fech_segu'    => 'required|date',
            'hora_lleg'    => 'required|date_format:"h:i a"',
            'hora_sali'    => 'required|date_format:"h:i a"|after_or_equal:hora_lleg',
            'hora_cump'    => ['required', 'max:3', 'regex:/^[0-9]+$/i', new MayorCero()],
            'acti_real'   => 'required|min:10|max:500|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'obse_segu'    => 'nullable|min:10|max:500|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'practicante_id' => 'required|string|exists:practicantes,id',
            'docente_id'   => 'required|string|exists:docentes,id',
        ];
    }
}
