<?php

namespace App\Framework;

use App\Interface\ControllerInterface;
use Symfony\Component\HttpFoundation\Response;

class Router {
    private array $routesContainer = [];

    public function setRoute(string $route, ControllerInterface $dependency, string $function = null)
    {
        $this->routesContainer[$route] = [$dependency, $function];
    }

    public function getRoute(string $route) {
        if (count($this->routesContainer) === 2) {
            return $this->routesContainer['index'];
        }

        if (str_ends_with($route, '/')) {
            while (str_ends_with($route, '/')) {
                $route = substr($route, 0, -1);
            }

            return new Response($route, Response::HTTP_TEMPORARY_REDIRECT);
        }

        $data = $this->routesContainer[$route];

        if (!$data) {

            $possibleRoute = [];

            foreach ($this->routesContainer as $routeFile => $value) {
                $routeRequestArray = explode('/', $route);
                $routeFileArray = explode('/', $routeFile);

                if (count($routeRequestArray) === count($routeFileArray)) {
                    foreach ($routeFileArray as $key => $value) {
                        if ($value === $routeRequestArray[$key]) {
                            $possibleRoute[$routeFile]['score'] = ($possibleRoute[$routeFile]['score'] ?? 0) + 2;
                            $possibleRoute[$routeFile]['key'] = $routeFile;
                        } else {
                            if (preg_match("/\{.+\}/",$value, $match)) {
                                $possibleRoute[$routeFile]['score'] = ($possibleRoute[$routeFile]['score'] ?? 0) + 1;

                                if (count($match) > 1) {
                                    throw new \Error("Syntax error in $routeFile");
                                }

                                $possibleRoute[$routeFile]['matches'][substr($match[0], 1, strlen($match[0]) - 2)] = $routeRequestArray[$key];
                                $possibleRoute[$routeFile]['key'] = $routeFile;
                            } else {
                                unset($possibleRoute[$routeFile]);
                            }
                        };
                    }
                }
            }

            usort($possibleRoute, function ($a, $b) {
                return $b['score'] <=> $a['score'];
            });

            $chosenRoute = reset($possibleRoute);

            if ($chosenRoute) {
                $data = [...$this->routesContainer[$chosenRoute['key']], $chosenRoute['matches']] ;
            }
        }


        return $data ?? [...$this->routesContainer['/error/404'], [$route]];
    }

    public function debugRoute(): array
    {
        return $this->routesContainer;
    }
}