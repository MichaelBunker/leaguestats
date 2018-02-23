<?php

namespace App\Controller\Matches;

use App\Entity\Matches;
use App\Controller\AbstractController;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MatchesController.
 */
class MatchesController extends AbstractController
{
	const ENTITY = Matches::class;

	/**
	 * @Route("/matches", name="matches", methods="GET")
	 *
	 * @param Criteria $criteria
	 *
	 * @return JsonResponse
	 */
	public function getMatches(Criteria $criteria): JsonResponse
	{
		return $this->getAction($this->convertCriteria($criteria));
	}

	/**
	 * Create criteria.
	 *
	 * @param Criteria $criteria
	 *
	 * @return Criteria
	 */
	protected function convertCriteria(Criteria $criteria): Criteria
	{
		/** @var \App\Util\Criteria\Converter $service */
		$service = $this->get('App\Util\Criteria\Converter');

		return $service->convert($criteria, 'team', ['winner', 'loser']);
	}
}
