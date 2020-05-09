<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminAccountController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_account_login")
     */
    public function login(AuthenticationUtils $utils) // classe AuthenticationUtils donne des outils sympas pour les erreurs d'authentification
    {
        $error = $utils->getLastAuthenticationError();
        // getLastUsername permet de ne pas avoir à retaper le nom d'utilisateur, il va chercher le dernier qui a tenté de se connecter
        $username = $utils->getLastUsername();

        return $this->render('admin/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * Permet de se déconnecter
     * 
     * @Route("/admin/logout", name="admin_account_logout")
     * 
     * @return void
     */

    public function logout() {
        // ...
    }
}
