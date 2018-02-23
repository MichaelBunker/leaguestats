<?php

namespace App\Controller\Stats;

use App\Entity\TeamGameStats;
use App\Controller\AbstractController;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TeamGameStatsController.
 */
class TeamGameStatsController extends AbstractController
{
	const ENTITY = TeamGameStats::class;

	/**
	 * @Route("/team/game/stats", name="team_game_stats", methods="GET")
	 *
	 * @param Criteria $criteria
	 *
	 * @return JsonResponse
	 */
	public function getTeamGameStats(Criteria $criteria): JsonResponse
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

		return $service->convert($criteria, 'team', ['team']);
	}
}
