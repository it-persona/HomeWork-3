<?php

namespace Panchenko\Kernel;

class AppKernel extends Kernel
{
    public function getRoutes()
    {
        return array(
            ['GET', '/', 'Panchenko\Controller\IndexController:indexAction'],
            ['GET', '/animals', 'Panchenko\Controller\AnimalController:getAnimalsAction'],
            ['GET', '/animals/{animalId}', 'Panchenko\Controller\AnimalController:getAnimalAction'],
//            [404, '', 'Panchenko\Controller\Error404Controller:errorAction'],
        );
    }

    public function getTemplateHandler()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../../app/views');
        $twig = new \Twig_Environment($loader);

        return $twig;
    }
} 