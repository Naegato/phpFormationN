<?php

use App\Framework\Kernel;

require_once dirname(__DIR__) . '/src/Framework/Autoloader.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

new Kernel();