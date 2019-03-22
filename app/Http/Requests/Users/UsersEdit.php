<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UsersEdit extends FormRequest
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
            'id'         => ['bail', 'required', 'numeric'],
            'name'       => ['bail', 'required', 'string', 'min:3', 'max:50'],
            'password'   => ['bail', 'nullable', 'string', 'min:6', 'max:50'],
            'expired_at' => ['bail', 'nullable', 'date']
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'User tidak ditemukan',
            'id.numeric' => 'User tidak ditemukan',

            'name.required' => 'Bilah nama wajib diisi',
            'name.string' => 'Bilah nama harus berupa string',
            'name.min' => 'Bilah nama terlalu pendek, minimal 3 karakter',
            'name.max' => 'Bilah nama terlalu panjang, maksimal 50 karakter',

            'password.string' => 'Bilah nama harus berupa string',
            'password.min' => 'Bilah password pendek, minimal 6 karakter',
            'password.max' => 'Bilah password terlalu panjang, maksimal 50 karakter',
            
            'expired_at.date' => 'Bilah tanggal kadaluwarsa harus diisi tanggal yang valid'
        ];
    }
}
