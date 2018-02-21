<?php

namespace App\Controller\Teams;

use App\Entity\Teams;
use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function getTeams(Request $request)
	{
		return $this->getAction($request);
	}
}
