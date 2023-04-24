<?php declare(strict_types=1);

namespace App\Modules;

class GifCollection
{
    private array $collection = [];

    public function __construct(object $data)
    {
        $this->fetchGifs($data);
    }

    public function fetchGifs(object $data): void
    {
        foreach ($data->data as $gif) {
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