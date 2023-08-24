<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This class defines the controller responsible for handling the home page route.
 *
 * @package App\Controller
 */
class HomeController extends AbstractController
{

    /**
     * Display the home page.
     *
     * @return Response The rendered HTML response.
     *
     * @Route('/', name: 'app_home')
     */
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
