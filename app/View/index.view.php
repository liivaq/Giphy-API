<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Giphy App</title>
    <style>
        #header {
            text-align: center;
            background-color: black;
            color: ivory;
            padding: 5px;
        }

        #form {
            text-align: center;
        }

        #gif {
            height: 150px;
            margin: 10px;
            border: 3px solid black;
        }

        #gifs {
            background-color: darkcyan;
            text-align: center;
        }
    </style>
</head>
<body>
<header id="header">
    <h1>Giphy App</h1>
</header>
<div id="gifs">
    <form id="form" action="" method="GET">
        <br>
        <label for="search"></label>
        <input type="text" name="search" id="search" placeholder="Search for gifs">
        <input type="submit" value="Search"><br>
        <br>
    </form>

    <?php

    use App\Modules\Gif;

    /** @var Gif $gif */
    foreach ($gifs as $gif) :?>
        <a href="<?= $gif->getGiphyLink() ?>" target="_blank">
            <img id="gif" src='<?= $gif->getUrl() ?>' alt='<?= $gif->getTitle() ?>'>
        </a>
    <?php endforeach; ?>
</div>
</body>
</html>