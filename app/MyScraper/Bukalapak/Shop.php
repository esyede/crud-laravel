<?php
namespace App\MyScraper\Bukalapak;

use Clue\React\Buzz\Browser;
use App\MyScraper\Bukalapak\Engine\Helper;
use App\MyScraper\Bukalapak\Engine\ShopEngine;


class Shop
{

	public static function perpage(string $shopUrl, int $timeout = 60, int $concurrency = 10) : array
	{
		// 'https://www.bukalapak.com/u/ndutzz_pryatna'
		$urls = Helper::perpageProductLink($shopUrl);

		$loop = \React\EventLoop\Factory::create();
		$client = new Browser($loop);
		$parser = new ShopEngine($client, $loop);

		$parser->parse($urls, $timeout, $concurrency);
		$loop->run();

		return $parser->response();
	}



	public static function all(string $shopUrl) : array
	{
		// 'https://www.bukalapak.com/u/ndutzz_pryatna'
		$pages = Helper::getShopPagesLink($shopUrl);

		$data = [];
		foreach ($pages as $key => $page) {
			$data[$key] = self::perpage($page, 180, 10);
		}

		return $data;
	}
}