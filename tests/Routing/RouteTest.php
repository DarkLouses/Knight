<?php

namespace Knight\Tests\Routing;

use Knight\Routing\Route;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    public static function routesWithNoParameters(): array
    {
        return [
            ['/test'],
            ['/test/algo'],
            ['/home/test/test'],
        ];
    }

    /**
     * @dataProvider routesWithNoParameters
     */
    public function testRegexWithNoParameters(string $uri)
    {
        $route = new Route($uri, fn() => 'test');
        $this->assertTrue($route->matches($uri));
        $this->assertFalse($route->matches("$uri/algo"));
        $this->assertFalse($route->matches("/home/$uri"));
    }

    /**
     * @dataProvider routesWithNoParameters
     */
    public function testRegexOnUriThatEndsWithParameters(string $uri)
    {
        $route = new Route($uri, fn() => 'test');
        $this->assertTrue($route->matches("$uri/"));
    }

    public static function routesWithParameters(): array
    {
        return [
            ['/test/{id}', '/test/1', ['id' => 1]],
            ['/test/{id}', '/test/2', ['id' => 2]]
        ];
    }

    /**
     * @dataProvider routesWithParameters
     */
    public function testRegexWithParameters(string $uri, string $testUri, array $parameters)
    {
        $route = new Route($uri, fn() => 'test');
        $this->assertTrue($route->matches($testUri));
    }

    /**
     * @dataProvider routesWithParameters
     */
    public function testParseParameters(string $uri, string $testUri, array $parameters)
    {
        $route = new Route($uri, fn() => 'test');
        $this->assertTrue($route->hasParameters());
        $this->assertEquals($parameters, $route->parseParameters($testUri));
    }

}