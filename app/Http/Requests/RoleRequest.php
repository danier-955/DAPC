<?php

namespace App\Http\Requests;

use Facades\App\Facades\SpecialRole;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        if ($this->isMethod('POST'))
        {
            $special = 'nullable|in:'. SpecialRole::noAccess();
        }
        else
        {
            $isAllAccess = optional($this->route('role'))->isAllAccess();

            if ($isAllAccess)
            {
                $special = 'required|in:'. SpecialRole::allAccess();
            }
            else
            {
                $special = 'nullable|in:'. SpecialRole::noAccess();
            }
        }

        return [
            /**
             * Role
             */
            'name'          => 'required|min:3|max:250|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i|unique:roles,name,' . optional($this->route('role'))->id,
            'slug'          => 'required|min:3|max:250|regex:/^[a-z.]+$/i|unique:roles,slug,' . optional($this->route('role'))->id,
            'special'       => $special,
            'description'   => 'nullable|min:3|max:500|regex:/^[0-9a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ_#\-\'".,;\s]+$/i',

            /**
             * Permissions
             */
            'permissions.*' => 'nullable|string|exists:permissions,id',
        ];
    }
}
