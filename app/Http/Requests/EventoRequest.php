<?php

namespace App\Http\Requests;

use App\Rules\MayorCero;
use Facades\App\Facades\Jornada;
use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
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
        $foto_even = 'required|file|image|max:2048|dimensions:max_width=3000,max_height=3000';
        $jorn_even = 'required|in:' . implode(',', jornada('indexados'));

        if ($this->isMethod('PUT'))
        {
            $foto_even = str_replace_first('required', 'nullable', $foto_even);
            $jorn_even = str_replace_first('required', 'nullable', $jorn_even);
        }

        return [
            'titu_even' => 'required|min:5|max:100|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i|unique:eventos,titu_even,' . optional($this->route('evento'))->id,
            'foto_even' => $foto_even,
            'inic_even' => 'required|date_format:"Y-m-d h:i a"',
            'fina_even' => 'required|date_format:"Y-m-d h:i a"|after_or_equal:inic_even',
            'jorn_even' => $jorn_even,
            'desc_even' => 'required|min:3|max:1000|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'cupo_even' => ['required', 'max:3', 'regex:/^[0-9]+$/i', new MayorCero()],
        ];
    }
}
