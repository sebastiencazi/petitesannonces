<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/categories", name="admin_categories_")
 * @package App\Controller\Admin
 */

class CategoriesController extends AbstractController
{
    /**
     * @Route("/", name="Ma_page_accueil")
     */
    public function index(CategoriesRepository $catsRepo): Response
    {
        return $this->render('admin/categories/index.html.twig', [
            'categories' => $catsRepo->findAll()
        ]);
    }

    /**
     * @Route("/ajout", name="ajout")
     */
    public function ajoutCategorie(Request $request): Response
    {
        $categorie = new Categories;

        $form = $this->createForm(CategoriesType::class, $categorie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('admin_categories_Ma_page_accueil');

        }

        return $this->render('admin/categories/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function ModifCategorie(Categories $categorie, Request $request): Response
    {
        $form = $this->createForm(CategoriesType::class, $categorie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('admin_categories_Ma_page_accueil');

        }

        return $this->render('admin/categories/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
