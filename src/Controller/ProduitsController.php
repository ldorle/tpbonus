<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ProduitsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/produits", name="produits_")
 */
class ProduitsController extends AbstractController
{
  /**
   * @Route("/create", name="create")
   */
  public function create(Request $request, EntityManagerInterface $entityManager): Response
  {
    $produits = new Produits();
    $produits->setPublished(true);
    $produits->setDateAdd(new \DateTime());
    $produits->setDateEdit(new \DateTime());

    $produitsForm = $this->createForm(ProduitsType::class, $produits);

    $produitsForm->handleRequest($request);

    if ($produitsForm->isSubmitted() && $produitsForm->isValid()) {
      $entityManager->persist($produits);
      $entityManager->flush();
      return $this->redirectToRoute('produits_details');
    }

    return $this->render('produits/create.html.twig', [
      'produitsForm' => $produitsForm->createView()
    ]);
  }

  /**
   * @Route("/details", name="details")
   */
  public function details() {
    return $this->render('produits/details.html.twig');
  }
}
