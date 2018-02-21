<?php

namespace App\Controller\Teams;

use App\Entity\Teams;
use App\Controller\AbstractController;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TeamsController.
 */
class TeamsController extends AbstractController
{
	const ENTITY = Teams::class;

	/**
	 * @Route("/teams", name="teams")
	 *
	 * @param Criteria $criteria
	 *
	 * @return JsonResponse
	 */
	public function getTeams(Criteria $criteria)
	{
		return $this->getAction($criteria);
	}
}
