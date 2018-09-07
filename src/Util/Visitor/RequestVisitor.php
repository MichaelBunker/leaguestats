<?php

namespace App\Util\Visitor;

use Doctrine\Common\Collections\Expr\CompositeExpression;
use Doctrine\Common\Collections\ExpressionBuilder;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Visitor class to convert requests into Criteria objects.
 */
class RequestVisitor
{
	/**
	 * @var ExpressionBuilder
	 */
	protected $expressionBuilder;

	/**
	 * Criteria constructor.
	 *
	 * @param ExpressionBuilder $expressionBuilder
	 */
	public function __construct(ExpressionBuilder $expressionBuilder)
	{
		$this->expressionBuilder = $expressionBuilder;
	}

	/**
	 * Create criteria object.
	 *
	 * @param HttpRequest $request
	 *
	 * @return Criteria
	 */
	public function create(HttpRequest $request): Criteria
	{
		$queryString = $this->getQueryString($request);
		if (!$queryString) {
			return new Criteria();
		}

		$expr = $this->createQueryObjects($queryString);

		return new Criteria($expr);
	}

	/**
	 * Break query string into objects.
	 *
	 * @param string $queryString
	 *
	 * @return array
	 */
	protected function createQueryObjects($queryString)
	{
		$queries     = preg_split('/(&|\|)/', $queryString, -1, PREG_SPLIT_DELIM_CAPTURE);
		$comparisons = [];
		$join        = null;

		foreach ($queries as $query) {
			if (strlen($query) == 1) {
				$join = $query;
				continue;
			}
			$comparisons[] = $this->getQueryComparisons($query);
		}

		return $this->createCompositeExpression($comparisons, $join);
	}

	/**
	 * Get query values.
	 *
	 * Determines if expression is simple field=value or is using other operators.
	 *
	 * @param string $query
	 *
	 * @return Comparison
	 *
	 * @throws BadRequestHttpException When invalid operator given.
	 */
	protected function getQueryComparisons($query): Comparison
	{
		if (strpos($query, Comparison::EQ)) {
			$queryParts = explode(Comparison::EQ, $query);
			return $this->expressionBuilder->eq($queryParts[0], $queryParts[1]);
		}
		if (strpos($query, Comparison::NEQ)) {
			$queryParts = explode(Comparison::NEQ, $query);
			return $this->expressionBuilder->neq($queryParts[0], $queryParts[1]);
		}
		if (strpos($query, Comparison::LT)) {
			$queryParts = explode(Comparison::LT, $query);
			return $this->expressionBuilder->lt($queryParts[0], $queryParts[1]);
		}
		if (strpos($query, Comparison::GT)) {
			$queryParts = explode(Comparison::GT, $query);
			return $this->expressionBuilder->gt($queryParts[0], $queryParts[1]);
		}

		throw new BadRequestHttpException('Operator is not supported');
	}

	/**
	 * Get query string from Request object.
	 *
	 * @param HttpRequest $request
	 *
	 * @return string
	 */
	protected function getQueryString(HttpRequest $request)
	{
		return urldecode($request->getQueryString());
	}

	/**
	 * Create CompositeExpression.
	 *
	 * @param array  $comparisons
	 * @param string $join
	 *
	 * @return CompositeExpression
	 */
	protected function createCompositeExpression(array $comparisons, $join): CompositeExpression
	{
		$type = $join == '|'
			? CompositeExpression::TYPE_OR
			: CompositeExpression::TYPE_AND;

		return new CompositeExpression($type, $comparisons);
	}
}
