<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\User;
use App\MyHelpers\Datatables\UserHelper;

class ViewController extends Controller
{
	/**
	 * Create new controller instance
	 */
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function all(Request $request)
	{
		abort_if(!in_array(auth()->user()->roles, ['admin', 'root']), 403);

		return view('users.all');
	}

	public function one(Request $request, int $id)
	{
		//
	}


	public function json_all(Request $request)
	{
		abort_if(!in_array(auth()->user()->roles, ['admin', 'root']), 403);

		return UserHelper::json_all();
	}
}
