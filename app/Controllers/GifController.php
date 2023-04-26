<?php declare(strict_types=1);

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

    public function search(): array
    {
        $gifs = [];
        $response = $this->client->searchGifs();

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

    public function trending(): array
    {
        $gifs = [];
        $response = $this->client->getTrending();

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