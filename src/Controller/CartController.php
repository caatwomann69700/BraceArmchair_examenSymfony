<?php
namespace App\Controller;

use App\Service\Cartservice; // Correct name of your service
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $cartService;

    // Make sure the service name matches the case exactly
    public function __construct(Cartservice $cartService)
    {
        $this->cartService = $cartService;
    }

    #[Route('/cart', name: 'cart_index')]
    public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            'items' => $this->cartService->getCart(),
            'total' => $this->cartService->getTotal()
        ]);
    }

    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function add(int $id): RedirectResponse
    {
        $this->cartService->add($id);

        return $this->redirectToRoute('cart_index');
    }

    #[Route('/cart/remove/{id}', name: 'cart_remove')]
    public function remove(int $id): RedirectResponse
    {
        $this->cartService->remove($id);

        return $this->redirectToRoute('cart_index');
    }
}
