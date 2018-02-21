<?php

namespace App\Controller\Teams;

use App\Entity\Teams;
use App\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TeamsController extends AbstractController
{
    const ENTITY = Teams::class;

    /**
     * @Route("/teams", name="teams")
     */
    public function getTeams()
    {
        $data = $this->getDoctrine()->getRepository(Teams::class)->findAll();

        return $this->json([
            'message' => $data,
        ]);
    }
}
