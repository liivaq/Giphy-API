<?php declare(strict_types=1);

namespace App;

use App\Modules\GifCollection;
use GuzzleHttp\Client;

class ApiClient
{
    private Client $client;
    private string $apiKey;
    private int $limit = 30;
    private string $url = 'http://api.giphy.com/v1/gifs';

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = $_ENV['API_KEY'];
    }

    public function getTrendingGifs(): GifCollection
    {
        $gifs = $this->client->get($this->url.'/trending?api_key=' . $this->apiKey . '&limit=' . $this->limit);
        return new GifCollection(json_decode($gifs->getBody()->getContents()));
    }

    public function searchGifs($input): GifCollection
    {
        $gifs = $this->client->get
        ($this->url.'/search?q=' . $input . '&api_key=' . $this->apiKey . '&limit=' . $this->limit);
        return new GifCollection(json_decode($gifs->getBody()->getContents()));
    }

    public function getRandomGif(): GifCollection
    {
        $gifs = $this->client->get($this->url.'/random?api_key=' . $this->apiKey . '&limit=' . $this->limit);
        var_dump(json_decode($gifs->getBody()->getContents()));
        return new GifCollection(json_decode($gifs->getBody()->getContents()));
    }

}