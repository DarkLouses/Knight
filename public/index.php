<?php

require_once '../vendor/autoload.php';

use Knight\HttpNotFoundException;
use Knight\Request;
use Knight\Router;
use Knight\PhpNativeServer;

$router = new Router();

$router->get('/test', function () {
    return 'Router get';
});

$router->post('/test', function () {
    return 'Router post';
});

try {
    $action = $router->resolve(new Request(new PhpNativeServer()));
    $action = $action->action();
    print($action());
} catch (HttpNotFoundException $e) {
    print('404 Not Found');
    http_response_code(404);
}