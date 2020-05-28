<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;


class HomeController extends AbstractController
{
    /**
     * @Route("/decoration_website/{id_category}", name="decoration_website_subcategories")
     */
    public function subcategories($id_category) {

        $repo = $this->getDoctrine()->getRepository(Category::class);
        $categorie = $repo->find($id_category);
        $subcategories = $repo->findBy(['parent' => $id_category]);

        return $this->render('decoration_website/categories/subcategories.html.twig', [
            'categories'    => $subcategories,
            'categorie'      => $categorie
        ]);
    }

    /**
     * @Route("/decoration_website/{id_category}/{id_sub_category}/products", name="decoration_website_products")
     */
    public function show_products($id_category, $id_sub_category) {

        $category = $this->getDoctrine()->getRepository(Category::class)->find($id_sub_category);
        $products = $category->getProducts();

        return $this->render('decoration_website/products/products.html.twig', [
            'products' => $products,
            'category' => $category,
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
            'product' => $product,

        ]);
    }

    /**
     * (route non utilisée par navigation)
     * 
     * @Route("/decoration_website/product/{id_product}", name="decoration_website_product_by_id")
     */
    public function show_product_by_id($id_product) {

        $repo = $this->getDoctrine()->getRepository(Product::class);
        $product = $repo->find($id_product);

        return $this->render('decoration_website/products/product.html.twig', [
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

        $catRepo = $this->getDoctrine()->getRepository(Category::class);
        $categories = $catRepo->findAll();

        return $this->render('decoration_website/home/index.html.twig', [
            'products'        => $products,
            'categories'      => $categories,
        ]);
    }

}
