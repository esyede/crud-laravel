<?php

namespace App\Http\Requests\Catalogs;

use Illuminate\Foundation\Http\FormRequest;
use App\Catalog;

class CatalogsAdd extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $query = Catalog::select('id')->where('user_id', '=', auth()->user()->id);
        // $thisUserOwnsThisCatalog = $query->count('id') > 0;

        // return $thisUserOwnsThisCatalog;
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
            'name' => ['bail', 'required', 'string', 'min:3', 'max:20'],
            'description' => ['bail', 'required', 'string', 'min:5', 'max:50']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bilah nama katalog wajib diisi',
            'name.string' => 'Bilah nama katalog harus berupa string',
            'name.min' => 'Bilah nama katalog harus diisi minimal 3 karakter',
            'name.max' => 'Bilah deskripsi katalog terlalu panjang, maks. 20 karakter ',

            'description.required' => 'Bilah deskripsi katalog wajib diisi',
            'description.string' => 'Bilah deskripsi katalog  harus berupa string',
            'description.min' => 'Bilah deskripsi katalog harus diisi minimal 5 karakter',
            'description.max' => 'Bilah deskripsi katalog terlalu panjang, maks. 50 karakter'
        ];
    }
}
