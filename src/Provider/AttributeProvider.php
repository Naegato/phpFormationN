<?php

namespace App\Provider;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

abstract class AttributeProvider
{
    protected function classes_in_namespace($namespace) {
        $folder = str_replace('\\',DIRECTORY_SEPARATOR, str_replace('App', '/../../src', $namespace));
        $path = __DIR__.$folder;
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        $classes = array();
        foreach ($iterator as $file) {
            if (!$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }
            $namespace_tokens = explode('\\', $namespace);
            $in_namespace = false;
            $in_class = false;
            $handle = $file->openFile();
            while (!$handle->eof()) {
                $line = $handle->fgets();
                if (preg_match('/^namespace\s+([a-zA-Z0-9\\\\_]+)\s*;/m', $line, $matches)) {
                    $in_namespace = ($matches[1] === $namespace);
                }
                if ($in_namespace) {
                    if (preg_match('/^class\s+([a-zA-Z0-9_]+)\s*/', $line, $matches)) {
                        $class = $matches[1];
                        $in_class = true;
                    } elseif ($in_class && preg_match('/^}/', $line)) {
                        $classes[] = $namespace.'\\'.$class;
                        $in_class = false;
                    }
                }
            }
        }

        return $classes;
    }
}