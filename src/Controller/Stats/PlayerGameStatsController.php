<?php

namespace App\Controller\Stats;

use App\Entity\PlayerGameStats;
use App\Controller\AbstractController;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PlayerGameStatsController.
 */
class PlayerGameStatsController extends AbstractController
{
    const ENTITY = PlayerGameStats::class;

    /**
     * @Route("/player/game/stats", name="player_game_stats")
     *
     * @param Criteria $criteria
     *
     * @return JsonResponse
     */
    public function getPlayerGameStats(Criteria $criteria): JsonResponse
    {
        return $this->getAction($criteria);
    }
}
