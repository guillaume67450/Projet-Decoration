<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminProductController extends AbstractController
{

    /**
     * @Route("/admin/products", name="admin_products_index")
     */
    public function index()
    {

        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->findAll();

        return $this->render('admin/product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/admin/product", name="addProduct")
     */
    public function addNewProduct(Request $request) : Response
    {
        // NOTE: https://symfony.com/doc/current/controller/upload_file.html
            $product = new Product();
            $form = $this->createForm(ProductType::class, $product);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) { 

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
            
            return $this-> redirectToRoute('admin_products_index');
        } else {

            foreach ($form->getErrors(true) as $error) {
                echo $error->getMessage();
            }
        }
        
        return $this->render('admin/product/_form.html.twig', [
            'form' => $form->createView(),
            'product' => $product,
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'édition d'un produit
     * 
     * @Route("/admin/products/{id}/edit", name="admin_products_edit")
     * 
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product, Request $request, EntityManagerInterface $manager) {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($product);
            $manager->flush();

            $this->addFlash(
                'success',
                "La saisie du produit <strong>{$product->getTitle()}</strong> a bien été prise en compte !"
            );
        }

        return $this->render('admin/product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }

        /**
     * Permet de supprimer un produit
     * 
     * @Route("/admin/products/{id}/delete", name="admin_products_delete")
     * 
     * @param Product $product
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Product $product, EntityManagerInterface $manager) {
        $manager->remove($product);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le produit <strong>{$product->getTitle()}</strong> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_products_index');
    }
}
