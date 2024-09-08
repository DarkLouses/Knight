<?php

require_once '../vendor/autoload.php';

use Knight\HttpNotFoundException;
use Knight\Router;

$router = new Router();

$router->get('/test', function () {
    return 'Router get';
});

$router->post('/test', function () {
    return 'Router post';
});

try {
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Normalize URI
    $action = $router->resolve($method, $uri);
    $action = $action->action();
    print($action());
} catch (HttpNotFoundException $e) {
    print('404 Not Found');
    http_response_code(404);
}