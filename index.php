<?php

require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Panchenko\Kernel\AppKernel;

$request = Request::createFromGlobals();

$kernel = new AppKernel();
$response = $kernel->handle($request);

$response->send();
