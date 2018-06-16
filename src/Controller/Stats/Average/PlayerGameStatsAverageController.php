<?php

namespace App\Controller\Stats\Average;

use App\Entity\PlayerGameStatsAverage;
use App\Controller\AbstractController;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PlayerGameStatsAverageController.
 */
class PlayerGameStatsAverageController extends AbstractController
{
	const ENTITY = PlayerGameStatsAverage::class;

	/**
	 * @Route("/player/game/stats/average", name="player_game_stats_average", methods="GET")
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

		return $service->convert($criteria, 'player', ['player']);
	}
}
