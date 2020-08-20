<?php

namespace App\Controller;

use App\Entity\CategoryArt;
use App\Form\CategoryArtType;
use App\Repository\CategoryArtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category/art")
 */
class CategoryArtController extends AbstractController
{
    /**
     * @Route("/", name="category_art_index", methods={"GET"})
     */
    public function index(CategoryArtRepository $categoryArtRepository): Response
    {
        return $this->render('decoration_website/category_art/index.html.twig', [
            'category_arts' => $categoryArtRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="category_art_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categoryArt = new CategoryArt();
        $form = $this->createForm(CategoryArtType::class, $categoryArt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoryArt);
            $entityManager->flush();

            return $this->redirectToRoute('category_art_index');
        }

        return $this->render('decoration_website/category_art/new.html.twig', [
            'category_art' => $categoryArt,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_art_show", methods={"GET"})
     */
    public function show(CategoryArt $categoryArt): Response
    {
        return $this->render('decoration_website/category_art/show.html.twig', [
            'category_art' => $categoryArt,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="category_art_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CategoryArt $categoryArt): Response
    {
        $form = $this->createForm(CategoryArtType::class, $categoryArt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_art_index');
        }

        return $this->render('decoration_website/category_art/edit.html.twig', [
            'category_art' => $categoryArt,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_art_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CategoryArt $categoryArt): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoryArt->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoryArt);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_art_index');
    }
}
