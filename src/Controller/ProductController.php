<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;
use App\Entity\Product;
use App\Form\ProductType;

class ProductController extends AbstractController {
  #[Route('/products', name: 'product_index')]
  public function index(ProductRepository $repository): Response {
    $products = $repository->findAll();
    return $this->render('product/index.html.twig', [
      'products' => $products,
    ]);
  }

  #[Route('/products/{id<\d+>}', name: 'product_show')]
  public function show(Product $product): Response {
    return $this->render('product/show.html.twig', [
      'product' => $product
    ]);
  }

  #[Route('/products/new', name: 'product_new')]
  public function new(): Response {
    $form = $this->createForm(ProductType::class);
    return $this->render('product/new.html.twig', [
      'form' => $form
    ]);
  }
}
