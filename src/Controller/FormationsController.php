<?php

namespace App\Controller;

use App\Repository\FormationActionRepository;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationsController extends AbstractController
{
    #[Route('/formations', name: 'app_formations')]
    public function index(FormationRepository $formationRepository, FormationActionRepository $formationActionRepository): Response
    {
        return $this->render('admin-dashboard/formations.html.twig', [
            'controller_name' => 'FormationsController',
            'formations' => $formationRepository->findNotDeleted(),
            'formationActions' => $formationActionRepository->findAllGroupedByFormation(),
        ]);
    }
}
