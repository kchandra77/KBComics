<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use App\Entity\User;
use App\Entity\Genre;
use App\Entity\Produit;
use App\Entity\Auteur;
use App\Entity\Editeur;
use App\Entity\Fournisseur;
use App\Entity\Carrier;
use App\Entity\Order;
use App\Entity\Header;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(OrderCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('KBComics');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user',  User::class);
        yield MenuItem::linkToCrud('Commande', 'fas fa-shopping-cart',  Order::class);
        yield MenuItem::linkToCrud('Genre', 'fas fa-list',  Genre::class);
        yield MenuItem::linkToCrud('Produits', 'fas fa-tag',  Produit::class);
        yield MenuItem::linkToCrud('Auteur', 'fas fa-pen',  Auteur::class);
        yield MenuItem::linkToCrud('Editeur', 'fas fa-edit',  Editeur::class);
        yield MenuItem::linkToCrud('Fournisseur', 'fas fa-edit',  Fournisseur::class);
        yield MenuItem::linkToCrud('Transporteur', 'fas fa-truck',  Carrier::class);
        yield MenuItem::linkToCrud('Headers', 'fas fa-desktop',  Header::class);
    }
}
