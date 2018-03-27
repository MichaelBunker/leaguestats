<?php

namespace tests\Controller\Teams;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TeamsControllerIntegrationTest.
 */
class TeamsControllerIntegrationTest extends WebTestCase
{
	/**
	 * Test GET requests to the /teams endpoint.
	 */
	public function testGetTeams()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/teams');
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
	 * Test GET /teams with query param.
	 */
	public function testGetTeamsWithQuery()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/teams?abbr=TSM');
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
	 * Test GET /teams with query param.
	 */
	public function testGetTeamsWithComplexQuery()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/teams?abbr=(<>`TSM`)');
		$response = $client->getResponse();

		$this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
		$this->assertContains('count', $response->getContent());
		$this->assertContains('results', $response->getContent());
		$this->assertContains('"success":true', $response->getContent());
		$this->assertNotContains('TSM', $response->getContent());
		$this->assertTrue(
			$response->headers->contains(
				'Content-Type',
				'application/json'
			)
		);
	}

	/**
	 * Test GET /teams with query param.
	 */
	public function testGetTeamsWithQueryNoResults()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/teams?abbr=asdflkjafdasf');
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
	 * Test GET /teams with query param for invalid field.
	 */
	public function testGetTeamsInvalidQueryField()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/teams?foo=TSM');
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
	 * Test POST /teams
	 */
	public function testPostTeams()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_POST, '/teams?foo=TSM');
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
	 * Test DELETE /teams
	 */
	public function testDeleteTeams()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_DELETE, '/teams?foo=TSM');
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
	 * Test PUT /teams
	 */
	public function testPutTeams()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_PUT, '/teams?foo=TSM');
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
