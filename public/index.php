<?php
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Slim\Middleware\Session;
use App\Database;
require __DIR__ . '/../vendor/autoload.php';


$app = AppFactory::create();

$app = \Slim\Factory\AppFactory::create();
$app->add(
  new Session([
    'autorefresh' => true,
    'lifetime' => '1 year',
  ])
);




// Create Twig
$twig = Twig::create('../templates', ['cache' => false]);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));


$app->get('/', function (Request $request, Response $response, $args) {
  $view = Twig::fromRequest($request);
  $session = new \SlimSession\Helper();
  echo  $session::id();
  return $view->render($response, 'todo.html', [
    'name' => 'Hey'
  ]);
});

$app->run();
