<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubGradoRequest extends FormRequest
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
            'abre_subg'     => 'nullable|min:1|max:1|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'cant_estu'         => 'required|numeric|max:100',
            'grado_id' => 'required|string|exists:grados,id',
        ];
    }
}
