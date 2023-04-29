<?php declare(strict_types=1);

namespace App\Models;
class Category
{
    private string $name;
    private array $subcategories;
    private string $url;

    public function __construct(string $name, array $subcategories, string $url)
    {
        $this->name = $name;
        $this->subcategories = $subcategories;
        $this->url = $url;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSubcategories(): array
    {
        return $this->subcategories;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}