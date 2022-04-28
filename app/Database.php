<?php

namespace App;

use Fatfingers23\ReplitDatabaseClient\DatabaseClient;

class Database
{

  protected DatabaseClient $client;
  protected string $userId;

  function __construct(string $userId)
  {
    $this->client = new DatabaseClient();
    $this->userId = $userId;
  }


  public function getUsersTodoList()
  {
    return $this->client->get("$this->userId:todo");
  }

  public function addTodo(string $description)
  {
    $key = "$this->userId:todo";
    $todoArray = $this->client->get($key);
    var_dump($todoArray);
    if ($todoArray == null) {
      $todoArray = [];
    }
    var_dump($todoArray);
    $todoArray[] = $this->makeTodoArray($description, false);
    var_dump($todoArray);
    $this->client->set($key, $todoArray);
  }

  private function makeTodoArray(string $description, bool $completed)
  {
    return [
      'description' => $description,
      'completed' => $completed
    ];
  }
}
