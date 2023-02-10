<?php

namespace App\Provider;

use App\Entity\Dependency;
use App\Entity\Route;
use App\Interface\ProviderInterface;
use App\Interface\YamlProviderInterface;
use Symfony\Component\Yaml\Yaml;

class YamlDependencyProvider implements YamlProviderInterface, ProviderInterface
{
    public function __construct(private readonly string $filepath)
    {
    }

    public function __invoke(): array
    {
        $array = [];
        $fileData = Yaml::parseFile(__DIR__.$this->filepath);

        foreach ($fileData as $key => $value) {
            $dependencyProperties = [
                ($key ? ['key' => $key] : []),
                ($value['instance'] ? ['instance' => $value['instance']] : []),
                ($value['class'] ? ['class' => $value['class']] : []),
                ($value['args'] ? ['args' => $value['args']] : []),
                ($value['use'] ? ['use' => $value['use']] : []),
                ($value['builder'] ? ['builder' => $value['builder']] : []),
            ];

            $dependencyProperties = array_merge(...$dependencyProperties);

            $array[] = new Dependency(...$dependencyProperties);
        }

        return $array;
    }
}