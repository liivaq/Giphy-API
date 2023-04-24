<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Giphy App</title>
    <link rel="stylesheet" href="/styles/styles.css">
</head>
<body>
<header>
    <h1>Giphy App</h1>
</header>
<div class="gifs">
    <form class="form" action="" method="GET">
        <br>
        <label for="search"></label>
        <input type="text" name="search" id="search" placeholder="Search for gifs">
        <input type="submit" value="Search"><br>
        <br>
    </form>

    <?php use App\Modules\Gif;

    /** @var Gif $gif */
    foreach ((new App\ApiClient())->searchGifs()->getCollection() as $gif): ?>
        <a href="<?= $gif->getGiphyLink() ?>" target="_blank">
            <img class="gif" src='<?= $gif->getUrl() ?>' alt='<?= $gif->getTitle() ?>'>
        </a>
    <?php endforeach; ?>

</div>
</body>
</html>