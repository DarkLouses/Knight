<?php

require_once '../vendor/autoload.php';

use Knight\App;
use Knight\Http\Request;
use Knight\Http\Response;

$app = App::bootstrap();

$app->router->get('/test/{param}', function (Request $request) {
	return Response::json($request->routerParameters());
});

$app->router->post('/test', function (Request $request) {
	return Response::json($request->data());
});

$app->router->get('/redirect', function (Request $request) {
	return Response::redirect('/test');
});

$app->run();
