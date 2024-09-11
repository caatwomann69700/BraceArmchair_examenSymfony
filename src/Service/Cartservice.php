<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\ProductRepository;
use App\Model\CartItem;

class Cartservice
{
    private $session;
    private $productRepository;

    public function __construct(RequestStack $requestStack, ProductRepository $productRepository)
    {
        $this->session = $requestStack->getSession();
        $this->productRepository = $productRepository;
    }

    public function add(int $id): void
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $this->session->set('cart', $cart);
    }

    public function remove(int $id): void
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }

        $this->session->set('cart', $cart);
    }

    public function getCart(): array
    {
        $cart = $this->session->get('cart', []);

        $cartItems = [];
        foreach ($cart as $id => $quantity) {
            $product = $this->productRepository->find($id);
            if ($product) {
                $cartItems[] = new CartItem($product, $quantity);
            }
        }

        return $cartItems;
    }

    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->getCart() as $item) {
            $total += $item->getProduct()->getPrice() * $item->getQuantity();
        }

        return $total;
    }

    public function getItemCount(): int
    {
        $cart = $this->session->get('cart', []);
        return array_sum($cart);
    }
}
