<?php

namespace tests\Controller\Stats\Average;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TeamGameStatsAverageControllerIntegrationTest.
 */
class TeamGameStatsAverageControllerIntegrationTest extends WebTestCase
{
	/**
	 * Test GET requests to the /team/game/stats/average endpoint.
	 */
	public function testGetTeamGameStatsAverage()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/team/game/stats/average?team=bjergsen');
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
	 * Test GET /team/game/stats/average with query param.
	 */
	public function testGetTeamGameStatsAverageWithQuery()
	{
		$this->markTestSkipped('skipped until I can get this working in CI pipeline.');
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/team/game/stats/average?team=TSM');
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
	 * Test GET /team/game/stats/average with query param.
	 */
	public function testGetTeamGameStatsAverageWithQueryNoResults()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/team/game/stats/average?team=asdflkjafdasf');
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
	 * Test GET /team/game/stats/average with query param for invalid field.
	 */
	public function testGetTeamGameStatsAverageInvalidQueryField()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/team/game/stats/average?foo=TSM');
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
	 * Test POST /team/game/stats/average
	 */
	public function testPostTeamGameStatsAverage()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_POST, '/team/game/stats/average?foo=TSM');
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
	 * Test DELETE /team/game/stats/average
	 */
	public function testDeleteTeamGameStatsAverage()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_DELETE, '/team/game/stats/average?foo=TSM');
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
	 * Test PUT /team/game/stats/average
	 */
	public function testPutTeamGameStatsAverage()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_PUT, '/team/game/stats/average?foo=TSM');
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
