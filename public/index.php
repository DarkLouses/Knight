<?php

require_once '../vendor/autoload.php';

use Knight\Http\HttpNotFoundException;
use Knight\Http\Request;
use Knight\Http\Response;
use Knight\Routing\Router;
use Knight\Server\PhpNativeServer;

$router = new Router();

$router->get('/test/{param}', function (Request $request) {
	return Response::json($request->routerParameters());
});

$router->post('/test', function (Request $request) {
	return Response::json($request->data());
});

$router->get('/redirect', function (Request $request) {
	return Response::redirect('/test');
});

$server = new PhpNativeServer();

try {
	$request = $server->getRequest();
    $route = $router->resolve($request);
	$request->setRoute($route);
    $action = $route->action();
	$response = $action($request);

	$server->sendResponse($response);
} catch (HttpNotFoundException $e) {
	$response = Response::text('Not found')->setStatus(404);
	$server->sendResponse($response);
}