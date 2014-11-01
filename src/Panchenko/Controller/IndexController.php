<?php

namespace Panchenko\Controller;

use Symfony\Component\HttpFoundation\Response;


class IndexController
{
    protected $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function indexAction()
    {
        return new Response($this->twig->render('index.html.twig'));
    }
}
