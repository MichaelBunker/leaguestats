<?php

namespace tests\EventSubscriber;

use App\EventSubscriber\ExceptionSubscriber;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\PeekAndPoke\Proxy;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class ExceptionSubscriberTest.
 */
class ExceptionSubscriberTest extends TestCase
{
	/**
	 * Test onKernelException() function.
	 */
	public function testOnKernelException()
	{
		$response   = $this->createMock(JsonResponse::class);
		$event      = $this->createMock(GetResponseForExceptionEvent::class);
		$subscriber = $this->createPartialMock(ExceptionSubscriber::class, ['getResponseObject']);

		$subscriber
			->expects($this->once())
			->method('getResponseObject')
			->with($event)
			->willReturn($response);

		$event
			->expects($this->once())
			->method('setResponse')
			->with($response);

		$this->assertNull($subscriber->onKernelException($event));
	}

	/**
	 * Test getSubscribedEvents() function.
	 */
	public function testGetSubscribedEvents()
	{
		$subscriber = $this->createPartialMock(ExceptionSubscriber::class, ['getResponseObject']);

		$this->assertEquals(
			['kernel.exception' => 'onKernelException'],
			$subscriber->getSubscribedEvents()
		);
	}

	/**
	 * Test getResponseObject() function when statusCode exists.
	 */
	public function testGetResponseObjectWithStatusCode()
	{
		$exception  = $this->createMock(HttpException::class);
		$event      = $this->createMock(GetResponseForExceptionEvent::class);
		$subscriber = $this->createPartialMock(ExceptionSubscriber::class, []);
		$accessor   = new Proxy($subscriber);

		$event
			->expects($this->once())
			->method('getException')
			->with()
			->willReturn($exception);

		$exception
			->expects($this->once())
			->method('getStatusCode')
			->with()
			->willReturn(400);

		$this->assertInstanceOf(JsonResponse::class, $accessor->getResponseObject($event));
	}
}
