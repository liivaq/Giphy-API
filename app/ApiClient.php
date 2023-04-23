<?php declare(strict_types=1);

namespace App;

use App\Modules\GifCollection;
use GuzzleHttp\Client;

class ApiClient
{
    private Client $client;
    private string $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = $_ENV['API_KEY'];
    }

    public function getTrendingGifs($limit = 10): GifCollection
    {
        $gifs = $this->client->get('http://api.giphy.com/v1/gifs/trending?api_key=' . $this->apiKey . '&limit=' . $limit);
        return new GifCollection(json_decode($gifs->getBody()->getContents()));
    }

    public function searchGifs($input, $limit = 10): GifCollection
    {
        $gifs = $this->client->get('http://api.giphy.com/v1/gifs/search?q=' . $input . '&api_key=' . $this->apiKey . '&limit=' . $limit);
        return new GifCollection(json_decode($gifs->getBody()->getContents()));
    }

    public function getRandomGif($limit = 10): GifCollection
    {
        $gifs = $this->client->get('http://api.giphy.com/v1/gifs/random?api_key=' . $this->apiKey . '&limit=' . $limit);
        var_dump(json_decode($gifs->getBody()->getContents()));
        return new GifCollection(json_decode($gifs->getBody()->getContents()));
    }

}