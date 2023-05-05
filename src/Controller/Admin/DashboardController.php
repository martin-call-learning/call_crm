<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Formation;
use App\Entity\FormationAction;
use App\Entity\Funder;
use App\Entity\Organisation;
use App\Entity\Session;
use App\Entity\Student;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(FormationCrudController::class)->generateUrl();
        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Call Crm');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::subMenu('Formations', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud("Toutes les formations", "", Formation::class),
            MenuItem::linkToCrud("Ajouter une formation", "fas fa-plus", Formation::class)->setAction(Crud::PAGE_NEW)
            ]);


        yield MenuItem::subMenu('Actions de formation', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud("Toutes les actions de formation", "", FormationAction::class),
            MenuItem::linkToCrud("Ajouter une action deformation", "fas fa-plus", FormationAction::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu('Contacts', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud("Tous les contacts", "", Contact::class),
            MenuItem::linkToCrud("Ajouter un contact", "fas fa-plus", Contact::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu('Organisations', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud("Toutes les organisations", "", Organisation::class),
            MenuItem::linkToCrud("Ajouter une organisations", "fas fa-plus", Organisation::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu('Financements', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud("Tous les financements", "", Funder::class),
            MenuItem::linkToCrud("Ajouter un financements", "fas fa-plus", Funder::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu('Sessions', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud("Toutes les sessions", "", Session::class),
            MenuItem::linkToCrud("Ajouter une sessions", "fas fa-plus", Session::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu('Etudiants', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud("Tous les étudiants", "", Student::class),
            MenuItem::linkToCrud("Ajouter unétudiant", "fas fa-plus", Student::class)->setAction(Crud::PAGE_NEW)
        ]);
    }
}
