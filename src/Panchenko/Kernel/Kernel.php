<?php

namespace Panchenko\Kernel;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Exception\HttpMethodNotAllowedException;
use Phroute\Dispatcher;
use Phroute\RouteCollector;

abstract class Kernel implements KernelInterface
{
    protected $request;

    public function handle(Request $request)
    {
        $this->request = $request;

        $router = $this->handleRoutes($this->getRoutes());
        $dispatcher = new Dispatcher($router);

        try {
            $response = $dispatcher->dispatch($request->getMethod(), parse_url($request->getPathInfo(), PHP_URL_PATH));
        } catch (HttpRouteNotFoundException $e) {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../../app/views');
            $twig = new \Twig_Environment($loader);
            $response = new Response($twig->render('error404.html.twig'));
        } catch (HttpMethodNotAllowedException $e) {
            $response = new Response(sprintf('<h1 style="color: red">Error 405:</h1><b style="color: red">Url was matched but method "%s" is not allowed</b>', $e));
        }

        return $response;
    }

    protected function handleRoutes(array $routes)
    {
        $controllers = $this->getControllers($routes);
        $router = new RouteCollector();

        foreach ($routes as $routeDefinition) {
            list($controller, $method) = explode(':', $routeDefinition[2]);
            $router->{strtolower($routeDefinition[0])}($routeDefinition[1], [$controllers[$controller],$method]);
        }

        return $router;
    }

    protected function getControllers($routes)
    {
        $controllers = array();

        foreach ($routes as $routeDefinition) {
            $controllerMethod = array_pop($routeDefinition);
            list($controller, $method) = explode(':', $controllerMethod);

            $controllers[$controller] = new $controller($this->request, $this->getTemplateHandler());
        }

        return $controllers;
    }
}
