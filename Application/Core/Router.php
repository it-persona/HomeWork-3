<?php
/**
 * route.php
 *
 * @author      Vadym Panchenko <panchenko.vadym@gmail.com>
 * @link        http://www.it-persona.com.ua/
 * @copyright   2010-2014 IT-PERSONA
 * @license     http://www.it-persona.com.ua/license/
 */

/**
 * Class Router
 * @property
 * 
 * $controllerName - Set default (main) controller name;
 * $actionName     - Set index to default action name;
 * $routes         - Http requests route and action array 
 */

class Router
{
    public static function startRouting()
    {
        $controllerName = 'Main';
        $actionName = '';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // Check route and get name of current controller
        if (!empty($routes[1])) {
            $controllerName = ucfirst($routes[1]);
            $controllerName = ucfirst($controllerName);
//            var_dump($controllerName);
        }

        // Check route and get current action name
        if (!empty($routes[2])) {
            $actionName = ucfirst($routes[2]);
        }

        // Add default core indexes to routes
        $modelName = 'Model';
        $actionName = 'action' . $actionName;
        $controllerName = $controllerName . 'Controller';

        // Include model
        $modelFile = $modelName . '.php';
        $modelPath = "Application/Models/" . $modelFile;

        if (file_exists($modelPath)) {
            include "Application/Models/" . $modelFile;
        }

        // Include correct controller class file for requested route
        $controllerFile = $controllerName . '.php';
        $controllerPath = "Application/Controllers/" . $controllerFile;

        if (file_exists($controllerPath)) {
            include "Application/Controllers/" . $controllerFile;
        } else {
        // TODO: Write try catch code construction to correct handling exception Error 404
            Router::actionError404();
        }
        // Create exemplar of class controller for requested URL
        $controller = new $controllerName;
        $action = $actionName;

//        var_dump("Merge action: action" . ucfirst($routes[1]) . ucfirst($routes[2]));

        if (method_exists($controller, $action)) {
            // Call controller action
            $controller->$action();
        } else {
            // TODO: Write try catch code construction to correct handling exception Error 404
            Router::actionError404();
        }
    }

    protected function actionError404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';

        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . 'error404');
    }
}
