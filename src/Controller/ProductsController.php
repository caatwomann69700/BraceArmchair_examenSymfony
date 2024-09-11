<?php
// src/Controller/ProductsController.php
namespace App\Controller;

use App\Entity\Product; // N'oublie pas d'importer l'entité Product
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

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer la catégorie sélectionnée
            $category = $form->get('category')->getData();

            if ($category) {
                // Filtrer les produits par catégorie
                $products = $productRepository->findBy(['category' => $category]);
            } else {
                $products = $productRepository->findAll();
            }
        } else {
            // Si le formulaire n'est pas soumis, afficher tous les produits
            $products = $productRepository->findAll();
        }

        // Rendre la vue avec le formulaire et les produits
        return $this->render('products/index.html.twig', [
            'products' => $products,
            'form' => $form->createView(),  // Important: Utiliser createView() pour passer le formulaire
        ]);
    }

    // Route pour afficher un produit individuel
    #[Route('/product/{id}', name: 'product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('products/show.html.twig', [
            'product' => $product,
        ]);
    }
}
