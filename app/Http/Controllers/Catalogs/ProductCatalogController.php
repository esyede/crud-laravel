<?php

namespace App\Http\Controllers\Catalogs;

use Illuminate\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCatalogController extends Controller
{
	
    public function __construct()
	{
		$this->middleware('auth');
	}
}
