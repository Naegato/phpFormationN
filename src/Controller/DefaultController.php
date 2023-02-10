<?php

namespace App\Controller;

use App\Abstract\AbstractController;
use App\Attributes\RouteAttribute;
use App\Utils\Hello;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function __construct(private Hello $hello)
    {
    }

    public function defaultRender(): Response
    {
        return (new Response($this->hello->hello()));
    }

    public function bye(): Response
    {
        return new Response($this->hello->bye());
    }


    #[RouteAttribute('/balabala')]
    public function bye2(): Response
    {
        return $this->twigRender('defaultController/testId.html.twig', ['lang' => 'fr', 'id' => $this->hello->bye()]);
    }

    public function twig(): Response
    {
        return $this->twigRender('defaultController/index.html.twig', ['lang' => 'fr']);
    }

    public function twigWithId($id): Response {
        return $this->twigRender('defaultController/testId.html.twig', ['lang' => 'fr', 'id' => $id]);
    }

    public function anotherTest($name, $id): Response {
        return $this->twigRender('defaultController/anotherTest.html.twig', ['lang' => 'fr', 'id' => $id, 'name' => $name]);
    }

    public function anotherTest2($name): Response {
        return $this->twigRender('defaultController/testId.html.twig', ['lang' => 'fr', 'id' => $name]);
    }
}