<?php

namespace App\Abstract;

use App\Interface\ControllerInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AbstractController implements ControllerInterface
{
    public function twigRender(string $path, array $options = []): Response
    {
        $loader = new FilesystemLoader(__DIR__.'/../templates');
        $twig = new Environment($loader);

        try {
            return new Response($twig->render($path, $options));
        } catch (\Throwable) {
            return new Response('Probleme Occured', 500);
        }
    }
}