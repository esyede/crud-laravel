<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

use App\Http\Requests\Products\ProductsEdit;

use App\Catalog;
use App\Product;
// use Ramsey\Uuid\Uuid;

class CrudController extends Controller
{
	/**
	 * Create new controller instance
	 */
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function add(Request $request)
	{
		// TODO: handle post data
		dd($request->input());
	}


	public function edit(ProductsEdit $request, int $id)
	{
		$data  = $request->validated();
		$data += ['updated_at' => now()];
		dd($data);
		// dd($request->input());

	}

	public function showEditForm(Request $request, int $id)
	{
		$product = Product::findOrFail($id)
			->where('user_id', '=', auth()->user()->id)
			->first();
		$product['id'] = $id;

		return view('products.edit', compact('product'));
	}

	public function remove(Request $request, int $id)
	{

	}
}
