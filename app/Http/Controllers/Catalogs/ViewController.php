<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Catalog;
use App\Product;
use App\MyHelpers\Datatables\CatalogHelper;
// use Ramsey\Uuid\Uuid;

class ViewController extends Controller
{
	/**
	 * Create new controller instance
	 */
    public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * List semua catalog
	 * 
	 * @param  Request $request
	 * @return void
	 */
	public function all(Request $request)
	{
		$catalog = new Catalog();
		$catalog->allByUser(auth()->user()->id);

		return view('catalogs.all', compact('catalog'));
	}

	/**
	 * Produk dalam satu catalog
	 * 
	 * @param  Request $request
	 * @param  int     $id
	 * @return void
	 */
	public function one(Request $request, int $id)
	{
		$products = new Product();
		$product = $products->catalog($id);
		$query   = Catalog::select(['name'])
			->where('user_id', '=', auth()->user()->id)
			->where('id', '=', $id);
		
		// 404 if records does not exist in the database
		abort_if(!$query->exists(), 404);

		$name    = $query->first()->name;
		$data    = ['catalog_id' => $id, 'catalog_name' => $name];

		return view('catalogs.one', compact('product', 'data'));
	}

	/**
	 * DataTables JSON data untuk list catalog
	 * @param  Request $request
	 * @return void
	 */
	public function json_all(Request $request)
	{
		return CatalogHelper::json_all();
	}

	/**
	 * DataTables JSON data untuk list produk dalam catalog
	 * @param  Request $request
	 * @param  int     $id
	 * @return void
	 */
	public function json_one(Request $request, int $id)
	{
		return CatalogHelper::json_one($id);
	}
}
