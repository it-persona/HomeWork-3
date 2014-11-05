<?php

namespace Panchenko\Kernel;

use Symfony\Component\HttpFoundation\Request;

interface KernelInterface
{
    public function handle (Request $request);

    public function getRoutes();

    public function getTemplateHandler();
}
