<?php

namespace App\Framework;
class Autoloader
{

    static function register()
    {
        spl_autoload_register(function ($class) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, str_replace('App', '..\src', $class)) . '.php';

            if (file_exists($file)) {
                require $file;
                return true;
            }
            return false;
        });
    }
}

Autoloader::register();

