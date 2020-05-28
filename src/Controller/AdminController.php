<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * redirection vers admin/dashboard qui est l'accueil de l'admin
     * 
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->redirectToRoute('admin_dashboard');
    }

    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     */
    public function index2()
    {
        return $this->render('admin/dashboard/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

}