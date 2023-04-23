<?php declare(strict_types=1);

require_once 'vendor/autoload.php';
require_once 'app/View/index.view.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$client = new \App\ApiClient();

if(!empty($_GET['search'])){
    $client->searchGifs($_GET['search'])->display();
}else{
    $client->searchGifs('coding')->display();
}


