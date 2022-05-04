<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Slim\Middleware\Session;
use Slim\Factory\AppFactory;

use App\Database;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

//Sets up a helper for PHP sessions
$app->add(
  new Session([
    'autorefresh' => true,
    'lifetime' => '1 year',
  ])
);

// Create Twig and link to html templates
$twig = Twig::create('../templates', ['cache' => false]);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));


//Main page that shows the todo list
$app->get('/', function (Request $request, Response $response, $args) {
  $view = Twig::fromRequest($request);
  $db = new Database();
  $todos = $db->getUsersTodoList();
  return $view->render($response, 'todo.html', [
    'todos' => $todos
  ]);
});

//Rest end point to add a new todo lsit item
$app->post('/add', function ($request, $response) {
  $submittedForm = $request->getParsedBody();
  $db = new Database();
  $db->addTodo($submittedForm["new_todo"]);

  return $response
    ->withHeader('Location', '/')
    ->withStatus(302);
});

//Endpoint to handle setting the task done or deleteing it
$app->post('/edit', function ($request, $response) {

  $submittedForm = $request->getParsedBody();
  $db = new Database();
  $id = $submittedForm['id'];
  if (key_exists('remove', $submittedForm)) {
    $db->deleteTodo($id);
  }else if(key_exists('done', $submittedForm)){
    $db->setCompleted($id, true);
  }else if(key_exists('not_done', $submittedForm)){
        $db->setCompleted($id, false);
  }
  
  return $response
    ->withHeader('Location', '/')
    ->withStatus(302);
});


$app->run();
