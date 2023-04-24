<?php declare(strict_types=1);

namespace App;

use App\Modules\GifCollection;
use GuzzleHttp\Client;

class ApiClient
{
    private Client $client;
    private string $apiKey;
    private int $limit = 30;
    private string $url = 'https://api.giphy.com/v1/gifs';

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = $_ENV['API_KEY'];
    }

    public function getTrending(): ?GifCollection
    {
        $gifs = $this->client->get($this->url . '/trending?api_key=' . $this->apiKey . '&limit=' . $this->limit);
        return new GifCollection(json_decode($gifs->getBody()->getContents()));
    }

    public function searchGifs(): ?GifCollection
    {
        if(empty($_GET['search'])){
            return $this->getTrending();
        }

        $gifs = $this->client->get
        ($this->url . '/search?q=' . $_GET['search'] . '&api_key=' . $this->apiKey . '&limit=' . $this->limit);
        return new GifCollection(json_decode($gifs->getBody()->getContents()));
    }

}