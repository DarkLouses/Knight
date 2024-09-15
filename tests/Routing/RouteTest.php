<?php

namespace Knight\Tests\Routing;

use Knight\Routing\Route;
use PHPUnit\Framework\TestCase;

/**
 * Class RouteTest
 *
 * This class contains unit tests for the Route class.
 */
class RouteTest extends TestCase
{
    /**
     * Provides routes with no parameters for testing.
     *
     * @return array An array of routes with no parameters.
     */
    public static function routesWithNoParameters(): array
    {
        return [
            ['/test'],
            ['/test/algo'],
            ['/home/test/test'],
        ];
    }

    /**
     * Test regex matching for routes with no parameters.
     *
     * @dataProvider routesWithNoParameters
     * @param string $uri The URI to test.
     */
    public function testRegexWithNoParameters(string $uri)
    {
        $route = new Route($uri, fn() => 'test');
        $this->assertTrue($route->matches($uri));
        $this->assertFalse($route->matches("$uri/algo"));
        $this->assertFalse($route->matches("/home/$uri"));
    }

    /**
     * Test regex matching for URIs that end with parameters.
     *
     * @dataProvider routesWithNoParameters
     * @param string $uri The URI to test.
     */
    public function testRegexOnUriThatEndsWithParameters(string $uri)
    {
        $route = new Route($uri, fn() => 'test');
        $this->assertTrue($route->matches("$uri/"));
    }

    /**
     * Provides routes with parameters for testing.
     *
     * @return array An array of routes with parameters.
     */
    public static function routesWithParameters(): array
    {
        return [
            ['/test/{id}', '/test/1', ['id' => 1]],
            ['/test/{id}', '/test/2', ['id' => 2]]
        ];
    }

    /**
     * Test regex matching for routes with parameters.
     *
     * @dataProvider routesWithParameters
     * @param string $uri The URI pattern.
     * @param string $testUri The URI to test.
     * @param array $parameters The expected parameters.
     */
    public function testRegexWithParameters(string $uri, string $testUri, array $parameters)
    {
        $route = new Route($uri, fn() => 'test');
        $this->assertTrue($route->matches($testUri));
    }

    /**
     * Test parsing parameters from URIs.
     *
     * @dataProvider routesWithParameters
     * @param string $uri The URI pattern.
     * @param string $testUri The URI to test.
     * @param array $parameters The expected parameters.
     */
    public function testParseParameters(string $uri, string $testUri, array $parameters)
    {
        $route = new Route($uri, fn() => 'test');
        $this->assertTrue($route->hasParameters());
        $this->assertEquals($parameters, $route->parseParameters($testUri));
    }

}