<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Service\PaginationService;


class ProductController extends AbstractController
{
    /**
     * @Route("/admin/product/delete/{id}", name="deleteProduct")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        return $this-> redirectToRoute('adminProducts');
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

        return $this->render('admin/product/_form.html.twig', [
            'form'    => $form->createView(),
            'product' => $product,
        ]);
    }
}