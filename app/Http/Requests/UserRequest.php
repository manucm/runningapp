<?php

namespace App\Http\Requests;

use App\Modelos\Usuario;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

  public function __contruct() {
  }
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
        if ($this->method() == 'POST')
            return [
                'nombre' => 'required|min:4',
                'apellidos' => 'required|min:4',
                'usuario' => 'required|min:4|unique:usuarios,id',
                'password' => 'required|min:6',
                'email' => 'required|min:10|unique:usuarios,id',
            ];

        $id = $this->route('usuario')->id;

        return [
          'nombre' => 'required|min:4',
          'apellidos' => 'required|min:4',
          'usuario' => 'required|min:4|unique:usuarios,id,'.$id,
          'email' => 'required|min:10|unique:usuarios,id,'.$id,
        ];
    }
}
