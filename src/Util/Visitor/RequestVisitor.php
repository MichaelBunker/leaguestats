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

		$comparisons = $this->createQueryObjects($queryString);
		$expr        = $this->createCompositeExpression($comparisons);

		return new Criteria($expr);
	}

	/**
	 * Break query string into objects.
	 *
	 * @param string $queryString
	 *
	 * @return array
	 */
	protected function createQueryObjects($queryString): array
	{
		$queries     = preg_split('/(&|\|)/', $queryString);
		$comparisons = [];

		foreach ($queries as $query) {
			$comparisons[] = $this->getQueryComparisons($query);
		}

		return $comparisons;
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
	 * Create Comparison object.
	 *
	 * @param string $field
	 * @param string $operator
	 * @param string $value
	 *
	 * @return Comparison
	 *
	 * @throws BadRequestHttpException If operator isn't supported.
	 */
	protected function createComparison($field, $operator, $value): Comparison
	{
		switch ($operator) {
			case Comparison::EQ:
				return $this->expressionBuilder->eq($field, $value);

			case Comparison::NEQ:
				return $this->expressionBuilder->neq($field, $value);

			case Comparison::LT:
				return $this->expressionBuilder->lt($field, $value);

			case Comparison::LTE:
				return $this->expressionBuilder->lte($field, $value);

			case Comparison::GT:
				return $this->expressionBuilder->gt($field, $value);

			case Comparison::GTE:
				return $this->expressionBuilder->gte($field, $value);

			case Comparison::IN:
				return $this->expressionBuilder->in($field, $value);

			default:
				throw new BadRequestHttpException('Operator is not supported');
		}
	}

	/**
	 * Get query values.
	 *
	 * Determines if expression is simple field=value or is using other operators.
	 *
	 * @param string $query
	 *
	 * @return Comparison
	 */
	protected function getQueryComparisons($query): Comparison
	{
		$queryParts = explode('=', $query, 2);
		$field      = $queryParts[0];
		if ($this->isComplexComparison($queryParts[1])) {
			list($operator, $value) = $this->getComplexComparisonValues($queryParts);
		} else {
			$operator = '=';
			$value    = $queryParts[1];
		}

		return $this->createComparison($field, $operator, $value);
	}

	/**
	 * Check if query is using complex.
	 *
	 * @param string $query
	 *
	 * @return integer
	 */
	protected function isComplexComparison($query)
	{
		return preg_match('/\(\S*\)/', $query);
	}

	/**
	 * Get operator and values for complex comparisons.
	 *
	 * @param array $queryParts
	 *
	 * @return array
	 *
	 * @throws \OutOfBoundsException If there are no operators or values found.
	 */
	protected function getComplexComparisonValues(array $queryParts): array
	{
		preg_match('/`(.*?)`/', $queryParts[1], $values);
		preg_match('/\((.*?)`/', $queryParts[1], $operators);

		if (!$operators || !$values) {
			throw new \OutOfBoundsException("Can't parse request.", 400);
		}

		return [$operators[1], $values[1]];
	}

	/**
	 * Create CompositeExpression.
	 *
	 * @param array $comparisons
	 *
	 * @return CompositeExpression
	 */
	protected function createCompositeExpression(array $comparisons): CompositeExpression
	{
		return new CompositeExpression(CompositeExpression::TYPE_AND, $comparisons);
	}
}
