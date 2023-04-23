<?php

use Dotenv\Dotenv;

require_once 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$gifs = (new \App\ApiClient())->getTrendingGifs(5)->getCollection();

foreach ($gifs as $gif) {
    echo "<img src='{$gif->getUrl()}' alt='{$gif->getTitle()}'>".PHP_EOL;
}


