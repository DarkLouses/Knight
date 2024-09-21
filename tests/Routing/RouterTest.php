<?php

namespace Knight\Tests\Routing;

use Knight\Http\HttpMethod;
use Knight\Http\HttpNotFoundException;
use Knight\Http\Request;
use Knight\Routing\Router;
use Knight\Tests\MockServer;
use PHPUnit\Framework\TestCase;

/**
 * Class RouterTest
 *
 * This class contains unit tests for the Router class.
 */
class RouterTest extends TestCase
{

    /**
     * Test resolving a basic route with a callback action.
     *
     * @throws HttpNotFoundException If the route is not found.
     */
    public function testResolveBasicRouteWithCallbackAction()
    {
        $uri = '/test';
        $action = fn() => 'Router get';
        $router = new Router();
        $router->get($uri, $action);

        $route = $router->resolve(new Request(new MockServer($uri , HttpMethod::GET)));
        $this->assertEquals($uri, $route->uri());
        $this->assertEquals($action, $route->action());
    }

    /**
     * Test resolving multiple basic routes with callback actions.
     *
     * @throws HttpNotFoundException If any of the routes are not found.
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
            $route = $router->resolve(new Request(new MockServer($uri , HttpMethod::GET)));
            $this->assertEquals($uri, $route->uri());
            $this->assertEquals($action, $route->action());
        }
    }

    /**
     * Test resolving multiple basic routes with callback actions for different HTTP methods.
     *
     * @throws HttpNotFoundException If any of the routes are not found.
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
            $route = $router->resolve(new Request(new MockServer($uri , $method)));
            $this->assertEquals($uri, $route->uri());
            $this->assertEquals($action, $route->action());
        }
    }
}