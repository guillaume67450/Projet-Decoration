<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Form\SubCategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCategoryController extends AbstractController
{

    /**
     * Permet de supprimer une catégorie
     * 
     * @Route("/admin/category/{id}/delete", name="admin_categories_delete")
     * 
     * @param Category $category
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Category $category, EntityManagerInterface $manager) {
        $manager->remove($category);
        $manager->flush();

        $this->addFlash(
            'success',
            "La catégorie <strong>{$category->getName()}</strong> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_dashboard');
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
        
        return $this->render('admin/category/_form.html.twig', [
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

        return $this->render('admin/subcategory/_form.html.twig', [
            'form'     => $form->createView(),
            'category' => $category,
        ]);
    }
}
