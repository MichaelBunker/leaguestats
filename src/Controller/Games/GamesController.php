<?php

namespace App\Controller\Games;

use App\Entity\Games;
use App\Controller\AbstractController;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GamesController.
 */
class GamesController extends AbstractController
{
	const ENTITY = Games::class;

	/**
	 * @Route("/games", name="games", methods="GET")
	 *
	 * @param Criteria $criteria
	 *
	 * @return JsonResponse
	 */
	public function getGames(Criteria $criteria): JsonResponse
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

		return $service->convert($criteria, 'team', ['winner']);
	}
}
