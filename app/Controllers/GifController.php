<?php declare(strict_types=1);

namespace App\Controllers;

use App\GiphyClient;
use App\Models\View;

class GifController
{
    private GiphyClient $giphyClient;

    public function __construct()
    {
        $this->giphyClient = new GiphyClient();
    }

    public function search(): ?View
    {
        $response = $this->giphyClient->search();

        if (!$response) {
            return null;
        }

        return new View('gifs.twig', ['gifs' => $response]);
    }

    public function trending(): ?View
    {
        $response = $this->giphyClient->getTrending();

        if (!$response) {
            return null;
        }

        return new View('gifs.twig', ['gifs' => $response]);
    }

    public function random(): ?View
    {
        $response = $this->giphyClient->getRandom();

        if (!$response) {
            return null;
        }

        return new View('gifs.twig', ['gifs' => $response]);
    }
}