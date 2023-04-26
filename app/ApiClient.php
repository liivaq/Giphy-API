<?php declare(strict_types=1);

namespace App;

use App\Modules\Gif;
use GuzzleHttp\Client;

class ApiClient
{
    private Client $client;
    private string $apiKey;
    private int $limit;
    private array $collection = [];

    public function __construct($limit = 30)
    {
        $this->client = new Client([
            'base_uri' => 'https://api.giphy.com/'
        ]);
        $this->apiKey = $_ENV['API_KEY'];
        $this->limit = $limit;
    }

    public function getTrending(): array
    {
        $parameters = [
            'query' => [
                'api_key' => $this->apiKey,
                'limit' => $this->limit,
            ]
        ];

        $gifs = $this->client->get('v1/gifs/trending', $parameters);
        return $this->fetchGifs(json_decode($gifs->getBody()->getContents()));
    }

    public function searchGifs(): array
    {
        $parameters = [
            'query' => [
                'q' => $_GET['search'] ?? 'coding',
                'api_key' => $this->apiKey,
                'limit' => $this->limit,
            ]
        ];

        $gifs = $this->client->get('v1/gifs/search?', $parameters);
        return $this->fetchGifs(json_decode($gifs->getBody()->getContents()));
    }

    private function fetchGifs(object $gifs): array
    {
        foreach ($gifs->data as $gif) {
            $this->collection[] = new Gif(
                $gif->title,
                $gif->images->fixed_height->url,
                $gif->url
            );
        }
        return $this->collection;
    }
}