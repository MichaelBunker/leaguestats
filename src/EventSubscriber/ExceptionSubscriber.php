<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * Class ExceptionSubscriber for normalizing exception responses.
 */
class ExceptionSubscriber implements EventSubscriberInterface
{
	/**
	 * Action on Kernel exceptions.
	 *
	 * @param GetResponseForExceptionEvent $event
	 *
	 * @return void
	 */
	public function onKernelException(GetResponseForExceptionEvent $event)
	{
		$response = $this->getResponseObject($event);
		$event->setResponse($response);
	}

	/**
	 * Get subscribed events.
	 *
	 * @return array
	 */
	public static function getSubscribedEvents()
	{
		return [
			'kernel.exception' => 'onKernelException',
		];
	}

	/**
	 * Get JsonResponse object for error.
	 *
	 * @param GetResponseForExceptionEvent $event
	 *
	 * @return JsonResponse
	 */
	protected function getResponseObject(GetResponseForExceptionEvent $event)
	{
		$exception = $event->getException();
		$code      = $exception->getCode() == 0 ? 500 : $exception->getCode();
		$response  = new JsonResponse(
			[
				'count'    => 0,
				'results'  => [],
				'success'  => false,
				'messages' => [
					'exceptionMessage' => $exception->getMessage(),
					'exceptionLevel'   => $code,
					'timestamp'        => time()
				]
			],
			$code
		);

		return $response;
	}
}
