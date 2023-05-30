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
use Symfony\Component\Translation\Translator;

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
        $translator = new Translator('fr_FR');

        yield MenuItem::linkToDashboard($translator->trans('dashboard.link.dashboard'), 'fa fa-home');

        yield MenuItem::subMenu($translator->trans('dashboard.link.formation'), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans('dashboard.all.formation'), "", Formation::class),
            MenuItem::linkToCrud($translator->trans('dashboard.add.formation'), "fas fa-plus", Formation::class)->setAction(Crud::PAGE_NEW)
            ]);

        yield MenuItem::subMenu($translator->trans('dashboard.link.formation_action'), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.all.formation_action"), "", FormationAction::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.formation_action"), "fas fa-plus", FormationAction::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu($translator->trans("dashboard.link.contact"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.all.contact"), "", Contact::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.contact"), "fas fa-plus", Contact::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu($translator->trans("dashboard.link.organisation"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.all.organisation"), "", Organisation::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.organisation"), "fas fa-plus", Organisation::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu($translator->trans("dashboard.link.funder"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.all.funder"), "", Funder::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.funder"), "fas fa-plus", Funder::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu($translator->trans("dashboard.link.session"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.all.session"), "", Session::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.session"), "fas fa-plus", Session::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu($translator->trans("dashboard.link.student"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.all.student"), "", Student::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.student"), "fas fa-plus", Student::class)->setAction(Crud::PAGE_NEW)
        ]);
    }
}
