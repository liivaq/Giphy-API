<?php declare(strict_types=1);

namespace App\Controllers;

use App\ApiClient;
use App\Modules\GifCollection;

class Controller
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function searchGifs(): GifCollection
    {
        if (!empty($_GET['search'])) {
            return $this->client->search();
        }
        return $this->trending();
    }

    public function trending(): GifCollection
    {
        return $this->client->getTrending();
    }

    public function loadView($collection){
        $gifs = $collection;
        include_once 'app/View/index.view.php';
    }
}