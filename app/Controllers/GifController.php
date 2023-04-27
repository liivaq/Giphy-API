<?php declare(strict_types=1);

namespace App\Controllers;

use App\ApiClient;

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

        return $response;
    }

    public function trending(): ?array
    {
        $response = $this->client->getTrending();

        if (!$response) {
            return null;
        }

        return $response;
    }

    public function random(): ?array
    {
        $response = $this->client->getRandomGif();

        if (!$response) {
            return null;
        }

        return $response;
    }
}