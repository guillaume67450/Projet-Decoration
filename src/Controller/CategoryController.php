<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Form\SubCategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
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

        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/admin/subcategories/{id}", name="adminSubCategories", defaults={"id"=null})
     */
    public function showSubCategories(Category $category = null)
    {
        // NOTE recherche google : doctrine orm repository where not
        // https://stackoverflow.com/a/25421102
        $repo = $this->getDoctrine()->getRepository(Category::class);

        if ($category)
            $categories = $repo->findBy(['parent' => $category->getId()]);
        else
            $categories = $repo->findByParentNull(true);

        return $this->render('admin/subcategory/index.html.twig', [
            'categories' => $categories,
        ]);
    }

}
