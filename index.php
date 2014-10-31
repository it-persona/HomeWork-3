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
$response = $dispatcher->dispatch($request->getMethod(), parse_url($request->getPathInfo(), PHP_URL_PATH));

$response->send();
