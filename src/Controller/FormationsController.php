<?php

namespace App\Controller;

use App\Repository\FormationActionRepository;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This class defines the controller responsible for displaying formations and formation actions on a specific route.
 *
 * @package App\Controller
 */
class FormationsController extends AbstractController
{

    /**
     * Display formations and formation actions on the specified route.
     *
     * @param FormationRepository $formationRepository The repository for Formation entities.
     * @param FormationActionRepository $formationActionRepository The repository for FormationAction entities.
     * @return Response The rendered HTML response.
     *
     * @Route('/formations', name: 'app_formations')
     */
    #[Route('/formations', name: 'app_formations')]
    public function formations(FormationRepository $formationRepository, FormationActionRepository $formationActionRepository): Response
    {
        return $this->render('admin-dashboard/formations.html.twig', [
            'controller_name' => 'FormationsController',
            'formations' => $formationRepository->findNotDeleted(),
            'formationActions' => $formationActionRepository->findAllGroupedByFormation(),
        ]);
    }
}
