<?php

namespace App\Controllers;

use App\ApiClient;
use App\Modules\Gif;

class GifController
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function showGifs(): array
    {
        $gifs = [];
        if (empty($_GET['search'])) {
            $response = $this->client->getTrending();
        } else {
            $response = $this->client->searchGifs();
        }
        /** @var Gif $gif */
        foreach ($response as $gif) {
            $gifs[] = [
                'title' => $gif->getTitle(),
                'url' => $gif->getUrl(),
                'link' => $gif->getGiphyLink()
            ];
        }
        return $gifs;
    }
}