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
            'abre_subg' => 'required|max:1|regex:/^[a-zA-ZñÑ0-9]+$/i',
            'cant_estu' => 'required|integer|between:1,100',
            'docente_id' => 'nullable|string|exists:docentes,id',
        ];
    }
}
