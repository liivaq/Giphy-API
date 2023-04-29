<?php declare(strict_types=1);

namespace App\Models;
class Category
{
    private string $name;
    private array $subcategories;

    public function __construct(string $name, array $subcategories)
    {
        $this->name = $name;
        $this->subcategories = $subcategories;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSubcategories(): array
    {
        return $this->subcategories;
    }
}