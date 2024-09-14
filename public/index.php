<?php

require_once '../vendor/autoload.php';

use Knight\Http\HttpNotFoundException;
use Knight\Http\Request;
use Knight\Http\Response;
use Knight\Routing\Router;
use Knight\Server\PhpNativeServer;

$router = new Router();

$router->get('/test', function (Request $request) {
	return Response::json(['message' => 'Router get']);
});

$router->post('/test', function (Request $request) {
	return Response::json(['message' => 'Router post']);
});

$router->get('/redirect', function (Request $request) {
	return Response::redirect('/test');
});

$server = new PhpNativeServer();

try {
	$request = new Request($server);
    $route = $router->resolve($request);
    $action = $route->action();
	$response = $action($request);

	$server->sendResponse($response);
} catch (HttpNotFoundException $e) {
	$response = Response::text('Not found')->setStatus(404);
	$server->sendResponse($response);
}