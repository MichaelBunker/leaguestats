<?php

namespace tests\Controller\Games;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GamesControllerIntegrationTest.
 */
class GamesControllerIntegrationTest extends WebTestCase
{
	/**
	 * Test GET requests to the /games endpoint.
	 */
	public function testGetGames()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/games');
		$response = $client->getResponse();

		$this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
		$this->assertContains('count', $response->getContent());
		$this->assertContains('results', $response->getContent());
		$this->assertTrue(
			$response->headers->contains(
				'Content-Type',
				'application/json'
			)
		);
	}

	/**
	 * Test GET /games with query param.
	 */
	public function testGetGamesWithQuery()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/games?winner=TSM');
		$response = $client->getResponse();

		$this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
		$this->assertContains('count', $response->getContent());
		$this->assertContains('results', $response->getContent());
		$this->assertContains('"success":true', $response->getContent());
		$this->assertContains('TSM', $response->getContent());
		$this->assertTrue(
			$response->headers->contains(
				'Content-Type',
				'application/json'
			)
		);
	}

	/**
	 * Test GET /games with query param.
	 */
	public function testGetGamesWithQueryNoResults()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/games?winner=asdflkjafdasf');
		$response = $client->getResponse();

		$this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
		$this->assertContains('"count":0', $response->getContent());
		$this->assertContains('results', $response->getContent());
		$this->assertContains('"success":true', $response->getContent());
		$this->assertTrue(
			$response->headers->contains(
				'Content-Type',
				'application/json'
			)
		);
	}

	/**
	 * Test GET /games with query param for invalid field.
	 */
	public function testGetGamesInvalidQueryField()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/games?foo=TSM');
		$response = $client->getResponse();

		$this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
		$this->assertContains('count', $response->getContent());
		$this->assertContains('"success":false', $response->getContent());
		$this->assertContains('exceptionMessage', $response->getContent());
		$this->assertContains('exceptionLevel', $response->getContent());
		$this->assertTrue(
			$response->headers->contains(
				'Content-Type',
				'application/json'
			)
		);
	}

	/**
	 * Test POST /games
	 */
	public function testPostGames()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_POST, '/games?foo=TSM');
		$response = $client->getResponse();

		$this->assertEquals(Response::HTTP_METHOD_NOT_ALLOWED, $response->getStatusCode());
		$this->assertContains('count', $response->getContent());
		$this->assertContains('"success":false', $response->getContent());
		$this->assertContains('exceptionMessage', $response->getContent());
		$this->assertContains('exceptionLevel', $response->getContent());
		$this->assertTrue(
			$response->headers->contains(
				'Content-Type',
				'application/json'
			)
		);
	}

	/**
	 * Test DELETE /games
	 */
	public function testDeleteGames()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_DELETE, '/games?foo=TSM');
		$response = $client->getResponse();

		$this->assertEquals(Response::HTTP_METHOD_NOT_ALLOWED, $response->getStatusCode());
		$this->assertContains('count', $response->getContent());
		$this->assertContains('"success":false', $response->getContent());
		$this->assertContains('exceptionMessage', $response->getContent());
		$this->assertContains('exceptionLevel', $response->getContent());
		$this->assertTrue(
			$response->headers->contains(
				'Content-Type',
				'application/json'
			)
		);
	}

	/**
	 * Test PUT /games
	 */
	public function testPutGames()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_PUT, '/games?foo=TSM');
		$response = $client->getResponse();

		$this->assertEquals(Response::HTTP_METHOD_NOT_ALLOWED, $response->getStatusCode());
		$this->assertContains('count', $response->getContent());
		$this->assertContains('"success":false', $response->getContent());
		$this->assertContains('exceptionMessage', $response->getContent());
		$this->assertContains('exceptionLevel', $response->getContent());
		$this->assertTrue(
			$response->headers->contains(
				'Content-Type',
				'application/json'
			)
		);
	}
}
