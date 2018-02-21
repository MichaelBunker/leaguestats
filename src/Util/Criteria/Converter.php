<?php

namespace App\Util\Criteria;

use App\Entity\Players;
use App\Entity\Teams;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\CompositeExpression;
use Doctrine\Common\Collections\Expr\Expression;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * This class takes a criteria that has a foreign key reference and gets the PK for it instead of the field given.
 *
 * Class Converter
 */
class Converter
{
	/**
	 * @var ObjectRepository
	 */
	protected $teamRepository;

	/**
	 * @var ObjectRepository
	 */
	protected $playerRepository;

	/**
	 * Converter constructor.
	 *
	 * @param EntityManagerInterface $entityManager
	 */
	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->teamRepository   = $entityManager->getRepository(Teams::class);
		$this->playerRepository = $entityManager->getRepository(Players::class);
	}

	/**
	 * Convert criteria.
	 *
	 * @param Criteria $criteria
	 * @param string   $entity
	 * @param string   $fields
	 *
	 * @return Criteria
	 */
	public function convert(Criteria $criteria, $entity, $fields): Criteria
	{
		$expressions = $criteria->getWhereExpression();
		$valueMethod = 'get' . ucfirst($entity);
		if (!$expressions) {
			return $criteria;
		}

		$fieldFound = false;

		foreach ($expressions->getExpressionList() as $expr) {
			if (in_array($expr->getField(), $fields)) {
				$fieldFound    = true;
				$comparisons[] = $this->createComparison($valueMethod, $expr);

				continue;
			}

			$comparisons[] = $expr;
		}

		if (!$fieldFound) {
			return $criteria;
		}

		return new Criteria(new CompositeExpression(CompositeExpression::TYPE_AND, $comparisons));
	}

	/**
	 * Get Team entity.
	 *
	 * @param string $value
	 *
	 * @return \App\Entity\Teams|null
	 */
	protected function getTeam($value): ?Teams
	{
		return $this->teamRepository->findOneByAbbr($value);
	}

	/**
	 * Get Player entity.
	 *
	 * @param string $value
	 *
	 * @return Players|null
	 */
	protected function getPlayer($value): ?Players
	{
		return $this->playerRepository->findOneByName($value);
	}

	/**
	 * Create Comparison object.
	 *
	 * @param string     $valueMethod
	 * @param Expression $expr
	 *
	 * @return Comparison
	 */
	protected function createComparison($valueMethod, Expression $expr): Comparison
	{
		$value = $this->$valueMethod([$expr->getValue()->getValue()]);

		return new Comparison($expr->getField(), $expr->getOperator(), $value);
	}
}
