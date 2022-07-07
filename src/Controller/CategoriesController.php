<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories", name="categorie_")
 */
class CategoriesController extends AbstractController
{
  /**
   * @Route("/liste-des-categories", name="liste")
   */
  public function liste(CategoriesRepository $categoriesRepository): Response
  {
    $categories = $categoriesRepository->findAll();

    return $this->render('categories/liste.html.twig', [
      'categories' => $categories
    ]);
  }

  /**
   * @Route("/create", name="create")
   */
  public function create(Request $request, EntityManagerInterface $entityManager)
  {
    $categories = new Categories();
    $categories->setDateadd(new \DateTime());
    $categoriesForm = $this->createForm(CategoriesType::class, $categories);

    $categoriesForm->handleRequest($request);

    if ($categoriesForm->isSubmitted() && $categoriesForm->isValid()) {
      $entityManager->persist($categories);
      $entityManager->flush();

      return $this->redirectToRoute('main_home');
    }

    return $this->render('categories/create.html.twig', [
      'categoriesForm' => $categoriesForm->createView()
    ]);

  }
}
