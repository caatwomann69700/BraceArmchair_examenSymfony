<?php
// src/Controller/ProductsController.php
namespace App\Controller;

use App\Form\SearchType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/products', name: 'app_products')]
    public function index(ProductRepository $productRepository, Request $request): Response
    {
        // Créer le formulaire de recherche
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        $products = [];

        // Si le formulaire est soumis et valide, effectuer la recherche
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->get('category')->getData(); // Récupérer la catégorie sélectionnée
            if ($category) {
                $products = $productRepository->findBy(['category' => $category]); // Rechercher les produits par catégorie
            } else {
                $products = $productRepository->findAll(); // Si aucune catégorie n'est sélectionnée, afficher tous les produits
            }
        } else {
            // Si le formulaire n'est pas soumis, récupérer tous les produits
            $products = $productRepository->findAll();
        }

        // Afficher la vue avec les produits et le formulaire
        return $this->render('products/index.html.twig', [
            'products' => $products,
            'form' => $form->createView(), // Passer le formulaire à la vue
        ]);
    }

    #[Route('/product/{id}', name: 'product_show')]
    public function show(int $id, ProductRepository $productRepository): Response
    {
        // Récupérer le produit par son ID
        $product = $productRepository->find($id);

        // Si le produit n'existe pas, afficher une erreur 404
        if (!$product) {
            throw $this->createNotFoundException('The product does not exist');
        }

        // Rendre la vue avec les détails du produit
        return $this->render('show.html.twig', [
            'product' => $product,
        ]);
    }
}
