<?php declare(strict_types=1);

namespace App\Controllers;

use App\ApiClient;
use App\Models\Gif;

class GifController
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function search(): ?array
    {
        $response = $this->client->searchGifs();

        if (!$response) {
            return null;
        }

        return $this->getGifs($response);
    }

    public function trending(): ?array
    {
        $response = $this->client->getTrending();

        if (!$response) {
            return null;
        }

       return $this->getGifs($response);
    }

    public function random(): ?array
    {
        $response = $this->client->getRandomGif();

        if (!$response) {
            return null;
        }

        return $this->getGifs($response);
    }

    private function getGifs($response): array
    {
        $gifs = [];
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