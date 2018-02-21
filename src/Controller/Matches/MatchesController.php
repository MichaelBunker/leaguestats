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
	 * @Route("/matches", name="matches")
	 *
	 * @param Criteria $criteria
	 *
	 * @return JsonResponse
	 */
	public function getMatches(Criteria $criteria): JsonResponse
	{
		return $this->getAction($criteria);
	}
}
