<?php

namespace Knight;

use Knight\Container\Container;
use Knight\Http\HttpNotFoundException;
use Knight\Http\Request;
use Knight\Http\Response;
use Knight\Routing\Router;
use Knight\Server\PhpNativeServer;
use Knight\Server\Server;

class App
{
	public Router $router;
	public Server $server;
	public Request $request;

	public static function bootstrap(): mixed
	{
		$app = Container::singleton(App::class);
		$app->router = new Router();
		$app->server = new PhpNativeServer();
		$app->request = $app->server->getRequest();

		return $app;
	}

		public function run(): void
		{
			try {
				$response = $this->router->resolve($this->request);
				$this->server->sendResponse($response);
			} catch (HttpNotFoundException $e) {
				$response = Response::text('Not found')->setStatus(404);
				$this->server->sendResponse($response);
			}
		}
}