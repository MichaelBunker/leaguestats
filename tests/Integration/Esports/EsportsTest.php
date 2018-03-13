<?php

namespace App\Integration\Esports;

use App\Enum\HttpEnum;
use App\Integration\Esports\Esports as Wrapper;
use GuzzleHttp\Client;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use SebastianBergmann\PeekAndPoke\Proxy;

/**
 * Class EsportsTest.
 */
class EsportsTest extends TestCase
{
	/**
	 * Test the constructor() function.
	 */
	public function testConstructor()
	{
		$client   = $this->createMock(Client::class);
		$wrapper  = $this->createPartialMock(Wrapper::class, []);
		$accessor = new Proxy($wrapper);

		$accessor->__call('__construct', [$client]);

		$this->assertSame($client, $accessor->client);
	}

	/**
	 * Test get() function.
	 */
	public function testGet()
	{
		$client   = $this->createMock(Client::class);
		$request  = $this->createMock(RequestInterface::class);
		$response = $this->createMock(ResponseInterface::class);
		$message  = $this->createMock(MessageInterface::class);
		$wrapper  = $this->createPartialMock(Wrapper::class, ['createRequest', 'handleResponseErrors']);
		$accessor = new Proxy($wrapper);
		$accessor->client = $client;
		$resource = 'foo/resource/bar';
		$query    = [];

		$wrapper
			->expects($this->once())
			->method('createRequest')
			->with(HttpEnum::GET, $resource)
			->willReturn($request);

		$client
			->expects($this->once())
			->method('send')
			->with($request)
			->willReturn($response);

		$wrapper
			->expects($this->once())
			->method('handleResponseErrors')
			->with($response);

		$this->assertEquals(
			$response,
			$wrapper->get($resource, $query, $message)
		);
	}

	/**
	 * Test post() function.
	 *
	 * @expectedException \App\Integration\NotImplementedException
	 * @expectedExceptionMessage POST method is not implemented
	 */
	public function testPost()
	{
		$message  = $this->createMock(MessageInterface::class);
		$wrapper  = $this->createPartialMock(Wrapper::class, []);
		$resource = 'fake/path';

		$wrapper->post($resource, $message);
	}

	/**
	 * Test put() function.
	 *
	 * @expectedException \App\Integration\NotImplementedException
	 * @expectedExceptionMessage PUT method is not implemented
	 */
	public function testPut()
	{
		$message  = $this->createMock(MessageInterface::class);
		$wrapper  = $this->createPartialMock(Wrapper::class, []);
		$resource = 'fake/path';

		$wrapper->put($resource, $message);
	}

	/**
	 * Test post() function.
	 *
	 * @expectedException \App\Integration\NotImplementedException
	 * @expectedExceptionMessage DELETE method is not implemented
	 */
	public function testDelete()
	{
		$message  = $this->createMock(MessageInterface::class);
		$wrapper  = $this->createPartialMock(Wrapper::class, []);
		$resource = 'fake/path';

		$wrapper->delete($resource, $message);
	}

	/**
	 * Test createRequest() function.
	 */
	public function testCreateRequest()
	{
		$wrapper  = $this->createPartialMock(Wrapper::class, []);
		$accessor = new Proxy($wrapper);

		$method = 'GET';
		$uri    = 'fake/uri/path';

		$this->assertInstanceOf(
			RequestInterface::class,
			$accessor->createRequest($method, $uri)
		);
	}

	/**
	 * Test handleResponseErrors() function over 300 response.
	 *
	 * @expectedException \RuntimeException
	 * @expectedExceptionMessage Something went wrong with the request
	 */
	public function testHandleResponseErrors400()
	{
		$logger   = $this->createMock(Logger::class);
		$response = $this->createMock(ResponseInterface::class);
		$wrapper  = $this->createPartialMock(Wrapper::class, []);
		$accessor = new Proxy($wrapper);
		$accessor->logger = $logger;

		$response
			->expects($this->exactly(2))
			->method('getStatusCode')
			->with()
			->willReturn(400);

		$logger
			->expects($this->once())
			->method('error')
			->with('Error returned from the Riot API. Status Code: 400');

		$accessor->handleResponseErrors($response);
	}

	/**
	 * Test handleResponseErrors() function.
	 */
	public function testHandleResponseErrors()
	{
		$response = $this->createMock(ResponseInterface::class);
		$wrapper  = $this->createPartialMock(Wrapper::class, []);
		$accessor = new Proxy($wrapper);

		$response
			->expects($this->once())
			->method('getStatusCode')
			->with()
			->willReturn(200);

		$this->assertNull($accessor->handleResponseErrors($response));
	}
}
