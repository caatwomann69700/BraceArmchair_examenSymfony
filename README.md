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

