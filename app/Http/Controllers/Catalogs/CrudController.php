<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

use App\Http\Requests\Catalogs\CatalogsAdd;
use App\Http\Requests\Catalogs\CatalogsEdit;
use App\Http\Requests\Catalogs\CatalogsRemove;

use App\Catalog;
use App\Product;
use App\ProductCatalog;

class CrudController extends Controller
{
	/**
	 * Create new controller instance
	 */
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function add(CatalogsAdd $request)
	{
		$data = $request->validated();

		$catalogExists = Catalog::where('user_id', '=', auth()->user()->id)
	    	->where('name', '=', $data['name'])
	    	->exists();
	    if ($catalogExists) {
	    	$json = ['success' => false, 'messages' => 'Katalog dengan nama '.$data['name'].' ini sudah ada'];

	    	return response()->json($json);
	    }

	    $data += ['user_id' => auth()->user()->id];
	    $operation = (new Catalog)->add($data);
	    $json = [
	    	'success'  => ($operation !== false),
	    	'messages' => 'Katalog '.$data['name'].($operation !== false ? ' berhasil' : ' gagal').' dibuat'
	    ];

		return response()->json($json);
	}


	public function edit(CatalogsEdit $request)
	{
		$data  = $request->validated();
		$data += ['updated_at' => now()];
		
		$operation = (new Catalog)->edit($data);
		$json = [
			'success' => ($operation !== false),
			'messages' => 'Katalog '.$data['name'].($operation !== false ? ' berhasil' : ' gagal'). ' diedit'
		];

		return response()->json($json);
	}

	public function editJson(Request $request)
	{
		$catalog = Catalog::select()
			->where('id', '=', $request->input('id'))
			->where('user_id', '=', auth()->user()->id)
			->first();

		return response()->json($catalog);
	}


	public function remove(CatalogsRemove $request)
	{
		$data = $request->validated();
        $catalog = Catalog::find($data['id']);
        if ($catalog->products()->count() < 1) {
        	$operation = true;
        }
        else {
        	$operation = $catalog->products()->delete();
        } 
        $operation = $operation && $catalog->delete();
		$json = [
			'success' => ($operation !== false),
			'messages' => 'Katalog '.($operation !== false ? 'berhaasil' : 'gagal').' dihapus'
		];

		return response()->json($json);
	}
}