<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Giphy App</title>
    <style>
        #header {
            text-align: center;
            background-color: black;
            color: white;
            padding: 10px;
        }
    </style>
</head>
<body>
<header id="header">
    <h1>Gifs for days</h1>
</header>
<form action="" method="GET">
    <br>
    <label for="search"></label>
    <input type="text" name="search" id="search" placeholder="Search for gifs">
    <input type="submit" value="Search"><br>
    <br>
</form>
<?php
$client = new App\ApiClient();
if(!empty($_GET['search'])){
    foreach($client->searchGifs($_GET['search'])->getCollection() as $gif){
        echo "<img src='{$gif->getUrl()}' alt='{$gif->getTitle()}'>" . PHP_EOL;
    }
}else{
    foreach($client->searchGifs('coding')->getCollection() as $gif){
        echo "<img src='{$gif->getUrl()}' alt='{$gif->getTitle()}'>" . PHP_EOL;
    }
} ?>
<!--<form method="POST">
    <input type="submit" name="trending" value="Show Trending">
</form>-->
</body>
</html>