<?php

namespace Knight\Tests;

use Knight\HttpMethod;
use Knight\HttpNotFoundException;
use Knight\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    /**
     * @throws HttpNotFoundException
     */
    public function testResolveBasicRouteWithCallbackAction()
    {
        $uri = '/test';
        $action = fn() => 'Router get';
        $router = new Router();
        $router->get($uri, $action);

        $this->assertEquals($action, $router->resolve(HttpMethod::GET->value, $uri));
    }

    /**
     * @throws HttpNotFoundException
     */
    public function testResolveMultipleBasicRoutesWithCallbackAction()
    {
        $routes = [
            '/test' => fn() => "test",
            '/foo' => fn() => "foo",
            '/t' => fn() => "t",
            '/bar' => fn() => "bar",
        ];

        $router = new Router();

        foreach ($routes as $uri => $action) {
            $router->get($uri, $action);
        }

        foreach ($routes as $uri => $action) {
            $this->assertEquals($action, $router->resolve(HttpMethod::GET->value, $uri));
        }
    }

    /**
     * @throws HttpNotFoundException
     */
    public function testResolveMultipleBasicRoutesWithCallbackActionForDifferent()
    {
        $routes = [
            [HttpMethod::GET, "/test", fn() => "get"],
            [HttpMethod::POST, "/test", fn() => "post"],
            [HttpMethod::PUT, "/test", fn() => "put"],
            [HttpMethod::DELETE, "/test", fn() => "delete"],
            [HttpMethod::GET, "/s", fn() => "get"],
            [HttpMethod::POST, "/tt", fn() => "post"],
            [HttpMethod::PUT, "/tes", fn() => "put"],
            [HttpMethod::DELETE, "/st", fn() => "delete"]
        ];

        $router = new Router();

        foreach ($routes as [$method, $uri, $action]) {
            $router->{strtolower($method->value)}($uri, $action);
        }

        foreach ($routes as [$method, $uri, $action]) {
            $this->assertEquals($action, $router->resolve($method->value, $uri));
        }
    }
}
