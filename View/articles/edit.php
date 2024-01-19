<?php require 'View/includes/header.php'?>

<section>
    <h1>Edit</h1>
    <label for="title">Title: </label>
    <input type="text" name="title" id="title" value="<?= $article->title ?>">
    <label for="description">Description: </label>
    <input type="text" name="description" id="description"value="<?= $article->description ?>">
    <label for="imageUrl">Image URL:  </label>
    <input type="text" name="imageUrl" id="imageUrl"value="<?= $article->imageUrl ?>">
    <label for="label">Label: </label>
    <input type="text" name="label" id="label"value="<?= $article->label ?>">
    <a href="">Submit</a>
    
</section>

<?php require 'View/includes/footer.php'?>