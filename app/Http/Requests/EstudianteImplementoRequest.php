<?php

namespace App\Http\Requests;

use App\Rules\MayorCero;
use Illuminate\Foundation\Http\FormRequest;

class EstudianteImplementoRequest extends FormRequest
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
            'cant_util'     => ['required', 'max:3', 'regex:/^[0-9]+$/i', new MayorCero()],
            'estudiante_id' => 'required|string|exists:estudiantes,id',
            'implemento_id' => 'required|string|exists:implementos,id',
        ];
    }
}
