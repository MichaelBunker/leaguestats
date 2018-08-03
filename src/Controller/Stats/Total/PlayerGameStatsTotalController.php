<?php

namespace App\Controller\Stats\Total;

use App\Entity\PlayerGameStatsTotal;
use App\Controller\AbstractController;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PlayerGameStatsTotalController.
 */
class PlayerGameStatsTotalController extends AbstractController
{
	const ENTITY = PlayerGameStatsTotal::class;

	/**
	 * @Route("/player/game/stats/total", name="player_game_stats_total", methods="GET")
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
