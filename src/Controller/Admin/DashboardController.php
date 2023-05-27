<?php

namespace App\Controller\Admin;

use App\Entity\Former;
use App\Entity\Modules;
use App\Entity\Session;
use App\Entity\Student;
use App\Entity\Category;
use App\Entity\Formation;
use App\Entity\Programme;
use App\Controller\CategoryController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\CategoryCrudController;
use App\Controller\Admin\FormationCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{

    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
        
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();
        $url = $this->adminUrlGenerator
            ->setController(CategoryCrudController::class)
            ->generateUrl();

            return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Symfony Session EasyAdmin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Category', 'fas fa-solid fa-arrow-right', Category::class); 

        yield MenuItem::linkToCrud('Formation', 'fas fa-solid fa-arrow-right', Formation::class);
        
        yield MenuItem::linkToCrud('Former', 'fas fa-solid fa-arrow-right', Former::class);

        yield MenuItem::linkToCrud('Student', 'fas fa-solid fa-arrow-right', Student::class);

        yield MenuItem::linkToCrud('Module', 'fas fa-solid fa-arrow-right', Modules::class);

        yield MenuItem::linkToCrud('Session', 'fas fa-solid fa-arrow-right', Session::class);

        yield MenuItem::linkToCrud('Programme', 'fas fa-solid fa-arrow-right', Programme::class);

    }
}
