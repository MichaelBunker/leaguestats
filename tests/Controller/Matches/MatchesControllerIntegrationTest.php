<?php

namespace tests\Controller\Matches;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MatchesControllerTest.
 */
class MatchesControllerIntegrationTest extends WebTestCase
{
	/**
	 * Test GET requests to the /matches endpoint.
	 */
	public function testGetmatches()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/matches');
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
	 * Test GET /matches with query param.
	 */
	public function testGetMatchesWithQuery()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/matches?winner=TSM');
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
	 * Test GET /matches with query param.
	 */
	public function testGetMatchesWithQueryNoResults()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/matches?winner=asdflkjafdasf');
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
	 * Test GET /matches with query param for invalid field.
	 */
	public function testGetMatchesInvalidQueryField()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_GET, '/matches?foo=TSM');
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
	 * Test POST /matches
	 */
	public function testPostMatches()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_POST, '/matches?foo=TSM');
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
	 * Test DELETE /matches
	 */
	public function testDeleteMatches()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_DELETE, '/matches?foo=TSM');
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
	 * Test PUT /matches
	 */
	public function testPutMatches()
	{
		$client = static::createClient();
		$client->request(Request::METHOD_PUT, '/matches?foo=TSM');
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
