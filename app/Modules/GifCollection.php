<?php declare(strict_types=1);

namespace App\Modules;

class GifCollection
{
    private array $collection;

    public function __construct(object $data)
    {
        $this->fetchGifs($data);
    }

    public function fetchGifs(object $data)
    {
        foreach ($data->data as $gif) {
            $this->collection[] = new \App\Modules\Gif($gif->title, $gif->images->fixed_height->url);
        }
    }

    public function getCollection(): array
    {
        return $this->collection;
    }

    public function display()
    {/** @var Gif $gif */
        foreach ($this->getCollection() as $gif) {
            echo "<img src='{$gif->getUrl()}' alt='{$gif->getTitle()}'>" . PHP_EOL;
        }
    }

}