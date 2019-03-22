<?php
namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SiteSetting;

class SitesController extends Controller
{
	
	/**
	 * Create new controller instance
	 */
    public function __construct()
	{
		$this->middleware('auth');
	}


	public function site(Request $request)
	{
		abort_if(auth()->user()->roles !== 'root', 403);

		if ($request->isMethod('get')) {
			$settings = SiteSetting::select(['*'])
				->orderBy('id')
				->first();

			return view('settings.site', compact('settings'));
		}

		elseif ($request->isMethod('post')) {
			// TODO: handle post data
			dd($request->input());
		}
	}
}