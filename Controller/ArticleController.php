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
      $articles = $statement->fetchAll();
      
      $rawArticles = [];
      foreach ($rawArticles as $rawArticle) {
        $articles[] = new Article($rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date']);
      }
      return $rawArticles;
    } catch (PDOException $e) {
      echo "Query Failed: " . $e->getMessage();
    }
  }

  public function show()
  {
    // TODO: this can be used for a detail page
  }
}