<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Autoload\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\Application;
use Phalcon\Url;
use Phalcon\Di\DiInterface;
use Phalcon\Mvc\ViewBaseInterface;

define('BASE_PATH', dirname(__DIR__)); // /var/www/html
define('APP_PATH', BASE_PATH); // No additional because of docker config /app

ini_set('display_errors', 1);
error_reporting(E_ALL);

$loader = new Loader();

$loader->setDirectories(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
    ]
);

$loader->register();

$container = new FactoryDefault();


$container->setShared(
    'voltService',
    function (ViewBaseInterface $view) use ($container) {
        $volt = new Volt($view, $container);
        $volt->setOptions(
            [
                'always'    => true,
                'extension' => '.php',
                'separator' => '_',
                'stat'      => true,
                'path'      => APP_PATH . '/cache/volt/',
                'prefix'    => '-prefix-',
                'compiledExtension' => '.php',
                'compileAlways' => true
            ]
        );

        return $volt;
    }
);

// $container->set(
//     'view',
//     function () {
//         $view = new View();
//         $view->setViewsDir(APP_PATH . '/views/');
//         return $view;
//     }
// );

$container->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        $view->registerEngines(
            [
                '.volt' => 'voltService',
            ]
        );
        return $view;
    }
);

// $container->setShared('view', function () {
//     $view = new View();
//     $view->setViewsDir('../app/views/');

//     $view->registerEngines([
//         '.volt' => function ($view) {
//             $volt = new Volt($view, $this);
//             $volt->setOptions([
//                 'compiledPath' => APP_PATH. '/volt/',
//                 'compiledExtension' => '.php',
//             ]);
//             return $volt;
//         }
//     ]);

//     return $view;
// });


$container->set(
    'url',
    function () {
        $url = new Url();
        $url->setBaseUri('/');
        return $url;
    }
);

$application = new Application($container);

try {
    // Handle the request
    $response = $application->handle(
        $_SERVER["REQUEST_URI"]
    );

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}