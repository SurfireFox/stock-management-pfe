# Stock Management PFE - Application E-commerce
## Contexte du projet


Stock Management PFE est une application e-commerce développée avec Laravel 9 et PHP 8. Ce projet vise à fournir une plateforme complète de gestion de produits, de paniers, de commandes et de paiements en ligne.

-  implémenter l’authentification avec Laravel  Breeze.
- Gérer les rôles et permissions pour restreindre l’accès aux fonctionnalités.
-  Développer un CRUD complet pour la gestion des produits et categorie avec Eloquent ORM.
-  Mettre en place un système de panier avec LocalStorage pour stocker les produits ajoutés.
- Intégrer le paiement en ligne avec Stripe.

## Structure du projet 

📂 Controllers
___\CategorieController.php
___\CommandeController.php
___\HomeController.php
___\ProduitController.php
___\ProduitDetailController.php
___\ShopController.php

📂 Models
___\Adresse.php
___\Categorie.php
___\Commande.php
___\Payment.php
___\Produit.php
___\ProduitCommande.php
___\Role.php
___\User.php




Accéder au dossier du projet ...

```
cd Stock Management PFE
```
Installer les dépendances  ...

```
composer install
npm install && npm run dev
```
Copier le fichier .env.example en .env et configurer la base de données  ...

```
cp .env.example .env
```
Modifier .env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Stock Management PFE
DB_USERNAME=root
DB_PASSWORD=
```
Générer la clé d'application

```
php artisan key:generate
```
Démarrer le serveur

```
php artisan serve
```

#   s t o c k - m a n a g e m e n t - p f e 
 
 #   s t o c k - m a n a g e m e n t - p f e 
 
 
