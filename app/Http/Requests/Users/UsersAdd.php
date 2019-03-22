<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UsersAdd extends FormRequest
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
            'name'       => ['bail', 'required', 'string', 'min:3', 'max:50'],
            'username'   => ['bail', 'required', 'string', 'min:3', 'max:20', 'unique:users'],
            'password'   => ['bail', 'required', 'string', 'min:6', 'max:50'],
            'expired_at' => ['bail', 'required', 'digits_between:1,12']
        ];
    }

    public function messages($value='')
    {
        return [
            'name.required' => 'Bilah nama wajib diisi',
            'name.string' => 'Bilah nama harus berupa string',
            'name.min' => 'Bilah nama terlalu pendek, minimal 3 karakter',
            'name.max' => 'Bilah nama terlalu panjang, maksimal 50 karakter',

            'username.required' => 'Bilah username wajib diisi',
            'username.string' => 'Bilah username harus berupa string',
            'username.min' => 'Bilah username terlalu pendek, minimal 3 karakter',
            'username.max' => 'Bilah username terlalu panjang, maksimal 20 karakter',
            'username.unique' => 'Username ini sudah dipakai oleh member lain',

            'password.string' => 'Bilah nama harus berupa string',
            'password.min' => 'Bilah password minimal harus diisi 6 karakter',
            'password.max' => 'Bilah password terlalu panjang',

            'expired_at.required' => 'Bilah durasi masa aktif wajib diisi',
            'expired_at.digits_between' => 'Bilah durasi masa aktif harus diisi angka antara 1 sampai 12'
        ];
    }
}
