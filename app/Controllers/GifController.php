<?php declare(strict_types=1);

namespace App\Controllers;

use App\GiphyClient;

class GifController
{
    private GiphyClient $giphyClient;

    public function __construct()
    {
        $this->giphyClient = new GiphyClient();
    }

    public function search(): ?array
    {
        $response = $this->giphyClient->search();

        if (!$response) {
            return null;
        }

        return $response;
    }

    public function trending(): ?array
    {
        $response = $this->giphyClient->getTrending();

        if (!$response) {
            return null;
        }

        return $response;
    }

    public function random(): ?array
    {
        $response = $this->giphyClient->getRandom();

        if (!$response) {
            return null;
        }

        return $response;
    }
}