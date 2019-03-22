<?php

namespace App\Http\Requests\Catalogs;

use Illuminate\Foundation\Http\FormRequest;
use App\Catalog;

class CatalogsEdit extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $query = Catalog::find(request()->input('id'))->where('user_id', '=', auth()->user()->id);
        $thisCatalogBelongsToThisUser = $query->exists();

        return $thisCatalogBelongsToThisUser;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', 'numeric'],
            'name' => ['bail', 'required', 'string', 'min:3', 'max:20'],
            'description' => ['bail', 'required', 'string', 'min:5', 'max:50']
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Katalog tidak ditemukan',
            'id.numeric' => 'Katalog tidak ditemukan',

            'name.required' => 'Bilah nama katalog wajib diisi',
            'name.string' => 'Bilah nama katalog harus berupa string',
            'name.min' => 'Bilah nama katalog harus diisi minimal 3 karakter',
            'name.max' => 'Bilah deskripsi katalog terlalu panjang, maks. 20 karakter',

            'description.required' => 'Bilah deskripsi katalog wajib diisi',
            'description.string' => 'Bilah deskripsi katalog  harus berupa string',
            'description.min' => 'Bilah deskripsi katalog harus diisi minimal 5 karakter',
            'description.max' => 'Bilah deskripsi katalog terlalu panjang, maks. 50 karakter'
        ];
    }
}
