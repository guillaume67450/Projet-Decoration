<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product;
use App\Entity\Category;
use App\Form\ProductType;

class ProductFormController extends AbstractController
{
    /**
     * @Route("/admin/product", name="addProduct")
     */
    public function index(Request $request) : Response
    {
        
            $product = new Product();
            $form = $this->createForm(ProductType::class, $product);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                //$product->setCreateDate(new Date());
                $entityManager->persist($product);
                $entityManager->flush();
                return $this-> redirectToRoute('adminProducts');
            }
        
        return $this->render('admin/product_form.html.twig', [
            'form' => $form->createView(),
            'product' => $product,
        ]);
    }

    /**
     * @Route("/admin/products", name="adminProducts")
     */
    public function showProducts()
    {

        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->findAll();

        return $this->render('admin/products.html.twig', [
            'products' => $products,
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("admin/product/{id}/{type}", name="productForm", defaults={"id"=null,"type"=null}, methods={"GET","POST"})
     */
    public function productForm(Request $request, string $id = null, string $type = null) : Response
    {
        if (!isset($id))
        {
            $product = new Product();
        }
        else
        {
            switch ($type)
            {
                case 'category' :
                    // NOTE Get category by id
                    $catRepo  = $this->getDoctrine()->getRepository(Category::class);
                    $category = $catRepo->findOneBy(['id' => $id]);
                    // NOTE Set category to new product
                    $product = new Product();
                    $product->setCategory($category);
                    break;
                case 'product' :
                    // NOTE Get product by id
                    $proRepo = $this->getDoctrine()->getRepository(Product::class);
                    $product = $proRepo->findOneBy(['id' => $id]);
                    break;
                default :
                    $product = new Product();
                    break;
            }
        }

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('adminProducts');
        }

        return $this->render('admin/product_form.html.twig', [
            'form'    => $form->createView(),
            'product' => $product,
        ]);
    }
}
