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


class ProductController extends AbstractController
{
    /**
     * @Route("/admin/product", name="addProduct")
     */
    public function addNewProduct(Request $request) : Response
    {
        // NOTE: https://symfony.com/doc/current/controller/upload_file.html
            $product = new Product();
            $form = $this->createForm(ProductType::class, $product);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) { /*
                //NOTE https://youtu.be/eGREghzYaYI tuto qui est censé être simple
                $uploads_directory = $this->getParameter('uploads_directory');
                //$product->setCreateDate(new Date());
                //NOTE get array of photos
                $photos = $request->files->get('post')['Photos'];

                //NOTE loop through the photos
                foreach ($photos as $photo)
                {
                    $filename = md5(uniqid()) . '.' . $photo->guessExtension();
                
                    $photo->move(
                        $uploads_directory,
                        $filename
                    );
                }
                */

//-------------------------------------------------------------------- 2é méthode

            /* @var UploadedFile $photoFile */
            //$photoFile = $form['Photos']->getData();
            
            // this condition is needed because the 'Photos' field is not required
            // so the image file must be processed only when a file is uploaded
            /*if ($photoFile) {
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photoFile->move(
                        $this->getParameter(root . '/uploads/images/'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'photoFilename' property to store the jpeg/bmp file name
                // instead of its contents
                $product->setphotoFilename($newFilename);
            }*/

            // ... persist the $product variable or any other work

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
            //return $this->redirect($this->generateUrl('app_product_list'));
            return $this-> redirectToRoute('adminProducts');
        } else {

            foreach ($form->getErrors(true) as $error) {
                echo $error->getMessage();
            }
        }
        
        return $this->render('admin/product_form.html.twig', [
            'form' => $form->createView(),
            'product' => $product,
        ]);
    }

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