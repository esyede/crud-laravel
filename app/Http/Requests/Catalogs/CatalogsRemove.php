<?php

namespace App\Http\Requests\Catalogs;

use Illuminate\Foundation\Http\FormRequest;
use App\Catalog;

class CatalogsRemove extends FormRequest
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
            'id' => ['bail', 'required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Katalog tidak ditemukan',
            'id.numeric' => 'Katalog tidak ditemukan',
        ];
    }

}
