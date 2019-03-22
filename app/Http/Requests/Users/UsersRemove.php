<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UsersRemove extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return in_array(auth()->user()->roles, ['admin', 'root']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['bail', 'required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'User id wajib diisi',
            'id.numeric' => 'User id harus berupa angka'
        ];
    }
}
