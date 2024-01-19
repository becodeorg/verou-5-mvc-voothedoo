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

    public function editArticle()
  {
    $articles = $this->getArticles();
    require 'View/articles/edit.php';
  }

  // Note: this function can also be used in a repository - the choice is yours
  public function getArticles()
  {
    try {
      $connection = $this->databaseManager->connection;
      $tableName = 'articles';
      $query = "SELECT * FROM $tableName";
      $statement = $connection->query($query);
      $rawArticles = $statement->fetchAll();
      
      foreach ($rawArticles as $rawArticle) {
        $articles[] = new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date'], $rawArticle['image_url'], $rawArticle['important']);
      }

    } catch (PDOException $e) {
      echo "Query Failed: " . $e->getMessage();
    }
    // printR($articles);
    return $articles;
  }

  public function showArticle() 
  {
    $article = $this->show();
    require 'View/articles/show.php';
  }

  public function show()
  {
    try {
      $connection = $this->databaseManager->connection;
      $tableName = 'articles';
      $id = $_GET['id'];
      $query = "SELECT * FROM $tableName WHERE id = $id";
      $statement = $connection->query($query);
      $rawArticle = $statement->fetchAll();
      $article = new Article($rawArticle[0]['id'], $rawArticle[0]['title'], $rawArticle[0]['description'], $rawArticle[0]['publish_date'], $rawArticle[0]['image_url'], $rawArticle[0]['important']);
      return $article;

    }catch (PDOException $e) {
      echo "Query Failed: " . $e->getMessage();
    }
  }





}