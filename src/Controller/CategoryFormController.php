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
     * @Route("/admin/subcategories/{id}", name="adminSubCategories", defaults={"id"=null})
     */
    public function showSubCategories(Category $category = null)
    {
        // NOTE doctrine orm repository where not
        // https://stackoverflow.com/a/25421102
        $repo = $this->getDoctrine()->getRepository(Category::class);

        if ($category)
            $categories = $repo->findBy(['parent' => $category->getId()]);
        else
            $categories = $repo->findByParentNull(true);

        return $this->render('admin/sub_categories.html.twig', [
            'categories' => $categories,
        ]);
    }
    
    /**
     * @Route("/admin/category/{id}", name="categoryForm", defaults={"id"=null})
     */
    public function categoryForm(Request $request, Category $category = null) : Response
    {
        if (!isset($category))
            $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // $category->setCreateDate(new Date());
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('adminCategories');
        }
        
        return $this->render('admin/category_form.html.twig', [
            'form'     => $form->createView(),
            'category' => $category,
        ]);
    }

    /**
     * @Route("/admin/subcategory/{id}", name="subCategoryForm", defaults={"id"=null})
     */
    public function subCategoryForm(Request $request, Category $category = null) : Response
    {
        if (!isset($category))
            $category = new Category();

        $form = $this->createForm(SubCategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // $category->setCreateDate(new Date());
            $entityManager->persist($category);
            $entityManager->flush();
            return $this-> redirectToRoute('adminSubCategories');
        }

        return $this->render('admin/subcategory_form.html.twig', [
            'form'     => $form->createView(),
            'category' => $category,
        ]);
    }

}
