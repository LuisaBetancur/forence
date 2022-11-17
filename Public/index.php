<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';

// Create App
$app = AppFactory::create();
$app->setBasePath('/ejemplo_slim/Public');

// Create Twig
$twig = Twig::create(__DIR__.'/../src/templates', ['cache' => false]);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

// Define named route
$app->get('/', function ($request, $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'inicio.html',[
        'active' => 'inicio'
    ]);
});


// Run app
$app->run();