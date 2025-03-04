<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/produit/{slug}', name: 'app_product')]
    public function index($slug,ProductRepository $productRepository,CategoryRepository $categoryRepository): Response
    {

        $product=$productRepository->findOneBySlug($slug);

        if (!$product) {
            return $this->redirectToRoute('app_home');
        }

        $categories=$categoryRepository->findAll();
        return $this->render('product/index.html.twig', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

}
