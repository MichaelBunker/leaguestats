<?php

namespace App\Controller\Players;

use App\Entity\Players;
use App\Controller\AbstractController;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PlayersController.
 */
class PlayersController extends AbstractController
{
	const ENTITY = Players::class;

	/**
	 * @Route("/players", name="players", methods="GET")
	 *
	 * @param Criteria $criteria
	 *
	 * @return JsonResponse
	 */
	public function getPlayers(Criteria $criteria): JsonResponse
	{
		return $this->getAction($criteria);
	}
}
