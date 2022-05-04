<?php

namespace App;

use Fatfingers23\ReplitDatabaseClient\DatabaseClient;


/**
* Class for interacting with the Replit database
*/
class Database
{

  protected DatabaseClient $client;
  protected string $userId;
  protected \SlimSession\Helper $session;
  protected string $todoPrefix;
  function __construct()
  {
    $this->client = new DatabaseClient();
    
    $this->session = new \SlimSession\Helper();
    $this->userId = $this->session::id();
    $this->todoPrefix = "$this->userId:todo:";
  }


  public function getUsersTodoList()
  {
    return $this->client->getPrefix($this->todoPrefix);
  }

  public function addTodo(string $description)
  {
    $key = $this->todoPrefix . uniqid();

    $newTodo = $this->makeTodoArray($description, false);    
    $this->client->set($key, $newTodo);
  }

  public function deleteTodo(string $id){
    $this->client->delete($id);
  }

  public function setCompleted(string $id, bool $completed){
    $todo = $this->client->get($id);
    $todo["completed"] = $completed;
    $this->client->set($id, $todo);
    
  }
  private function makeTodoArray(string $description, bool $completed)
  {
    return [
      'description' => $description,
      'completed' => $completed,
    ];
  }
}

