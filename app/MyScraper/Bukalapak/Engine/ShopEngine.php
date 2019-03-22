<?php
namespace App\MyScraper\Bukalapak\Engine;

use Clue\React\Buzz\Browser;
use React\EventLoop\LoopInterface;
use React\Promise\Promise;
use Symfony\Component\DomCrawler\Crawler;


class ShopEngine
{

    private $client;
    private $parsed = [];
    private $loop;


    public function __construct(Browser $client, LoopInterface $loop)
    {
        $this->client = $client;
        $this->loop = $loop;
    }


    public function parse(array $urls = [], int $timeout = 5, int $concurrencyLimit = 10)
    {
        $queue = $this->initQueue($concurrencyLimit);
        foreach ($urls as $url) {
            $promise = $queue($url)->then(
                function (\Psr\Http\Message\ResponseInterface $response) {
                    $this->parsed[] = $this->extractFromHtml((string)$response->getBody());
                }
            );

            $this->loop->addTimer($timeout, function () use ($promise) {
                $promise->cancel();
            });
        }
    }


    public function extractFromHtml($html)
    {
        $crawler = new Crawler($html);

        $name = $crawler->filter('.c-product-detail__name')->text();
        $price = $crawler->filter('.c-product-detail-price')->attr('data-reduced-price');
        $images = (array) $crawler->filter('a.c-product-image-gallery__image')->attr('src');
        $stock = preg_replace('/[^0-9]+/', '', $crawler->filter('.qa-pd-stock')->text());
        $weight = preg_replace('/[^0-9]+/', '', $crawler->filter('.qa-pd-weight-value')->text());
        $condition = $crawler->filter('.qa-pd-condition-value > span.c-label')->text();
        $description = trim($crawler->filter('.qa-pd-description')->html(), "\n");
        $assurance = 'Tidak';
        $courier = 'jner|j&tr';

        return [
            'name' => $name,
            'price' => $price,
            'images' => $images,
            'stock' => $stock,
            'weight' => $weight,
            'condition' => $condition,
            'assurance' => $assurance,
            'courier' => $courier
        ];
    }


    public function response()
    {
        return $this->parsed;
    }


    protected function initQueue(int $concurrencyLimit)
    {
        return new \Clue\React\Mq\Queue($concurrencyLimit, null, function ($url) {
            return $this->client->get($url);
        });
    }
}