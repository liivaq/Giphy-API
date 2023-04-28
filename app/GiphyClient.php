<?php declare(strict_types=1);

namespace App;

use App\Models\Gif;
use GuzzleHttp\Client;

class GiphyClient
{
    private Client $client;
    private string $apiKey;
    private int $limit;
    private array $collection = [];

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

    public function search(): ?array
    {
        $parameters = [
            'query' => [
                'q' => $_GET['search'] ?? 'coding',
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