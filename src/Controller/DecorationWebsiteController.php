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
        $categories = $repo->findBy(['parent' => null]);

            return $this->render('decoration_website/categories/categories.html.twig', [
                'controller_name' => 'DecorationWebsiteController',
                'categories' => $categories
            ]);
    }


    /**
     * @Route("/decoration_website/{id_category}", name="decoration_website_subcategories")
     */
    public function subcategories($id_category) {

        $repo = $this->getDoctrine()->getRepository(Category::class);
        $subcategories = $repo->findBy(['parent' => $id_category]);

        return $this->render('decoration_website/categories/subcategories.html.twig', [
            'controller_name' => 'DecorationWebsiteController',
            'categories' => $subcategories
        ]);
    }

    /**
     * @Route("/decoration_website/{id_category}/{id_sub_category}/products", name="decoration_website_products")
     */
    public function show_products($id_category, $id_sub_category) {

        $category = $this->getDoctrine()->getRepository(Category::class)->find($id_sub_category);
        $products = $category->getProducts();

        return $this->render('decoration_website/products/products.html.twig', [
            'controller_name' => 'DecorationWebsiteController',
            'products' => $products,
            'id_parent_category' => $id_category,
        ]);
    }

    /**
     * @Route("/decoration_website/{id_category}/{id_sub_category}/{id_product}", name="decoration_website_product")
     */
    public function show_product($id_category, $id_sub_category,$id_product) {

        $repo = $this->getDoctrine()->getRepository(Product::class);
        $product = $repo->find($id_product);

        return $this->render('decoration_website/products/product.html.twig', [
            'controller_name' => 'DecorationWebsiteController',
            'product' => $product,

        ]);
    }

    /** 
     * @Route("/", name="home")
     */
    public function accueilSite()
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->findAll();

        return $this->render('decoration_website/products/HomeProducts.html.twig', [
            'products' => $products,
            'controller_name' => 'DecorationWebsiteController',
        ]);
    }

}
