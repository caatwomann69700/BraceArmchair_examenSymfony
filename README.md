# Brace Armchair - Symfony Project

### **Nom** : Débiani  
### **Prénom** : Sarah  
### **Promo** : dwwrs6  
### **Date** : 09/09/2024  

---

## 1. Création du projet Symfony avec Webapp

Pour commencer, j'ai utilisé la commande suivante pour créer le projet avec Symfony version 6.4 et Webapp :  
```bash
symfony new Brace_Armchair --webapp --version=6.4
```
---
## 2. Configuration de l'environnement de la base de données

J'ai configuré l'environnement de base de données en créant le fichier .env.local et en y ajoutant la ligne suivante :
```bash
DATABASE_URL="mysql://root:@127.0.0.1:3306/jenny_way?serverVersion=8.0.32&charset=utf8mb4"
```
---
## 3. Création du premier contrôleur - Home
Le premier contrôleur, HomeController, a été créé avec la commande suivante :
```bash
php bin/console make:controller

```
---
## 4. Modification de la route pour la page d'accueil
Pour que la page d'accueil s'affiche dès l'entrée sur le site, j'ai modifié la route dans HomeController.php :
De :
```php
#[Route('/home', name: 'app_home')]
```
---
A ca 
---
```php
#[Route('', name: 'app_home')]
```
---
## 5. Installation de Bootstrap
Pour ajouter Bootstrap au projet, j'ai utilisé la commande suivante :
```bash
php bin/console importmap:require bootstrap
```
---
## 6. Création de la base de données
J'ai créé la base de données jenny_way avec la commande suivante :
```bash
php bin/console doctrine:database:create
```
---
## 7. Création des entités
Les entités suivantes ont été créées avec leurs relations :
### product
### Category
### NewsletterSubscription
### image 
### imagelist
```bash
php bin/console make:entity
```
---
Relations entre les entités :
### Product ↔ Category : Relation OneToMany
### Product ↔ Image : Relation OneToOne
### Product ↔ ImageList : Relation ManyToOne
---
## 8. Création de la migration
J'ai généré les migrations avec la commande suivante :
```bash
php bin/console make:migration
```
---
## 9. Application de la migration
Les migrations ont ensuite été appliquées à la base de données avec :
```bash
php bin/console doctrine:migrations:migrate
```
---
## 10. Vérification de la base de données
Enfin, j'ai vérifié dans phpMyAdmin que la base de données a bien été migrée correctement.

---
## 11. Installation des Fixtures
```bash
composer require --dev orm-fixtures
```
---
## 12.  Création des entités dans la méthode load
Instancier toutes les entités que l'on souhaite enregistrer dans la base de données dans la méthode load de la classe AppFixtures.

---
## 12.  Ajout des données dans AppFixtures
Dans le fichier AppFixtures.php, ajouter les données suivantes à insérer en base de données :
PLUMP
SAVOIRDI SOFA
QUARTER
LUMINARO
PLOP CHAIR
SINUKUAN
ISABLE
PUTO POUF
CLOUDS
LOOP
JOJO
---
## 13.  Création du contrôleur Products
php bin/console make:controller ProductsController

---
## 13.  10. Chargement des données en base
```bash
php bin/console doctrine:fixtures:load
```
---
## Création de la navigation 
```bash
php bin/console make:controller
```
---
## Création de la page détaillée d'un produit 
```bash
php bin/console make:controller
```
---
## Création d'une Newsletter
Étapes :
Création de l'entité Newsletter :
php bin/console make:entity Newsletter
Propriétés : email et subscribedAt.

Migration de la base de données :
php bin/console make:migration
php bin/console doctrine:migrations:migrate.

Création du formulaire NewsletterType :
php bin/console make:form NewsletterType.

Création du contrôleur SubscriberController :
php bin/console make:controller SubscriberController.
Traitement du formulaire et logique d'envoi d'email :

Ajout du formulaire dans subscriber/subscribe.html.twig.
Installation de Mailer : composer require symfony/mailer.
Configuration du service d'email dans .env avec MAILER_DSN.
Test de l'envoi d'emails avec Mailhog (environnement de développement) :
brew install mailhog.

---
## Gestion CRUD pour les produits
Étapes :
Création du CRUD pour l'entité Product :
php bin/console make:crud.

Gestion de l'administration :

Création d'une interface pour l'administrateur permettant d'ajouter, modifier et supprimer des produits via EasyAdmin.

---
## Gestion des utilisateurs et authentification
Étapes :
Création de l'entité User avec les propriétés email, password, et roles :
php bin/console make:user.

Migration de la base de données :
php bin/console make:migration
php bin/console doctrine:migrations:migrate.

Génération de fixtures utilisateurs :
php bin/console make:fixtures UserFixtures
php bin/console doctrine:fixtures:load.

Création d'un formulaire de login :
php bin/console make:auth.

Ajout des fonctionnalités d'inscription et connexion pour les utilisateurs :

Modification du formulaire d'inscription (RegistrationController).
Gestion des rôles pour ROLE_USER et ROLE_ADMIN.
---
## Page détaillée des produits
Étapes :
Création d'une méthode show dans ProductController pour afficher les détails d'un produit.

Création de la vue show.html.twig pour afficher les informations spécifiques à chaque produit.

Ajout de liens vers la page de détail des produits dans la liste des produits.
---
## Gestion des images supplémentaires pour chaque produit
Étapes :
Création d'une entité ProductImage pour gérer les images supplémentaires des produits.

Migration de la base de données et gestion de l'upload des images via un formulaire.

Affichage des images supplémentaires dans les pages de détail des produits.
---
## Gestion des images supplémentaires pour chaque produit
Création d'une méthode pour ajouter des produits au panier dans CartController.

Création des pages du panier et du paiement.

Ajout d'un bouton "Payer" dans le panier pour rediriger vers la page de paiement.
---
## Création d'une barre de recherche
Étapes :
Création du formulaire de recherche SearchType :
php bin/console make:form SearchType.

Création du contrôleur SearchController pour gérer la logique de recherche.

Ajout de la logique de recherche dans ProductRepository pour filtrer les produits.

Intégration du formulaire de recherche dans la barre de navigation (base.html.twig).