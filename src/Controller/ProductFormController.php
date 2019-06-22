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

     * @Route("/{id}/editProduct", name="editProduct", methods={"GET","POST"})

     */

    public function editProduct(Request $request, Product $product): Response

    {

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $this->getDoctrine()->getManager()->flush();
            return $this-> redirectToRoute('adminProducts');
        }


        return $this->render('admin/product_form.html.twig', [
            'form' => $form->createView(),
            'product' => $product,
        ]);
    }
}
