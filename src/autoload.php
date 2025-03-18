<?php

// Loads the composer autoload if it exists, otherwise load the classes manually.
$composer_autoload = __DIR__.'/../vendor/autoload.php';

if (file_exists($composer_autoload)) {
    require_once $composer_autoload;
} else {
    require_once 'CambioReal/CambioReal.php';
    require_once 'CambioReal/Config.php';
    require_once 'CambioReal/Http/Request.php';
    require_once 'CambioReal/Action/AbstractAction.php';
    require_once 'CambioReal/Action/Factory.php';
    require_once 'CambioReal/Action/Validator.php';
    require_once 'CambioReal/Action/Request.php';
    require_once 'CambioReal/Action/RequestV2.php';
    require_once 'CambioReal/Action/Cancel.php';
    require_once 'CambioReal/Action/Get.php';
    require_once 'CambioReal/Action/RegisterAccount.php';
    require_once 'CambioReal/Action/Simulator.php';
}
