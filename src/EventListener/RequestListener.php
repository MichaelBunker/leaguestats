<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerArgumentsEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Util\Validator\RequestValidator;

/**
 * Request Listener.
 */
class RequestListener
{
	/**
	 * Request Validator.
	 *
	 * @var RequestValidator
	 */
	protected $validator;

	/**
	 * RequestListener constructor.
	 *
	 * @param RequestValidator $validator
	 */
	public function __construct(RequestValidator $validator)
	{
		$this->validator = $validator;
	}

	/**
	 * Handle controller requests.
	 *
	 * @param FilterControllerArgumentsEvent $event
	 *
	 * @return void
	 *
	 * @throws \RuntimeException Validator is missing.
	 */
	public function onKernelController(FilterControllerArgumentsEvent $event)
	{
		if (!$event->isMasterRequest()) {
			return;
		}

		$controllerClass = $this->getControllerClass($event);
		if (!$validatorClass = $this->getValidatorClass($controllerClass)) {
			throw new \RuntimeException(sprintf('The validator for %s is missing.', $controllerClass));
		}

		$this->validator->validate($validatorClass, $this->getControllerEntity($controllerClass), $event->getRequest());
	}

	/**
	 * Get request controller class.
	 *
	 * @param FilterControllerArgumentsEvent $event
	 *
	 * @return string
	 */
	protected function getControllerClass(FilterControllerArgumentsEvent $event)
	{
		return get_class($event->getController()[0]);
	}

	/**
	 * Get validator class for given controller.
	 *
	 * @param string $controllerClass
	 *
	 * @return string|false
	 */
	protected function getValidatorClass($controllerClass)
	{
		$validator = preg_replace(
			['/(\w+)Controller$/', '/\\Controller/'],
			['${1}Validator', 'Validator'],
			$controllerClass
		);

		return $validator ? $validator : false;
	}

	/**
	 * Get subscribed events for listener.
	 *
	 * @return array
	 */
	public static function getSubscribedEvents(): array
	{
		return [KernelEvents::CONTROLLER => 'onKernelController'];
	}

	/**
	 * Get controller entity.
	 *
	 * @param string $controllerClass
	 *
	 * @return string
	 */
	protected function getControllerEntity($controllerClass)
	{
		$controller = new \ReflectionClass($controllerClass);

		return $controller->getConstant('ENTITY');
	}
}
