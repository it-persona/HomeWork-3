<?php

require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
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
    print('<b style="color: red">Error 404: Page not found</b>');
    die();
} catch (Phroute\Exception\HttpMethodNotAllowedException $e) {
    var_dump($e);
    die();
}
$response->send();
