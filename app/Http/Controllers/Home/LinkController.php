<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Home\LinksAdd;
use App\Http\Requests\Home\LinksEdit;
use App\Http\Requests\Home\LinksRemove;

use App\Link;
use App\MyHelpers\Datatables\LinkHelper;

class LinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(LinksAdd $request)
    {
    	$data  = $request->validated();
    	$data += ['created_at' => now(), 'updated_at' => now()];
    	$operation = (new Link)->add($data);

    	$json = [
    		'success'  => ($operation !== false),
    		'messages' => 'Link '.($operation !== false ? 'berhasil' : 'gagal').' ditambahkan'
    	];

    	return response()->json($json);
    }


    public function edit(LinksEdit $request)
    {
    	$data  = $request->validated();
        // $json = [
        //  'success'  => false,
        //  'messages' => serialize($data)
        // ];
    	$data += ['updated_at' => now()];
    	$operation = (new Link)->edit($data);

    	$json = [
    		'success'  => ($operation !== false),
    		'messages' => 'Link '.($operation !== false ? 'berhasil' : 'gagal').' diedit'
    	];

    	return response()->json($json);
    }

    public function editJson(Request $request)
    {
        $record = Link::select()->where('id', '=', $request->input('id'))->first();

        return response()->json($record);
    }


    public function remove(LinksRemove $request)
    {
    	$data = $request->validated();
    	$operation = (new Link)->remove($data['id']);

    	$json = [
    		'success'  => ($operation !== false),
    		'messages' => 'Link '.($operation !== false ? 'berhasil' : 'gagal').' dihapus'
    	];

    	return response()->json($json);
    }

    public function json_all(Request $request, $id)
    {
        abort_if(!in_array($id, [1, 2]), 404);
        return LinkHelper::json_all($id);
    }

    public function showDownload(Request $request)
    {
    	$links = (new Link)->allDownload();

    	return view('home.downloads', compact('links'));
    }

    public function showTutorial(Request $request)
    {
    	$links = (new Link)->allTutorial();

    	return view('home.tutorials', compact('links'));
    }
}
