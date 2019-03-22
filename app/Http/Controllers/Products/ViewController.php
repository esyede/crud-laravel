<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
	/**
	 * Create new controller instance
	 */
    public function __construct()
	{
		$this->middleware('auth');
	}
}
