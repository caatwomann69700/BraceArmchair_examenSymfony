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
            ['PLUMP',899.99 , 'Spacious sofa perfect for large living rooms.', 'Grey', 'Sofa', 'b0fab4170458263.65104d54cb441.jpg'],
            ['SAVOIRDI', 1599.99,'Inspired by the french Charlotte cake dessert.', 'Grey', 'Sofa', 'cf4194165327755.6405e0f1b2f3e.jpg'],
            ['QUARTER', 799.50, 'Modular sofa for humans and cats.', 'Blue', 'Chair', 'quarter.jpg'],
            ['SERENE', 1250.00, 'An elegant armchair designed for comfort.', 'Blue', 'Armchair', '84dffc202043091(1).66880a6877165.jpg'],
            ['PLOP', 550.75, 'A compact chair for small spaces.', 'Yellow', 'Chair', 'beb26279429221.5f709d632a82c.jpg'],
            ['SINUKUAN', 899.99, 'A stylish bench made from premium.', 'Brown', 'Bench', 'c30590204368187(1).66a88ad9899b3.jpg'],
            ['BAMBU', 2099.99, 'A modern sofa with clean lines.', 'Brown', 'Sofa', '1ffebb206451975.66ccea086a537.jpg'],
            ['PUTO POUF', 650.49, 'A cozy and versatile pouf for any room.', 'WHite', 'Stool', '2a27b2164084495.63f0b2280bf97.jpg'],
            ['CLOUDS', 1800.00, 'A high-end, comfortable sofa.', 'White', 'Sofa', '3c3052203490345.66a8f0308a7a2.jpg'],
            ['BALOO', 575.25, 'A trendy chair that complements any decor.', 'Black', 'Chair', '295cd5197126777.662ac9daafe89.png'],
            ['JOJO', 920.75, 'An armchair with a modern design.', 'Purple', 'Armchair', 'd7375c202578331.Y3JvcCwxNDAwLDEwOTUsMCwzODg.jpg'],
            ['SOLUNA', 900.00, 'A premium sofa offering comfort.', 'Beige', 'Sofa', 'f5453b203029889.Y3JvcCwyODAwLDIxOTAsMCw4MDM.jpg'],
            ['LUMINARO', 850.99, 'A chair that combines style and functionality.', 'Orange', 'Chair', '8e92b5206051895.66c5e41b4c123.jpg'],
            ['VELUDO', 1320.50, 'An armchair covered in soft velvet.', 'Dark Green', 'Armchair', '63a596184745293.655747489cf99.jpg'],
            ['BREEZE', 700.30, 'A wooden bench perfect.', 'Natural Wood', 'Bench', 'a5357b53978519.5948d1486e01d.jpg'],
            ['MORPHE', 2500.00, 'A minimalist stool ideal for modern homes.', 'Teal', 'Stool', '7eb397206355563.66cb7ed12a1f5.jpg'],
            ['MEZZO', 1750.25, 'A sofa that blends contemporary style.', 'Navy Blue', 'Sofa', '2c688d205706533.Y3JvcCwxMDgwLDg0NCwwLDExNw.jpg'],
            ['ORION', 925.99, 'A sturdy chair that adds character.', 'Dark Red', 'Chair', '8760f4185026033.655cadd664bf1.jpg'],
            ['MIRA', 1399.49, 'A plush armchair that invites relaxation.', 'Light Grey', 'Armchair', '2e0763170458263.650f5a97165f7.gif'],
            ['SPLASH', 650.75, 'A colorful bench that adds vibrancy.', 'Multicolor', 'Bench', '2e0763170458263.650f5a97165f7.gif'],
            ['PICO', 599.99, 'A compact stool perfect for tight spaces.', 'Cyan', 'Stool', '66b696151775017.6311d078b65ff.jpg'],
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

            // Ajouter 5 images à Imagelist pour chaque produit avec une boucle for
            for ($i = 1; $i <= 5; $i++) {
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
