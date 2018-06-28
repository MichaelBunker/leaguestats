<?php

namespace App\Controller\Stats;

use App\Entity\Champions;
use App\Entity\TeamGameStats;
use App\Controller\AbstractController;
use Doctrine\Common\Collections\Collection;
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
	 * Fetch records.
	 *
	 * Overriding parent to modify bans from pk to names.
	 * TODO: find a better solution than this.
	 *
	 * @param Criteria $criteria
	 *
	 * @return Collection
	 */
	protected function fetchRecords(Criteria $criteria): Collection
	{
		$doctrine  = $this->getDoctrine();
		$records   = $doctrine->getRepository($this::ENTITY)->matching($criteria);
		$champRepo = $doctrine->getRepository(Champions::class);

		foreach ($records as &$record) {
			$record->setBans($champRepo->findBy(['championId' => $record->getBans()]));
		}

		return $records;
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
