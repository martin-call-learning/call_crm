<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This class defines the controller responsible for handling the login page route.
 *
 * @package App\Controller
 */
class LoginController extends AbstractController {

    /**
     * Display the login page.
     *
     * @return Response The rendered HTML response.
     *
     * @Route('/login', name: 'app_login')
     */
    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {
        // Render the login page template.
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
    /*
    public function registration(UserPasswordHasherInterface $passwordHasher): Response
    {
        // ... e.g. get the user data from a registration form
        $user = new User(...);
        $plaintextPassword = ...;

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        // ...
    }
    */
}
