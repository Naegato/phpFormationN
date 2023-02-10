<?php

namespace App\Controller;

use App\Abstract\AbstractController;

class FrameworkController extends AbstractController
{
    public function index() {
        return $this->twigRender('/frameworkController/index.html.twig', ['lang' => 'fr']);
    }

    public function notFound($route) {
        return $this->twigRender('/frameworkController/notFound.html.twig', ['lang' => 'fr', 'route' => $route]);
    }
}