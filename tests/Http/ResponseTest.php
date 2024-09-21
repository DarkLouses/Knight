<?php

namespace Knight\Tests\Http;

use Knight\Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
	public function testJsonResponseIsConstructedCorrectly(): void
	{
		$content = ["test" => "foo", "num" => 2];
		$response = Response::json($content);

		$this->assertEquals(200, $response->status());
		$this->assertEquals(json_encode($content), $response->content());
		$this->assertEquals(["content-type" => "application/json"], $response->headers());
	}

	public function testTextResponseIsConstructedCorrectly(): void
	{
		$content = "test";
		$response = Response::text($content);

		$this->assertEquals(200, $response->status());
		$this->assertEquals($content, $response->content());
		$this->assertEquals(["content-type" => "text/plain"], $response->headers());
	}

	public function testRedirectResponseIsConstructedCorrectly(): void
	{
		$uri = "/redirect/uri";
		$response = Response::redirect($uri);

		$this->assertEquals(302, $response->status());
		$this->assertNull($response->content());
		$this->assertEquals(["location" => $uri], $response->headers());
	}

	public function testPrepareMethodAddsContentLengthHeaderIfThereIsContent(): void
	{
		$content = "test";
		$response = Response::text($content);
		$response->prepare();

		$this->assertEquals(strlen($content), $response->headers()["content-length"]);
	}
}