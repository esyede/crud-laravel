<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class LinksEdit extends FormRequest
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

    public function rules()
    {
        return [
            'id'   => ['bail', 'required', 'numeric'],
            'type' => ['bail', 'required', 'in:download,tutorial'],
            'url'  => ['bail', 'required', 'url', 'min:10', 'max:255'],
            'name' => ['bail', 'required', 'string', 'min:3', 'max:50']
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Bilah tipe link wajib diisi',
            'type.in'       => 'Bilah tipe link harus diisi tutorial atau download',

            'url.required'  => 'Bilah url link wajib diisi',
            'url.min'       => 'Bilah url link terlalu pendek, minimal 10 karakter',
            'url.max'       => 'Bilah url link terlalu panjang, maksimal 255 karakter',

            'name.required' => 'Bilah nama link wajib diisi',
            'name.string'   => 'Bilah nama link harus berupa string',
            'name.min'      => 'Bilah nama link sterlalu pendek, minimal 3 karakter',
            'name.max'      => 'Bilah nama link terlalu panjang, maksimal 50 karakter',
        ];
    }
}
