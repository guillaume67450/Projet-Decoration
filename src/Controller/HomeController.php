<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Service\PaginationService;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\NotNull;

class HomeController extends AbstractController
{
    /**
     * @Route("/decoration_website/{id_category}", name="decoration_website_subcategories")
     */
    public function subcategories($id_category) {

        $repo = $this->getDoctrine()->getRepository(Category::class);
        $category = $repo->find($id_category);
        $subcategories = $repo->findBy(['parent' => $id_category]);

        return $this->render('decoration_website/categories/subcategories.html.twig', [
            'categories'    => $subcategories,
            'category'      => $category
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
     * @Route("/{page<\d+>?1}", name="home")
     * 
     * on met des inline requirements \d+ (le décimal + indique qu'on peut mettre un nombre et pas seulement un chiffre)
     * le ? veut dire que c'est optionnel, 1 est la valeur par défaut si pas renseigné
     */
    public function accueilSite($page, CategoryRepository $catRepo, PaginationService $pagination)
    {
        $categories = $catRepo->findAll();

        $subcategories = $catRepo->findByParentNotNull(true);

        $pagination ->setEntityClass(Product::class)
                    ->setPage($page);

        return $this->render('decoration_website/home/index.html.twig', [
            'pagination'    => $pagination,
            'categories'    => $categories,
            'subcategories'    => $subcategories,
        ]);
    }

}
