<?php

namespace App\Util\ValueResolver;

use App\Util\Criteria\Converter;
use App\Util\Visitor\RequestVisitor;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

/**
 * Class CriteriaResolver to put Criteria object into controller argument.
 */
class CriteriaResolver implements ArgumentValueResolverInterface
{
	/**
	 * @var Converter
	 */
	protected $criteriaConverter;

	/**
	 * @var RequestVisitor
	 */
	protected $requestVisitor;

	/**
	 * CriteriaResolver constructor.
	 *
	 * @param Converter      $converter
	 * @param RequestVisitor $requestVisitor
	 */
	public function __construct(Converter $converter, RequestVisitor $requestVisitor)
	{
		$this->criteriaConverter = $converter;
		$this->requestVisitor    = $requestVisitor;
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
		yield $this->createNewCriteria($request);
	}

	/**
	 * Create a criteria from a request object.
	 *
	 * @param Request $request
	 *
	 * @return Criteria
	 */
	protected function createNewCriteria(Request $request): Criteria
	{
		$criteria = $this->requestVisitor->create($request);

		return $this->criteriaConverter->convert($criteria, 'player', ['name']);
	}
}
