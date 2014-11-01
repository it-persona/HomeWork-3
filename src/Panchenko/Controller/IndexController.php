<?php

namespace Panchenko\Controller;

use Symfony\Component\HttpFoundation\Response;


class IndexController
{
    public function indexAction()
    {
        return new Response('<h1>Homepage</h1>Hello world!');
    }
}
