<?php require 'View/includes/header.php'?>

<?php // Use any data loaded in the controller here ?>

<section>
    <h1>Articles</h1>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li><?= $article->title ?></li>
            <li>Published: <?= $article->publishDate ?></li>
            <a href="index.php?page=articles-show&id=<?= $article->id ?>">More info</a>
        <?php endforeach; ?>
    </ul>
</section>

<?php require 'View/includes/footer.php'?>