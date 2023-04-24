<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\Controllers\Controller;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$controller = new Controller();
$gifs = $controller->searchGifs()->getCollection();
$controller->loadView($gifs);