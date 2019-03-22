<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use FastExcel;

use Clue\React\Buzz\Browser;
use Psr\Http\Message\ResponseInterface;
use function React\Promise\all;
use React\Promise\PromiseInterface;
use Symfony\Component\DomCrawler\Crawler;
use Goutte;

class Test2Controller extends Controller
{
	protected $links;
	protected $data;


	public function index()
	{
		$shop = 'https://www.bukalapak.com/u/epasandra';
		$links = $this->getProductLinks($shop);

		dd($links);
		return FastExcel::data(collect($data))->download('test12.csv');
		// return view('backend.test');
	}

	/**
	 * Get all shop item links of seller
	 * @param  string $shopLink
	 * @return array
	 */
	protected function getProductLinks($shopLink)
	{
		$goutte = Goutte::request('GET', $shopLink);
		$data = $goutte->filter('.product-display')->each(function ($node) {
			return [
				'https://www.bukalapak.com'
					.explode('?', $node->filter('.js-tracker-product-link')->attr('href'))[0]
			];
		});
		
		return array_column($data, 0);
	}


	protected function getProductDetail($link)
	{
		$goutte = Goutte::request('GET', $link);

		$link = $goutte->getUri();
		$nama = $goutte->filter('.c-product-detail__name')->text();
		$harga = $goutte->filter('.c-product-detail-price')->attr('data-reduced-price');
		$gambar = $goutte->filter('.c-product-image-gallery__main img')->attr('src');
		$stok = preg_replace('/[^0-9]+/', '', $goutte->filter('.qa-pd-stock')->text());
		$berat = preg_replace('/[^0-9]+/', '', $goutte->filter('.qa-pd-weight-value')->text());
		$kondisi = $goutte->filter('.qa-pd-condition-value > span.c-label')->text();
		$deskripsi = trim($goutte->filter('.qa-pd-description')->html(), "\n");
		$asuransi = 'Tidak';
		$kurir = 'jner|j&tr';

		$data = [
			'link' => $link,
			'nama' => $nama,
			'harga' => $harga,
			'stok' => $stok,
			'berat' => $berat,
			'kondisi' => $kondisi,
			'deskripsi' => $deskripsi,
			'asuransi' => $asuransi,
			'kurir' => $kurir,
			'gambar' => $gambar,

		];
		return $data;
	}

	protected function writeToCSV($file, $array = [])
	{
    	$handle = fopen($file, "w");
    	foreach ($array as $value) {
        	fputcsv($handle, [key($array), $value]);
    	}
    	fclose($handle);
	}
}


