<?php
namespace App\Http\Controllers\Home;

ini_set('max_execution_time', 300);

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MyScraper\Bukalapak\Shop;


class TestController extends Controller
{

	public function index()
	{
		$shop = 'https://www.bukalapak.com/u/ndutzz_pryatna';
		// $count = \App\MyScraper\Bukalapak\Engine\Helper::getNumberOfPages($shop); //
		// print_r($count);

		// $entireShop = Shop::all($shop);
		// dd($entireShop);
		$shopPerpage = Shop::perpage($shop, 300);
		dd($shopPerpage);
		// $pp = \App\MyScraper\Bukalapak\Engine\Helper::getEntireShopLink($shop);
		// dd($pp);
		return view('backend.test');
	}

}
