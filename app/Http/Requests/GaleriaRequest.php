<?php

namespace App\Http\Requests;

use Facades\App\Facades\Jornada;
use Illuminate\Foundation\Http\FormRequest;

class GaleriaRequest extends FormRequest
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
        $foto_gale = 'required|file|image|max:2048|dimensions:max_width=3000,max_height=3000';
        $jorn_gale = 'required|in:' . implode(',', jornada('indexados'));

        if ($this->isMethod('PUT'))
        {
            $foto_gale = str_replace_first('required', 'nullable', $foto_gale);
            $jorn_gale = str_replace_first('required', 'nullable', $jorn_gale);
        }

        return [
            'titu_gale' => 'required|min:5|max:100|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i|unique:galerias,titu_gale,' . optional($this->route('galeria'))->id,
            'foto_gale' => $foto_gale,
            'jorn_gale' => $jorn_gale,
            'desc_gale' => 'required|min:3|max:250|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
        ];
    }
}
