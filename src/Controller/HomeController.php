<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository): Response
    {
        // Trouver le produit spécifique par son nom
        $product = $productRepository->findOneBy(['name' => 'PLUMP']);

        // Passer le produit à la vue
        return $this->render('home/index.html.twig', [
            'product' => $product,
        ]); 
    }
}

