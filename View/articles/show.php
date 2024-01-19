<?php require 'View/includes/header.php'?>

<?php // Use any data loaded in the controller here ?>

<section>
    <h1><?= $article->title ?></h1>
    <a href="index.php?page=articles-edit&id=<?= $article->id ?>">Edit Article</a>
    <p><?= $article->formatPublishDate() ?></p>
    <p><?= $article->description ?></p>
    <p><img src="<?= $article->imageUrl ?>" alt=""></p>
    <?php // TODO: links to next and previous ?>
    <a href="index.php?page=articles-show&id=<?= $article->id - 1 ?>">Previous article</a>
    <a href="index.php?page=articles-show&id=<?= $article->id + 1 ?>">Next article</a>
</section>

<?php require 'View/includes/footer.php'?>