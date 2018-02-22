<?php

namespace App\Util\ValueResolver;

use App\Util\Visitor\RequestVisitor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

/**
 * Class CriteriaResolver to put Criteria object into controller argument.
 */
class CriteriaResolver implements ArgumentValueResolverInterface
{
	/**
	 * @var RequestVisitor
	 */
	protected $requestVisitor;

	/**
	 * CriteriaResolver constructor.
	 *
	 * @param RequestVisitor $requestVisitor
	 */
	public function __construct(RequestVisitor $requestVisitor)
	{
		$this->requestVisitor = $requestVisitor;
	}

	/**
	 * Supports.
	 *
	 * @param Request          $request
	 * @param ArgumentMetadata $argument
	 *
	 * @return boolean
	 */
	public function supports(Request $request, ArgumentMetadata $argument)
	{
		return true;
	}

	/**
	 * Resolve.
	 *
	 * @param Request          $request
	 * @param ArgumentMetadata $argument
	 *
	 * @return \Generator
	 */
	public function resolve(Request $request, ArgumentMetadata $argument)
	{
		yield $this->requestVisitor->create($request);
	}
}
