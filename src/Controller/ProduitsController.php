<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ProduitsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
  public function create(): Response
  {
    $produits = new Produits();
    $produitsForm = $this->createForm(ProduitsType::class, $produits);

    return $this->render('produits/create.html.twig', [
      'produitsForm' => $produitsForm->createView()
    ]);
  }
}
