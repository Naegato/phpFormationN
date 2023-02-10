<?php

namespace App\Provider;

use App\Entity\Route;
use App\Interface\ProviderInterface;
use App\Interface\YamlProviderInterface;
use Symfony\Component\Yaml\Yaml;

class YamlRouteProvider implements ProviderInterface, YamlProviderInterface
{
    public function __construct(private string $filepath)
    {
    }

    public function __invoke(): array
    {
        $array = [];
        $fileData = Yaml::parseFile(__DIR__.$this->filepath);

        foreach ($fileData as $key => $value) {
            $array[] = new Route($key, $value['controller'], $value['function'] ?? 'defaultRender');
        }

        return $array;
    }
}