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

    public function search($subcategory): ?View
    {
        $gifs = $this->giphyClient->search($subcategory);

        if (!$gifs) {
            return null;
        }

        return new View('gifs.twig', ['gifs' => $gifs]);
    }

    public function trending(): ?View
    {
        $gifs = $this->giphyClient->getTrending();

        if (!$gifs) {
            return null;
        }

        return new View('gifs.twig', ['gifs' => $gifs]);
    }

    public function random(): ?View
    {
        $gifs = $this->giphyClient->getRandom();

        if (!$gifs) {
            return null;
        }

        return new View('gifs.twig', ['gifs' => $gifs]);
    }

    public function categories($subcategory): View
    {
        $categories = $this->giphyClient->getCategories($subcategory);
        if (!$subcategory) {
            return new View('categories.twig', ['categories' => $categories]);
        }

        return new View('subcategories.twig', ['categories' => $categories]);
    }
}