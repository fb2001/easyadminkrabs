<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Controller\Admin\XyzCrudController;
use App\Controller\Admin\UtilisateurCrudController;
use App\Controller\Admin\EnseigneCrudController;
use App\Controller\Admin\CategorieCrudController;
use App\Controller\Admin\HoraireCrudController;
use App\Controller\Admin\NotationCrudController;
use App\Controller\Admin\UserCrudController;


use App\Entity\Utilisateur;
use App\Entity\Enseigne;
use App\Entity\User;
use App\Entity\Categorie;
use App\Entity\Horaire;
use App\Entity\Notation;

use Symfony\Component\Security\Http\Attribute\IsGranted;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[Route('/admin', name: 'dashboard')]    
    public function index(): Response
    {
        // Redirect to a specific CRUD controller to avoid the null controller issue
        return $this->redirect(
            $this->adminUrlGenerator
                ->setController(UtilisateurCrudController::class)
                ->setAction('index')
                ->generateUrl()
        );
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Krabs Manager');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Utilisateur::class)
            ->setController(UtilisateurCrudController::class);

        yield MenuItem::linkToCrud('Enseignes', 'fas fa-store', Enseigne::class)
            ->setController(EnseigneCrudController::class);

        yield MenuItem::linkToCrud('Notations', 'fas fa-star', Notation::class)
            ->setController(NotationCrudController::class);

        yield MenuItem::linkToCrud('Horaires', 'fas fa-clock', Horaire::class)
            ->setController(HoraireCrudController::class);

        yield MenuItem::linkToCrud('Catégories', 'fas fa-tags', Categorie::class)
            ->setController(CategorieCrudController::class);

        // Keep only one of these menu items for User
        yield MenuItem::linkToCrud('Comptes Admin', 'fas fa-user-shield', User::class)
            ->setController(UserCrudController::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setName($user->getUserIdentifier())
            ->setGravatarEmail($user->getEmail())
            ->displayUserAvatar(true);
    }
    
    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('build/css/admin.css');
    }
}