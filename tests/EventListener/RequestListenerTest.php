<?php

namespace App\EventListener;

use App\Controller\AbstractController;
use App\Controller\Teams\TeamsController;
use App\Entity\Teams;
use App\Util\Validator\RequestValidator;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\PeekAndPoke\Proxy;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerArgumentsEvent;

/**
 * Class RequestListenerTest.
 */
class RequestListenerTest extends TestCase
{
	/**
	 * Test the constructor() function.
	 */
	public function testConstructor()
	{
		$validator = $this->createMock(RequestValidator::class);
		$listener  = $this->createPartialMock(RequestListener::class, []);
		$accessor  = new Proxy($listener);

		$accessor->__call('__construct', [$validator]);

		$this->assertSame($validator, $accessor->validator);
	}

	/**
	 * Test onKernelController() function.
	 */
	public function testOnKernelController()
	{
		$event    = $this->createMock(FilterControllerArgumentsEvent::class);
		$listener = $this->createPartialMock(RequestListener::class, ['getControllerClass', 'getValidatorClass']);

		$event
			->expects($this->once())
			->method('isMasterRequest')
			->with()
			->willReturn(false);

		$listener
			->expects($this->never())
			->method('getControllerClass');

		$listener
			->expects($this->never())
			->method('getValidatorClass');

		$this->assertNull($listener->onKernelController($event));
	}

	/**
	 * Test onKernelController() function Exception.
	 *
	 * @expectedException \RuntimeException
	 * @expectedExceptionMessage The validator for controller is missing.
	 */
	public function testOnKernelControllerException()
	{
		$event    = $this->createMock(FilterControllerArgumentsEvent::class);
		$listener = $this->createPartialMock(RequestListener::class, ['getControllerClass', 'getValidatorClass']);

		$controllerClass = 'controller';

		$event
			->expects($this->once())
			->method('isMasterRequest')
			->with()
			->willReturn(true);

		$listener
			->expects($this->once())
			->method('getControllerClass')
			->with($event)
			->willReturn($controllerClass);

		$listener
			->expects($this->once())
			->method('getValidatorClass')
			->with($controllerClass)
			->willReturn(false);

		$listener->onKernelController($event);
	}

	/**
	 * Test onKernelController() function Validating arguments.
	 */
	public function testOnKernelControllerValidated()
	{
		$validator = $this->createMock(RequestValidator::class);
		$request   = $this->createMock(Request::class);
		$event     = $this->createMock(FilterControllerArgumentsEvent::class);
		$listener  = $this->createPartialMock(RequestListener::class, ['getControllerClass', 'getValidatorClass', 'getControllerEntity']);
		$accessor  = new Proxy($listener);
		$accessor->validator = $validator;

		$controllerClass = 'controller';
		$validatorClass  = 'validator';
		$entity          = 'fake/entity/path';

		$event
			->expects($this->once())
			->method('isMasterRequest')
			->with()
			->willReturn(true);

		$listener
			->expects($this->once())
			->method('getControllerClass')
			->with($event)
			->willReturn($controllerClass);

		$listener
			->expects($this->once())
			->method('getValidatorClass')
			->with($controllerClass)
			->willReturn($validatorClass);

		$event
			->expects($this->once())
			->method('getRequest')
			->with()
			->willReturn($request);

		$listener
			->expects($this->once())
			->method('getControllerEntity')
			->with($controllerClass)
			->willReturn($entity);

		$validator
			->expects($this->once())
			->method('validate')
			->with($validatorClass, $entity, $request);

		$listener->onKernelController($event);
	}

	/**
	 * Test getControllerClass() function.
	 */
	public function testGetControllerClass()
	{
		$controller = new TeamsController();
		$event      = $this->createMock(FilterControllerArgumentsEvent::class);
		$listener   = $this->createPartialMock(RequestListener::class, []);
		$accessor   = new Proxy($listener);

		$event
			->expects($this->once())
			->method('getController')
			->with()
			->willReturn([$controller]);

		$this->assertEquals(
			'App\Controller\Teams\TeamsController',
			$accessor->getControllerClass($event)
		);
	}

	/**
	 * Test getControllerEntity() function.
	 */
	public function testGetControllerEntity()
	{
		$listener = $this->createPartialMock(RequestListener::class, []);
		$accessor = new Proxy($listener);

		$this->assertEquals(
			Teams::class,
			$accessor->getControllerEntity('App\Controller\Teams\TeamsController')
		);
	}
}
