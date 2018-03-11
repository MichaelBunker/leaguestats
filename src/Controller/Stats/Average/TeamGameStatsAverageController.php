<?php

namespace App\Controller\Stats\Average;

use App\Entity\TeamGameStatsAverage;
use App\Controller\AbstractController;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TeamGameStatsAverageController.
 */
class TeamGameStatsAverageController extends AbstractController
{
	const ENTITY = TeamGameStatsAverage::class;

	/**
	 * @Route("/team/game/stats/average", name="team_game_stats_average", methods="GET")
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
