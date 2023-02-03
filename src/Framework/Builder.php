<?php

namespace App\Framework;

use Symfony\Component\Yaml\Yaml;

class Builder {

    public static function build(string $filePath, Container $container): void
    {
        $fileData = Yaml::parseFile($filePath);

        foreach ($fileData as $key => $value) {
            $container->setDependency($key, $value['class'], $value['args'], routes: $value['routes'] );
        }
    }
};