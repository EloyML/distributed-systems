<?php
/**
 * Created by PhpStorm.
 * User: ZHIQIN
 * Date: 10/04/2018
 * Time: 20:40
 */

session_start();
date_default_timezone_set('Europe/London');

require __DIR__ . '/../vendor/autoload.php';

//Setting up the application
$app = new \Slim\App([
    'settings' => [
        //this could be very useful error will be display by twig-view
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        //database information
        'db' => [
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'cloud',
        ],
    ],
]);

//Building up the container to hold variables
$container = $app->getContainer();

//Initializing the pre-load html file for rendering web pages
$container['view'] = function ($container){
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $view->addExtension(new Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

$container['AuthController'] = function ($container){
    return new \App\Controllers\Auth\AuthController($container);
};

$container['PassController'] = function ($container){
    return new \App\Controllers\Auth\PassController($container);
};

$container['EntryController'] = function ($container){
    return new \App\Controllers\EntryController($container);
};

$container['EventController'] = function ($container){
    return new \App\Controllers\EventController($container);
};

$container['db'] = function ($container){
    $settings = $container->get('settings')['db'];
    $conn = new mysqli($settings['host'], $settings['username'], $settings['password'], $settings['database']);

    if ($conn->connect_error){
        die("connection fail: " . $conn->connect_error);
    }
    return $conn;
};

require __DIR__ . '\..\app\routes.php';

