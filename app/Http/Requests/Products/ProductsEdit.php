<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use App\Product;

class ProductsEdit extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $query = Product::find(Route::current()->parameter('id'))
            ->where('user_id', '=', auth()->user()->id);
        $thisProductBelongsToThisUser = $query->exists();

        return $thisProductBelongsToThisUser;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image'       => ['bail', 'required', 'url'],
            'name'        => ['bail', 'required', 'string', 'min:3', 'max:255'],
            'margin'      => ['bail', 'required', 'digits_between:1,7'],
            'weight'      => ['bail', 'required', 'digits_between:1,5'],
            'stock'       => ['bail', 'required', 'digits_between:1,3'],
            'condition'   => ['bail', 'required', 'in:new,used'],
            'assurance'   => ['bail', 'required', 'in:yes,no'],
            'description' => ['bail', 'required', 'string', 'min:3', 'max:2000'],
            'courier'     => ['nullable', 'array'],
        ];
    }


    public function messages()
    {
        return [
            'image.required'        => 'Bilah gambar produk wajib diisi',
            'image.url'             => 'Bilah gambar produk harus diisi url yang valid',
            'name.required'         => 'Bilah nama wajib diisi',
            'name.string'           => 'Bilah nama harus diisi string',
            'name.min'              => 'Bilah nama terlalu pendek, minimal 3 karakter',
            'name.max'              => 'Bilah nama terlalu panjang, maksimal 255 karakter',

            'margin.required'       => 'Bilah margin wajib diisi',
            'margin.digits_between' => 'Bilah margin harus diisi 1 sampai 7 digit angka',

            'weight.required'       => 'Bilah berat barang wajib diisi',
            'weight.digits_between' => 'Bilah berat barang harus diisi 1 sampai 5 digit angka',

            'stock.required'        => 'Bilah stok barang wajib diisi',
            'stock.digits_between'  => 'Bilah stok barang harus diisi 1 sampai 3 digit angka',

            'condition.required'    => 'Bilah kondisi barang wajib diisi',
            'condition.in'          => 'Bilah kondisi barang harus diisi Baru atau Bekas',

            'courier.array'         => 'Bilah kurir setidaknya harus berisi satu jenis pengiriman',

            'assurance.required'    => 'Bilah asuransi barang wajib diisi',
            'assurance.in'          => 'Bilah kondisi barang harus diisi Ya atau Tidak',
            
            'description.required'  => 'Bilah deskripsi barang wajib diisi',
            'description.string'    => 'Bilah deskripsi barang harus diisi string',
            'description.min'       => 'Bilah deskripsi barang terlalu pendek, minimal 3 karakter',
            'description.max'       => 'Bilah deskripsi barang terlalu panjang, maksimal 2000 karakter',
        ];
    }
}
