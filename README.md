# 🔧 FIXIT - Boutique Quincaillerie (Laravel + Bootstrap)

## ✅ Ce qui est inclus

### Pages Front-end
- **Accueil** (`/`) — Hero, catégories, 8 produits populaires, bannière promo
- **Boutique** (`/shop`) — Grille produits + sidebar filtres catégories
- **Détail produit** (`/product/{id}`) — Image, description, stock, bouton panier
- **Panier** (`/cart`) — Gestion quantités, résumé, livraison gratuite >50 000 FCFA
- **Checkout** (`/checkout`) — Formulaire livraison + choix paiement (Wave, Orange Money, Livraison)
- **Mes commandes** (`/orders`) — Liste et détail commandes client
- **Connexion/Inscription** (`/login`, `/register`)

### Dashboard Admin (`/admin`)
- **Dashboard** — Statistiques (produits, catégories, commandes, utilisateurs)
- **Produits** — Liste, ajout avec upload image, modification, suppression
- **Catégories** — CRUD complet
- **Commandes** — Liste avec changement de statut
- **Utilisateurs** — Liste des inscrits

---

## 🚀 Installation

```bash
# 1. Cloner / dézipper le projet
cd SiteQuincaillerie

# 2. Installer les dépendances
composer install

# 3. Copier le fichier d'environnement
cp .env.example .env

# 4. Générer la clé de l'application
php artisan key:generate

# 5. Configurer la base de données dans .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fixit_db
DB_USERNAME=root
DB_PASSWORD=

# 6. Lancer les migrations
php artisan migrate

# 7. Insérer les données de test (20 produits + admin)
php artisan db:seed

# 8. Créer le lien symbolique pour les images
php artisan storage:link

# 9. Lancer le serveur
php artisan serve
```

---

## 👤 Comptes de test

| Rôle   | Email             | Mot de passe |
|--------|-------------------|--------------|
| Admin  | admin@fixit.sn    | admin123     |
| Client | client@fixit.sn   | client123    |

---

## 📁 Structure des fichiers modifiés/créés

```
app/
  Http/Controllers/
    Admin/ProductController.php   ✅ Upload image
    AuthController.php            ✅ Validation + redirection
    CartController.php            ✅ Remove + clear
    CategoryController.php        ✅ Import corrigé
    HomeController.php            ✅ 8 produits
    OrderController.php           ✅ Checkout complet
    StoreController.php           ✅ Search + filtre catégorie
  Models/
    Order.php                     ✅ Corrigé (nom classe)
    OrderItem.php                 ✅ Nouveau fichier

database/
  migrations/
    create_orders_table.php       ✅ Nouveau (champs complets)
    create_order_items_table.php  ✅ Corrigé (order_id + price)
  seeders/
    DatabaseSeeder.php            ✅ 20 produits + 5 catégories + admin

resources/views/
  layouts/app.blade.php           ✅ Footer complet + menu latéral
  layouts/home.blade.php          ✅ Hero + catégories + produits
  shop.blade.php                  ✅ Sidebar filtres + badges stock
  product.blade.php               ✅ Breadcrumb + stock + avantages
  cart.blade.php                  ✅ Image + résumé + livraison gratuite
  checkout.blade.php              ✅ Wave / Orange Money / Livraison
  order_success.blade.php         ✅ Page confirmation
  order_detail.blade.php          ✅ Détail commande client
  orders.blade.php                ✅ Liste commandes client
  admin/dashboard.blade.php       ✅ Stats + tableaux
  admin/orders.blade.php          ✅ Gestion statuts
  admin/users.blade.php           ✅ Liste utilisateurs
  admin/categories.blade.php      ✅ CRUD avec compteur produits
  admin/products/
    create.blade.php              ✅ Upload image + preview
    edit.blade.php                ✅ Upload nouvelle image
    index.blade.php               ✅ Badges stock + sidebar admin
  auth/login.blade.php            ✅ Validation + design
  auth/register.blade.php         ✅ Confirmation mot de passe

public/css/style.css              ✅ CSS complet + responsive
routes/web.php                    ✅ Toutes les routes
```
