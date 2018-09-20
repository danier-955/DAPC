<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FechaRequest extends FormRequest
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
            'ano_fech' => 'required|date_format:Y|unique:fechas,ano_fech,' . optional($this->route('fecha'))->id,
            /**
             * Fechas regulares
             */
            'fech_not1_inic' => 'required|date_format:Y-m-d h:i a',
            'fech_not1_fina' => 'required|date_format:Y-m-d h:i a|after_or_equal:fech_not1_inic',
            'fech_not2_inic' => 'required|date_format:Y-m-d h:i a|after_or_equal:fech_not1_fina',
            'fech_not2_fina' => 'required|date_format:Y-m-d h:i a|after_or_equal:fech_not2_inic',
            'fech_not3_inic' => 'required|date_format:Y-m-d h:i a|after_or_equal:fech_not2_fina',
            'fech_not3_fina' => 'required|date_format:Y-m-d h:i a|after_or_equal:fech_not3_inic',
            'fech_not4_inic' => 'required|date_format:Y-m-d h:i a|after_or_equal:fech_not3_fina',
            'fech_not4_fina' => 'required|date_format:Y-m-d h:i a|after_or_equal:fech_not4_inic',
            /**
             * Fechas de recuperación
             */
            'fech_rec1_inic' => 'required|date_format:Y-m-d h:i a|after:fech_not1_fina',
            'fech_rec1_fina' => 'required|date_format:Y-m-d h:i a|after_or_equal:fech_rec1_inic|before:fech_not2_inic',
            'fech_rec2_inic' => 'required|date_format:Y-m-d h:i a|after:fech_not2_fina',
            'fech_rec2_fina' => 'required|date_format:Y-m-d h:i a|after_or_equal:fech_rec2_inic|before:fech_not3_inic',
            'fech_rec3_inic' => 'required|date_format:Y-m-d h:i a|after:fech_not3_fina',
            'fech_rec3_fina' => 'required|date_format:Y-m-d h:i a|after_or_equal:fech_rec3_inic|before:fech_not4_inic',
            'fech_rec4_inic' => 'required|date_format:Y-m-d h:i a|after:fech_not4_fina',
            'fech_rec4_fina' => 'required|date_format:Y-m-d h:i a|after_or_equal:fech_rec4_inic',
        ];
    }
}
