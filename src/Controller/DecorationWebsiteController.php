<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;


class DecorationWebsiteController extends AbstractController
{
    /** 
     * @Route("/decoration_website", name="decoration_website")
     */
    public function categories()
    {
        $repo = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repo->findBy(['parent_id' => null]);

            return $this->render('decoration_website/categories.html.twig', [
                'controller_name' => 'DecorationWebsiteController',
                'categories' => $categories
            ]);
    }


    /**
     * @Route("/decoration_website/{id}", name="decoration_website_subcategories")
     */
    public function subcategories($id) {

        $repo = $this->getDoctrine()->getRepository(Category::class);
        $subcategories = $repo->findBy(['parent_id' => $id]);

        return $this->render('decoration_website/subcategories.html.twig', [
            'controller_name' => 'DecorationWebsiteController',
            'categories' => $subcategories
        ]);
    }

    /**
     * @Route("/decoration_website/{id}", name="decoration_website_products")
     */
    public function show_products($id) {

        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->findBy(['category_id' => $id]);

        return $this->render('decoration_website/subcategories.html.twig', [
            'controller_name' => 'DecorationWebsiteController',
            'products' => $products
        ]);
    }


}
