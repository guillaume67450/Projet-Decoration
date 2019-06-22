<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Form\SubCategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryFormController extends AbstractController
{
    /**
     * @Route("/admin/categories", name="adminCategories")
     */
    public function showCategories()
    {

        $repo = $this->getDoctrine()->getRepository(Category::class);

        $categories = $repo->findBy(
            ['parent' => null]
        );

        return $this->render('admin/categories.html.twig', [
            'categories' => $categories,
        ]);
    } 

    /**
     * @Route("/admin/subcategories", name="adminSubCategories")
     */
    public function showSubCategories()
    {

        // // example1: creating a QueryBuilder instance
        // $qb = $em->createQueryBuilder();

        // // $qb instanceof QueryBuilder

        // $qb->select('cat')
        // ->from('Category', 'cat')
        // ->where('cat.parent IS NOT NULL')


        // //2é exemple :
        // $em = $this->getEntityManager();
        // $qb = $em->createQueryBuilder();
        
        // $qb->select(array('a', 'c'))
        //    ->from('Sdz\BlogBundle\Entity\Article', 'a')
        //    ->leftJoin('a.comments', 'c');
        
        // $query = $qb->getQuery();
        // $results = $query->getResult();
        
        // return $results;




        $repo = $this->getDoctrine()->getRepository(Category::class);

        $categories = $repo->findBy(
            ['parent' => '806']
        );
        return $this->render('admin/categories.html.twig', [
            'categories' => $categories,
        ]);
    }
    
    /**
     * @Route("/admin/category", name="addCategory")
     */
    public function CreateCategory(Request $request) : Response
    {
        
            $category = new Category();
            $form = $this->createForm(CategoryType::class, $category);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                //$category->setCreateDate(new Date());
                $entityManager->persist($category);
                $entityManager->flush();
                return $this-> redirectToRoute('adminCategories');
            }
        
        return $this->render('admin/category_form.html.twig', [
            'form' => $form->createView(),
            'category' => $category,
        ]);
    }

    /**
     * @Route("/admin/subcategory", name="addSubCategory")
     */
    public function CreateSubCategory(Request $request) : Response
    {
        
            $category = new Category();
            $form = $this->createForm(SubCategoryType::class, $category);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                //$category->setCreateDate(new Date());
                $entityManager->persist($category);
                $entityManager->flush();
                return $this-> redirectToRoute('adminSubCategories');
            }
        
        return $this->render('admin/subcategory_form.html.twig', [
            'form' => $form->createView(),
            'category' => $category,
        ]);
    }
    

    /**

     * @Route("/{id}/edit", name="editCategory", methods={"GET","POST"})

     */

    public function edit(Request $request, Category $category): Response

    {

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $this->getDoctrine()->getManager()->flush();
            return $this-> redirectToRoute('adminCategories');
        }


        return $this->render('admin/category_form.html.twig', [
            'form' => $form->createView(),
            'category' => $category,
        ]);
    }

    
}
