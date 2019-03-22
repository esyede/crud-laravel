<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;

class UserController extends Controller
{
	
	/**
	 * Create new controller instance
	 */
    public function __construct()
	{
		$this->middleware('auth');
	}


	public function password(Request $request)
	{
		if (!(Hash::check($request->get('password'), Auth::user()->password))) {
		    return redirect()->back()
		    	->with('errorr.passwd', 'Password saat ini tidak cocok dengan password otentikasi anda');
		}

		if(strcmp($request->get('password'), $request->get('new_password')) == 0) {
		    return redirect()->back()
		    	->with('error.newpass', 'Password baru tidak boleh sama dengan password saat ini');
		}

		$data = $request->validate([
		    'password'     => 'required',
		    'new_password' => 'required|string|min:6|confirmed',
		]);

		$user = Auth::user();
		$user->password   = bcrypt($request->get('new_password'));
		$user->updated_at = now();
		$user->save();
		return redirect()->back()
			->with('status', 'Password anda berhasil diubah menjadi: <b>'.$request->get('new_password').'</b>');
	}


	public function showPasswordForm()
	{
		return view('settings.password');
	}



	public function shop(Request $request)
	{
		dd($request->input());
	}

	public function showShopForm()
	{
		return view('settings.shop');
	}


	public function data(Request $request)
	{
		dd($request->input());
	}


	public function showDataForm()
	{
		return view('settings.data');
	}
}