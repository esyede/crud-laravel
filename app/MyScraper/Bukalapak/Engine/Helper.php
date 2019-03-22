<?php
namespace App\MyScraper\Bukalapak\Engine;

use Goutte;
use Clue\React\Buzz\Browser;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;


class Helper
{

	public static function perpageProductLink(string $shopUrl) : array
	{
	    $goutte = Goutte::request('GET', $shopUrl);
	    $data = $goutte->filter('.product-display')->each(function ($node) {
	        return [
	            'https://www.bukalapak.com'
	                .explode('?', $node->filter('.js-tracker-product-link')->attr('href'))[0]
	        ];
	    });
	    unset($goutte);
	    
	    return array_column($data, 0);
	}


    public static function getNumberOfPages(string $shopUrl)
    {
    	$shopUrl = rtrim($shopUrl, '/');
	    $goutte = Goutte::request('GET', $shopUrl);
	    $selector = '//*[@id="user_product"]/div/div/div/ul';
	    $count = $goutte->filterXPath($selector)->text();
	    unset($goutte);
	    $count = explode(' ', trim($count));
	    $count = end($count);
	    return $count;
	}


	public static function getShopPagesLink(string $shopUrl) : array
    {
	    $links = [];
	    $count = self::getNumberOfPages($shopUrl);

	    for ($i = 1; $i <= $count; $i++) {
	    	$links[$i] = $shopUrl.'?page='.$i;
	    }
	    
	    return $links;
	}

	
	public static function writeToCSV(string $fileName, array $data = []) : void
	{
	    $handle = fopen($fileName, 'w');
	    foreach ($data as $value) {
	        fputcsv($handle, [key($data), $value]);
	    }
	    fclose($handle);
	}
}