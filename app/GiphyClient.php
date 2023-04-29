<?php declare(strict_types=1);

namespace App;

use App\Models\Category;
use App\Models\Gif;
use GuzzleHttp\Client;

class GiphyClient
{
    private Client $client;
    private string $apiKey;
    private int $limit;
    private array $collection = [];
    private array $categories = [];

    public function __construct($limit = 30)
    {
        $this->client = new Client([
            'base_uri' => 'https://api.giphy.com/'
        ]);
        $this->apiKey = $_ENV['API_KEY'];
        $this->limit = $limit;
    }

    public function getTrending(): ?array
    {
        $parameters = [
            'query' => [
                'api_key' => $this->apiKey,
                'limit' => $this->limit,
            ]
        ];

        $gifs = $this->client->get('v1/gifs/trending', $parameters);
        return $this->fetch($gifs);
    }

    public function search(string $subcategory = null): ?array
    {
        $parameters = [
            'query' => [
                'q' => $_GET['search'] ?? $subcategory ?? 'coding',
                'api_key' => $this->apiKey,
                'limit' => $this->limit,
            ]
        ];

        $gifs = $this->client->get('v1/gifs/search?', $parameters);
        return $this->fetch($gifs);
    }

    public function getRandom(): array
    {
        $parameters = [
            'query' => [
                'api_key' => $this->apiKey,
            ]
        ];

        $response = $this->client->get('v1/gifs/random?', $parameters);
        $gif = json_decode($response->getBody()->getContents());
        $this->collection[] = new Gif(
            $gif->data->title,
            $gif->data->images->fixed_height->url,
            $gif->data->url
        );
        return $this->collection;
    }

    public function getCategories(string $categoryName = null): ?array
    {
        $parameters = [
            'query' => [
                'api_key' => $this->apiKey,
            ]
        ];

        $response = $this->client->get('v1/gifs/categories', $parameters);
        $categories = json_decode($response->getBody()->getContents())->data;

        foreach ($categories as $category) {
            $name = $category->name;
            $url = $category->gif->images->fixed_width->url;
            $subcategories = [];
            foreach ($category->subcategories as $subcategory) {
                $subcategories[] = $subcategory->name;
            }
            $this->categories[$name] = new Category($name, $subcategories, $url);
        }

        if ($categoryName) {
            if (!$this->categories[$categoryName]) {
                return null;
            }
            return $this->categories[$categoryName]->getSubcategories();
        }

        return $this->categories;
    }

    private function fetch(object $gifs): ?array
    {
        $gifs = json_decode($gifs->getBody()->getContents())->data;
        foreach ($gifs as $gif) {
            $this->collection[] = new Gif(
                $gif->title,
                $gif->images->fixed_height->url,
                $gif->url
            );
        }
        if (empty($this->collection)) {
            return null;
        }
        return $this->collection;
    }
}