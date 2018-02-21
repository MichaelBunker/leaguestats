<?php

namespace App\Integration\Esports;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use App\Enum\HttpEnum;
use App\Integration\IntegrationInterface;
use App\Integration\NotImplementedException;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerAwareTrait;

/**
 * API Wrapper for Riot Esports API.
 */
class Esports implements IntegrationInterface
{
	use LoggerAwareTrait;

	/**
	 * Guzzle Client.
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Riot wrapper constructor.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Get request.
	 *
	 * @param string                $resource
	 * @param array                 $query
	 * @param MessageInterface|null $body
	 *
	 * @return ResponseInterface
	 */
	public function get($resource, array $query = [], MessageInterface $body = null): ResponseInterface
	{
		$request  = $this->createRequest(HttpEnum::GET, $resource);
		$response = $this->client->send($request);
		$this->handleResponseErrors($response);

		return $response;
	}
// phpcs:disable
	/**
	 * Post request.
	 *
	 * @param string                $resource
	 * @param MessageInterface|null $body
	 *
	 * @throws NotImplementedException Method is not implemented.
	 *
	 * @return ResponseInterface
	 */
	public function post($resource, MessageInterface $body = null): ResponseInterface
	{
		throw new NotImplementedException(sprintf('%s method is not implemented', HttpEnum::POST));
	}

	/**
	 * Put request.
	 *
	 * @param string                $resource
	 * @param MessageInterface|null $body
	 *
	 * @return ResponseInterface
	 *
	 * @throws NotImplementedException Method not implemented.
	 */
	public function put($resource, MessageInterface $body = null): ResponseInterface
	{
		throw new NotImplementedException(sprintf('%s method is not implemented', HttpEnum::PUT));
	}

	/**
	 * Delete request.
	 *
	 * @param string                $resource
	 * @param MessageInterface|null $body
	 *
	 * @return ResponseInterface
	 *
	 * @throws NotImplementedException Method not implemented.
	 */
	public function delete($resource, MessageInterface $body = null): ResponseInterface
	{
		throw new NotImplementedException(sprintf('%s method is not implemented', HttpEnum::DELETE));
	}
// phpcs:enable
	/**
	 * Create request.
	 *
	 * @param string $method
	 * @param string $uri
	 *
	 * @return RequestInterface
	 */
	protected function createRequest($method, $uri): RequestInterface
	{
		return new Request($method, $uri, []);
	}

	/**
	 * Handle errors.
	 *
	 * @param ResponseInterface $response
	 *
	 * @throws \RuntimeException Error returned from API.
	 *
	 * @return void
	 */
	protected function handleResponseErrors(ResponseInterface $response)
	{
		if ($response->getStatusCode() >= 300) {
			$this->logger->error(sprintf('Error returned from the Riot API. Status Code: %s', $response->getStatusCode()));
			throw new \RuntimeException('Something went wrong with the request', 500);
		}
	}
}
