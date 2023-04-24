<?php declare(strict_types=1);

namespace App\Modules;

class Gif
{
    private string $title;
    private string $url;
    private string $link;

    public function __construct(string $title, string $url, string $link)
    {
        $this->url = $url;
        $this->title = $title;
        $this->link = $link;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getGiphyLink(): string
    {
        return $this->link;
    }
}