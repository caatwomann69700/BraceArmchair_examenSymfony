<?php
namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Model\CartItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;
use App\Service\Cartservice; 

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository): Response
    {
        // Trouver les produits spécifiques par leur nom
        $products = [
            $productRepository->findOneBy(['name' => 'PLUMP']),
            $productRepository->findOneBy(['name' => 'PUTO POUF']),
            $productRepository->findOneBy(['name' => 'PICO'])
        ];

        // Passer les produits à la vue
        return $this->render('home/index.html.twig', [
            'products' => $products,
        ]); 
    }
    public function someControllerAction(Cartservice $cartService): Response
{
    return $this->render('some_template.html.twig', [
        'items' => $cartService->getCart(),
        'total' => $cartService->getTotal(),
    ]);
}

}
