<?php

namespace Panchenko\Controller;

use Symfony\Component\HttpFoundation\Response;


class IndexController
{
    public function indexAction()
    {
        return new Response('Hello world!');
    }
}
