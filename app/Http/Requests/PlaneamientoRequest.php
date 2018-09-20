<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaneamientoRequest extends FormRequest
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
        $docu_plan = 'required|file|mimes:txt,doc,docx,xls,xlsx,ppt,pptx,pdf|max:2048';

        if ($this->isMethod('PUT'))
        {
            $docu_plan = str_replace_first('required', 'nullable', $docu_plan);
        }

        return [
            'titu_plan'    => 'required|min:3|max:50|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i|unique:planeamientos,titu_plan,' . optional($this->route('planeamiento'))->id,
            'fech_plan'    => 'required|date',
            'docu_plan'    => $docu_plan,
            'desc_plan'    => 'required|min:3|max:500|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',
            'docente_id'   => 'required|string|exists:docentes,id',
        ];
    }
}
