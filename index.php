<?php

require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Phroute\RouteCollector;
use Panchenko\Controller\AnimalController;
use Panchenko\Controller\IndexController;

$request = Request::createFromGlobals();

$animalController = new AnimalController();
$indexController = new IndexController();

$router = new RouteCollector();

$router->get('/', [$indexController, 'indexAction']);
$router->get('/animals', [$animalController, 'getAnimalsAction']);
$router->get('/animals/{animalId}', [$animalController, 'getAnimalAction']);

$dispatcher = new Phroute\Dispatcher($router);

try {
    $response = $dispatcher->dispatch($request->getMethod(), parse_url($request->getPathInfo(), PHP_URL_PATH));
} catch (Phroute\Exception\HttpRouteNotFoundException $e) {
    $response = new Response('<h1 style="color: red">Error 404:</h1><b style="color: red">Page not found</b>', 404);
} catch (Phroute\Exception\HttpMethodNotAllowedException $e) {
    $response = new Response(sprintf('<h1 style="color: red">Error 405:</h1><b style="color: red">Url was matched but method "%s" is not allowed</b>', $e));
}

$response->send();
