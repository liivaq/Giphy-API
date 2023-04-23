<?php declare(strict_types=1);

namespace App\Modules;

class Gif
{
    private string $title;
    private string $url;

    public function __construct(string $title, string $url)
    {
        $this->url = $url;
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

}