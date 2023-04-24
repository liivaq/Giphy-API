<?php declare(strict_types=1);

namespace App;

use App\Modules\GifCollection;
use GuzzleHttp\Client;

class ApiClient
{
    private Client $client;
    private string $apiKey;
    private int $limit;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.giphy.com/'
        ]);
        $this->apiKey = $_ENV['API_KEY'];
        $this->limit = 30;
    }

    public function getTrending(): GifCollection
    {
        $parameters = [
            'query' => [
                'api_key' => $this->apiKey,
                'limit' => $this->limit,
            ]
        ];

        $gifs = $this->client->get('v1/gifs/trending', $parameters);
        return new GifCollection(json_decode($gifs->getBody()->getContents()));
    }

    public function searchGifs(): GifCollection
    {
        if (empty($_GET['search'])) {
            return $this->getTrending();
        }

        $parameters = [
            'query' => [
                'q' => $_GET['search'],
                'api_key' => $this->apiKey,
                'limit' => $this->limit,
            ]
        ];

        $gifs = $this->client->get
        ('v1/gifs/search?', $parameters);
        return new GifCollection(json_decode($gifs->getBody()->getContents()));
    }
}