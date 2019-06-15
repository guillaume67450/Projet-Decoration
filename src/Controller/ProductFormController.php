<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Form\ProductType;

class ProductFormController extends AbstractController
{
    /**
     * @Route("/product/form", name="product_form")
     */
    public function index()
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        return $this->render('product_form/product_form.html.twig', [
            'controller_name' => 'ProductFormController',
            'form' => $form->createView(),
        ]);
    }
}
