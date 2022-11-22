<?php

namespace App\Controller\Admin;

use App\Entity\Agent;
use App\Entity\BonsMateriel;
use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\BonsTravail;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(UserCrudController::class)->generateUrl();

        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Cleaner');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Page d\'accueil', 'fas fa-home', 'app_home');
        yield MenuItem::linkToCrud('Agents', 'fas fa-person-breastfeeding', Agent::class);
        yield MenuItem::linkToCrud('Clients', 'fas fa-street-view', Client::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user-check', User::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Bon de travail', 'fas fa-paste', BonsTravail::class);
        yield MenuItem::linkToCrud('Bon de materiel', 'fas fa-broom', BonsMateriel::class);
    }
}
