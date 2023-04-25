<?php declare(strict_types=1);

namespace App\Modules;

class GifCollection
{
    private array $collection = [];

    public function __construct(object $gifs)
    {
        $this->fetchGifs($gifs);
    }

    public function fetchGifs(object $gifs): void
    {
        foreach ($gifs->data as $gif) {
            $this->collection[] = new Gif(
                $gif->title,
                $gif->images->fixed_height->url,
                $gif->url
            );
        }
    }

    public function getCollection(): array
    {
        return $this->collection;
    }

}