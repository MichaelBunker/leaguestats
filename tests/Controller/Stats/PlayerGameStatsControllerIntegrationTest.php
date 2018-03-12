<?php

namespace tests\Controller\Stats;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PlayerGameStatsControllerIntegrationTest.
 */
class PlayerGameStatsControllerIntegrationTest extends WebTestCase
{
	/**
	 * Test GET requests to the /player/game/stats endpoint.
	 */
	public function testGetPlayerGameStats()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/player/game/stats?player=bjergsen');
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
	 * Test GET /player/game/stats with query param.
	 */
	public function testGetPlayerGameStatsWithQuery()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/player/game/stats?player=bjergsen');
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
	 * Test GET /player/game/stats with query param.
	 */
	public function testGetPlayerGameStatsWithQueryNoResults()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/player/game/stats?player=asdflkjafdasf');
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
	 * Test GET /player/game/stats with query param for invalid field.
	 */
	public function testGetPlayerGameStatsInvalidQueryField()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/player/game/stats?foo=TSM');
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
	 * Test POST /player/game/stats
	 */
	public function testPostPlayerGameStats()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_POST, '/player/game/stats?foo=TSM');
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
	 * Test DELETE /player/game/stats
	 */
	public function testDeletePlayerGameStats()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_DELETE, '/player/game/stats?foo=TSM');
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
	 * Test PUT /player/game/stats
	 */
	public function testPutPlayerGameStats()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_PUT, '/player/game/stats?foo=TSM');
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
