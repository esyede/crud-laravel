<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UsersChangeRole extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->roles === 'root';
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
            'id.required' => 'User tidak ditemukan',
            'id.numeric' => 'User tidak ditemukan',
        ];
    }
}
