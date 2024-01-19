<?php

declare(strict_types = 1);

class ArticleController
{
  protected DatabaseManager $databaseManager;

  public function __construct(DatabaseManager $databaseManager) 
  {
    $this->databaseManager = $databaseManager;
  }

  public function index()
  {
    // Load all required data
    $articles = $this->getArticles();
    // Load the view
    require 'View/articles/index.php';
  }

  // Note: this function can also be used in a repository - the choice is yours
  private function getArticles()
  {
    try {
      $connection = $this->databaseManager->connection;
      $tableName = 'articles';
      $query = "SELECT * FROM $tableName";
      $statement = $connection->query($query);
      $rawArticles = $statement->fetchAll();
      
      foreach ($rawArticles as $rawArticle) {
        $articles[] = new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date'], $rawArticle['image_url'], $rawArticle['label']);
      }

    } catch (PDOException $e) {
      echo "Query Failed: " . $e->getMessage();
    }
    printR($articles);
    return $articles;
  }

  public function showArticle() 
  {
    $this->update();
    $article = $this->show();
    require 'View/articles/show.php';
  }

  private function show()
  {
    try {
      $connection = $this->databaseManager->connection;
      $tableName = 'articles';
      $id = $_GET['id'];
      $query = "SELECT * FROM $tableName WHERE id = $id";
      $statement = $connection->query($query);
      $rawArticle = $statement->fetchAll();
      $article = new Article($rawArticle[0]['id'], $rawArticle[0]['title'], $rawArticle[0]['description'], $rawArticle[0]['publish_date'], $rawArticle[0]['image_url'], $rawArticle[0]['label']);
      return $article;

    }catch (PDOException $e) {
      echo "Query Failed: " . $e->getMessage();
    }
  }

  public function editArticle()
  {
    $article = $this->show();
    require 'View/articles/edit.php';
  }

  public function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

    private function update()
  {
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === "POST"){
      $id = $_GET['id'];
      $title = $this->sanitizeInput($_POST['title']);
      $description = $this->sanitizeInput($_POST['description']);
      $imageUrl = $this->sanitizeInput($_POST['imageUrl']);
      $label = $this->sanitizeInput($_POST['label']);

      if (empty($title)) {
        $errors['title'] = 'Title can not be empty.';
      }
      if (empty($description)) {
        $errors['description'] = 'Description can not be empty.';
      }

      if (empty($errors)) {
        try {
          $connection = $this->databaseManager->connection;
          $tableName = 'articles';
          $query = "UPDATE $tableName SET title = ?, description = ?, image_url = ?, label = ? WHERE id = ?";
          $statement = $connection->prepare($query);
          $statement->bindParam(1, $title, PDO::PARAM_STR);
          $statement->bindParam(2, $description, PDO::PARAM_STR);
          $statement->bindParam(3, $imageUrl, PDO::PARAM_STR);
          $statement->bindParam(4, $label, PDO::PARAM_STR);
          $statement->bindParam(5, $id, PDO::PARAM_INT);
          $statement->execute();
          echo "Updated succesfully";
        } catch (Exception $e){
          echo "Error updating article: " . $e->getMessage();
        }

      } else {
      printR($errors);
      }

    } 
  }

}