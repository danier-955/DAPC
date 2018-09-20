<?php

namespace App\Http\Requests;

use Facades\App\Facades\Estado;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'nombre'    => 'required|min:7|max:100|regex:/^[a-zA-ZáéíóúàèìòùäëïöüñÁÉÍÓÚÄËÏÖÜÑ\'\s]+$/i',
            'email'     => 'required|email|max:50|unique:users,email,' . optional($this->route('usuario'))->id,
            'estado'    => 'required|in:'. implode(',', Estado::indexados()),
            'role'      => 'required|string|exists:roles,id',
            'password'  => array('nullable','string','min:8','max:25','dumbpwd','regex:/^((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[a-zA-Z]).*$/i','confirmed'),
        ];
    }
}
