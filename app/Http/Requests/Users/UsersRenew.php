<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UsersRenew extends FormRequest
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
            'id' => ['bail', 'required', 'numeric'],
            'expired_at' => ['bail', 'required', 'digits_between:1,12']
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'User id wajib diisi',
            'id.numeric' => 'User id harus berupa angka',

            'expired_at.required' => 'Bilah durasi masa aktif wajib diisi',
            'expired_at.digits_between'=> 'Bilah durasi masa aktif harus diisi angka antara 1 sampai 12'
        ];
    }
}
