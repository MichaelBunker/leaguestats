<?php

namespace App\Integration;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Integration Interface
 */
interface IntegrationInterface
{
	/**
	 * GET request.
	 *
	 * @param string                $resource
	 * @param array                 $query
	 * @param MessageInterface|null $body
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function get($resource, array $query = [], MessageInterface $body = null): ResponseInterface;

	/**
	 * POST request.
	 *
	 * @param string                $resource
	 * @param MessageInterface|null $body
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function post($resource, MessageInterface $body = null): ResponseInterface;

	/**
	 * PUT request.
	 *
	 * @param string                $resource
	 * @param MessageInterface|null $body
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function put($resource, MessageInterface $body = null): ResponseInterface;

	/**
	 * DELETE request.
	 *
	 * @param string                $resource
	 * @param MessageInterface|null $body
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function delete($resource, MessageInterface $body = null): ResponseInterface;
}
