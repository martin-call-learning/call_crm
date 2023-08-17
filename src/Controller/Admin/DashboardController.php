<?php

namespace App\Controller\Admin;

use App\Controller\FormationsController;
use App\Entity\Contact;
use App\Entity\Formation;
use App\Entity\FormationAction;
use App\Entity\Funder;
use App\Entity\FundingType;
use App\Entity\Grade;
use App\Entity\Organisation;
use App\Entity\Session;
use App\Entity\Skill;
use App\Entity\Student;
use App\Entity\Test;
use App\Entity\User;
use App\Repository\FormationRepository;
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
    public function __construct(private AdminUrlGenerator $adminUrlGenerator, FormationRepository $formationRepository) {
        $this->formationRepository = $formationRepository;
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('CALL CRM')

            // by default EasyAdmin displays a black square as its default favicon;
            // use this method to display a custom favicon: the given path is passed
            // "as is" to the Twig asset() function:
            // <link rel="shortcut icon" href="{{ asset('...') }}">
            //->setFaviconPath('favicon.svg')

            // the domain used by default is 'messages'
            //->setTranslationDomain('my-custom-domain')

            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            //->setTextDirection('ltr')

            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()

            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design
            //->renderSidebarMinimized()

            // by default, users can select between a "light" and "dark" mode for the
            // backend interface. Call this method if you prefer to disable the "dark"
            // mode for any reason (e.g. if your interface customizations are not ready for it)
            //->disableDarkMode()

            // by default, all backend URLs are generated as absolute URLs. If you
            // need to generate relative URLs instead, call this method
            //->generateRelativeUrls()

            // set this option if you want to enable locale switching in dashboard.
            // IMPORTANT: this feature won't work unless you add the {_locale}
            // parameter in the admin dashboard URL (e.g. '/admin/{_locale}').
            // the name of each locale will be rendered in that locale
            // (in the following example you'll see: "English", "Polski")
            // ->setLocales(['en', 'fr'])
            // to customize the labels of locales, pass a key => value array
            // (e.g. to display flags; although it's not a recommended practice,
            // because many languages/locales are not associated to a single country)
            ->setLocales([
                'en' => '🇬🇧 English',
                'fr' => '🇫🇷 French'
            ])
            // to further customize the locale option, pass an instance of
            // EasyCorp\Bundle\EasyAdminBundle\Config\Locale
            //->setLocales([
            //    'en', // locale without custom options
            //   Locale::new('pl', 'polski', 'far fa-language') // custom label and icon
            //])
        ;
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

        //return $this->render('admin-dashboard/index.html.twig', ['formations'=>$this->formationRepository->findAll()]);
    }

    public function configureMenuItems(): iterable
    {
        $translator = new Translator('fr_FR');

        // #### Formations ####

        yield MenuItem::linkToDashboard($translator->trans('dashboard.link.dashboard'), 'fa fa-home');

        yield MenuItem::section($translator->trans('sections.formations'));

        yield MenuItem::subMenu($translator->trans('dashboard.link.formation'), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans('dashboard.show.formation'), "fas fa-eye", Formation::class),
            MenuItem::linkToCrud($translator->trans('dashboard.add.formation'), "fas fa-plus", Formation::class)->setAction(Crud::PAGE_NEW)
            ]);

        yield MenuItem::subMenu($translator->trans('dashboard.link.formation_action'), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.show.formation_action"), "fas fa-eye", FormationAction::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.formation_action"), "fas fa-plus", FormationAction::class)->setAction(Crud::PAGE_NEW)
        ]);


        yield MenuItem::subMenu($translator->trans("dashboard.link.session"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.show.session"), "fas fa-eye", Session::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.session"), "fas fa-plus", Session::class)->setAction(Crud::PAGE_NEW)
        ]);

        // #### Students ####

        yield MenuItem::section($translator->trans('sections.students'));

        yield MenuItem::subMenu($translator->trans("dashboard.link.student"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.show.student"), "fas fa-eye", Student::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.student"), "fas fa-plus", Student::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu($translator->trans("dashboard.link.skill"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.show.skill"), "fas fa-eye", Skill::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.skill"), "fas fa-plus", Skill::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu($translator->trans("dashboard.link.test"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.show.test"), "fas fa-eye", Test::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.test"), "fas fa-plus", Test::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu($translator->trans("dashboard.link.grade"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.show.grade"), "fas fa-eye", Grade::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.grade"), "fas fa-plus", Grade::class)->setAction(Crud::PAGE_NEW)
        ]);


        // #### Customers ####

        yield MenuItem::section($translator->trans('sections.customers'));

        yield MenuItem::subMenu($translator->trans("dashboard.link.user"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.show.user"), "fas fa-eye", User::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.user"), "fas fa-plus", User::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu($translator->trans("dashboard.link.contact"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.show.contact"), "fas fa-eye", Contact::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.contact"), "fas fa-plus", Contact::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu($translator->trans("dashboard.link.organisation"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.show.organisation"), "fas fa-eye", Organisation::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.organisation"), "fas fa-plus", Organisation::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu($translator->trans("dashboard.link.funder"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.show.funder"), "fas fa-eye", Funder::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.funder"), "fas fa-plus", Funder::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu($translator->trans("dashboard.link.fundingType"), 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud($translator->trans("dashboard.show.fundingType"), "fas fa-eye", FundingType::class),
            MenuItem::linkToCrud($translator->trans("dashboard.add.fundingType"), "fas fa-plus", FundingType::class)->setAction(Crud::PAGE_NEW)
        ]);
    }
}
