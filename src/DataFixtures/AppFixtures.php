<?php
namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Image;
use App\Entity\Imagelist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créer les catégories
        $categoriesData = [
            'Sofa' => 'Sofa',
            'Chair' => 'Chair',
            'Armchair' => 'Armchair',
            'Bench' => 'Bench',
            'Stool' => 'Stool'
        ];

        $categoryEntities = [];
        foreach ($categoriesData as $key => $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
            $categoryEntities[$key] = $category;
        }

        // Liste des produits avec prix, description, couleur, catégorie et image
        $productsData = [
            ['PLUMP', 1599.99, 'Inspired by the french Charlotte cake dessert.', 'Grey', 'Sofa', '2e0763170458263.650f5a97165f7.gif'],
            ['SAVOIRDI', 899.99,'Spacious sofa perfect for large living rooms.', 'Red', 'Sofa', '2e0763170458263.650f5a97165f7.gif'],
            ['QUARTER', 799.50, 'A versatile chair suitable for any room.', 'Blue', 'Chair', '2e0763170458263.650f5a97165f7.gif'],
            ['LUMINARO', 999.99, 'An elegant armchair designed for comfort.', 'Green', 'Armchair', '2e0763170458263.650f5a97165f7.gif'],
            ['PLOP', 550.75, 'A compact chair for small spaces.', 'Yellow', 'Chair', '2e0763170458263.650f5a97165f7.gif'],
            ['SINUKUAN', 1250.00, 'A stylish bench made from premium.', 'Brown', 'Bench', '2e0763170458263.650f5a97165f7.gif'],
            ['ISABLE', 1099.99, 'A modern sofa with clean lines.', 'Grey', 'Sofa', '2e0763170458263.650f5a97165f7.gif'],
            ['PUTO POUF', 650.49, 'A cozy and versatile pouf for any room.', 'Orange', 'Stool', '2e0763170458263.650f5a97165f7.gif'],
            ['CLOUDS', 1800.00, 'A high-end, comfortable sofa.', 'White', 'Sofa', '2e0763170458263.650f5a97165f7.gif'],
            ['LOOP', 575.25, 'A trendy chair that complements any decor.', 'Black', 'Chair', '2e0763170458263.650f5a97165f7.gif'],
            ['JOJO', 920.75, 'An armchair with a modern design.', 'Purple', 'Armchair', '2e0763170458263.650f5a97165f7.gif'],
            ['SOLUNA', 1900.00, 'A premium sofa offering comfort.', 'Beige', 'Sofa', '2e0763170458263.650f5a97165f7.gif'],
            ['TARMO', 850.99, 'A chair that combines style and functionality.', 'Pink', 'Chair', '2e0763170458263.650f5a97165f7.gif'],
            ['VELUDO', 1320.50, 'An armchair covered in soft velvet.', 'Dark Green', 'Armchair', '2e0763170458263.650f5a97165f7.gif'],
            ['BREEZE', 700.30, 'A wooden bench perfect.', 'Natural Wood', 'Bench', '2e0763170458263.650f5a97165f7.gif'],
            ['NOVA', 500.00, 'A minimalist stool ideal for modern homes.', 'Teal', 'Stool', '2e0763170458263.650f5a97165f7.gif'],
            ['MEZZO', 1750.25, 'A sofa that blends contemporary style.', 'Navy Blue', 'Sofa', '2e0763170458263.650f5a97165f7.gif'],
            ['ORION', 925.99, 'A sturdy chair that adds character.', 'Dark Red', 'Chair', '2e0763170458263.650f5a97165f7.gif'],
            ['MIRA', 1399.49, 'A plush armchair that invites relaxation.', 'Light Grey', 'Armchair', '2e0763170458263.650f5a97165f7.gif'],
            ['SPLASH', 650.75, 'A colorful bench that adds vibrancy.', 'Multicolor', 'Bench', '2e0763170458263.650f5a97165f7.gif'],
            ['PICO', 599.99, 'A compact stool perfect for tight spaces.', 'Cyan', 'Stool', '2e0763170458263.650f5a97165f7.gif'],
        ];

        // Créer les produits avec les images
        foreach ($productsData as $productData) {
            // Création du produit
            $product = new Product();
            $product->setName($productData[0]); // Nom
            $product->setPrice($productData[1]); // Prix
            $product->setDescription($productData[2]); // Description
            $product->setColor($productData[3]); // Couleur

            // Assigner la catégorie correspondante
            $category = $categoryEntities[$productData[4]];
            $product->setCategory($category);

            // Persist le produit avant de créer l'image
            $manager->persist($product);

            // Création de l'image associée au produit
            $image = new Image();
            $image->setName($productData[5]); // Chemin ou nom de l'image
            $image->setProduct($product); // Associer l'image au produit

            // Persist l'image associée au produit
            $manager->persist($image);

            // Associer l'image au produit dans le produit (relation OneToOne)
            $product->setImage($image);

            // Ajouter 4 images à Imagelist pour chaque produit avec une boucle for
            for ($i = 1; $i <= 4; $i++) {
                $imageList = new Imagelist();
                $imageList->setName('images/' . strtolower($productData[0]) . '/image' . $i . '.jpg'); // Générer les noms d'images dynamiquement
                $imageList->setProduct($product);

                // Persist chaque image dans Imagelist
                $manager->persist($imageList);
            }
        }

        $manager->flush();
    }
}
