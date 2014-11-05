<?php

require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Panchenko\Kernel\AppKernel;
//use Symfony\Component\HttpFoundation\Response;
//use Phroute\RouteCollector;
//use Panchenko\Controller\AnimalController;
//use Panchenko\Controller\IndexController;

$request = Request::createFromGlobals();

$kernel = new AppKernel();
$response = $kernel->handle($request);

$response->send();

//$loader = new Twig_Loader_Filesystem(__DIR__ . '/app/views');
//$twig = new Twig_Environment($loader);
//
//$animalController = new AnimalController($twig);
//$indexController = new IndexController($twig);
//
//$router = new RouteCollector();
//
//$router->get('/', [$indexController, 'indexAction']);
//$router->get('/animals', [$animalController, 'getAnimalsAction']);
//$router->get('/animals/{animalId}', [$animalController, 'getAnimalAction']);
//
//$dispatcher = new Phroute\Dispatcher($router);
//
//try {
//    $response = $dispatcher->dispatch($request->getMethod(), parse_url($request->getPathInfo(), PHP_URL_PATH));
//} catch (Phroute\Exception\HttpRouteNotFoundException $e) {
//    $response = new Response($twig->render('error404.html.twig'));
//} catch (Phroute\Exception\HttpMethodNotAllowedException $e) {
//    $response = new Response(sprintf('<h1 style="color: red">Error 405:</h1><b style="color: red">Url was matched but method "%s" is not allowed</b>', $e));
//}
//
//$response->send();
