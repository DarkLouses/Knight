<?php

require_once '../vendor/autoload.php';

use Knight\Http\HttpNotFoundException;
use Knight\Http\Request;
use Knight\Http\Response;
use Knight\Routing\Router;
use Knight\Server\PhpNativeServer;

$router = new Router();

$router->get('/test', function (Request $request) {
	$response = new Response();
	$response->setHeader('Content-Type', 'text/plain');
	$response->setContent(json_encode(['message' => 'Router get']));

	return $response;
});

$router->post('/test', function (Request $request) {
	$response = new Response();
	$response->setHeader('Content-Type', 'text/plain');
	$response->setContent(json_encode(['message' => 'Router post']));

	return $response;
});

$server = new PhpNativeServer();

try {
	$request = new Request($server);
    $route = $router->resolve($request);
    $action = $route->action();
	$response = $action($request);

	$server->sendResponse($response);
} catch (HttpNotFoundException $e) {
    $response = new Response();
	$response->setStatus(404);
	$response->setHeader('Content-Type', 'text/plain');
	$response->setContent(json_encode(['message' => 'Not found']));

	$server->sendResponse($response);
}