<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ProductController as AdminProduct;
use App\Http\Controllers\Admin\CategoryController as AdminCategory;
use App\Http\Controllers\Admin\OrderController as AdminOrder;
use App\Http\Controllers\Admin\BlogController as AdminBlog;
use App\Http\Controllers\Admin\MediaController as AdminMedia;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Admin\SlideController as AdminSlide;

/* ═══════════════════════════════════════════════════════
   PAGES PUBLIQUES
═══════════════════════════════════════════════════════ */

// Accueil
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [HomeController::class, 'surMesure'])->name('home.sur_mesure');

// Boutique
Route::prefix('boutique')->group(function () {
    Route::get('/',          [ShopController::class, 'index'])->name('shop.index');
    Route::get('/recherche', [ShopController::class, 'search'])->name('shop.search');
    Route::get('/{slug}',    [ShopController::class, 'show'])->name('shop.show');
});

// Catégories
Route::prefix('categories')->group(function () {
    Route::get('/',       [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/{slug}', [CategoryController::class, 'show'])->name('categories.show');
});

// Pages statiques & contenu
Route::prefix('pages')->group(function () {
    Route::get('/atelier',         [PageController::class, 'atelier'])->name('pages.atelier');
    Route::get('/blog',            [PageController::class, 'blog'])->name('pages.blog');
    Route::get('/blog/{slug}',     [PageController::class, 'blogPost'])->name('pages.blog.show');
    Route::get('/contact',         [PageController::class, 'contact'])->name('pages.contact');
    Route::get('/a-propos',        [PageController::class, 'about'])->name('pages.about');
    Route::get('/livraison',       [PageController::class, 'shipping'])->name('pages.shipping');
    Route::get('/cgv',             [PageController::class, 'terms'])->name('pages.terms');
    Route::get('/confidentialite', [PageController::class, 'privacy'])->name('pages.privacy');
    Route::get('/faq',             [PageController::class, 'faq'])->name('pages.faq');
});

// Newsletter
Route::post('/newsletter/inscription', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');

Route::get('/newsletter/desabonnement/{email}', [NewsletterController::class, 'unsubscribe'])
    ->middleware('signed')
    ->name('newsletter.unsubscribe');

/* ═══════════════════════════════════════════════════════
   PANIER — accessible sans connexion
═══════════════════════════════════════════════════════ */

Route::prefix('panier')->group(function () {
    Route::get('/',              [CartController::class, 'index'])->name('cart.index');
    Route::post('/ajouter',      [CartController::class, 'add'])->name('cart.add');
    Route::post('/modifier',     [CartController::class, 'update'])->name('cart.update');
    Route::post('/supprimer',    [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/vider',        [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/promo',        [CartController::class, 'applyPromo'])->name('cart.promo');
    Route::get('/mini',          [CartController::class, 'mini'])->name('cart.mini');
    Route::post('/ajouter-tout', [CartController::class, 'addAll'])->name('cart.addAll');
});

/* ═══════════════════════════════════════════════════════
   AUTHENTIFICATION — réservé aux invités (non connectés)
═══════════════════════════════════════════════════════ */

Route::middleware('guest')->group(function () {
    Route::get('/connexion',  [AuthController::class, 'loginForm'])->name('auth.login');
    Route::post('/connexion', [AuthController::class, 'login'])->name('auth.login.post');

    Route::get('/inscription',  [AuthController::class, 'registerForm'])->name('auth.register');
    Route::post('/inscription', [AuthController::class, 'register'])->name('auth.register.post');

    Route::get('/mot-de-passe-oublie',  [AuthController::class, 'forgotForm'])->name('auth.forgot');
    Route::post('/mot-de-passe-oublie', [AuthController::class, 'forgotSend'])->name('auth.forgot.post');

    Route::get('/reinitialiser/{token}', [AuthController::class, 'resetForm'])->name('auth.reset');
    Route::post('/reinitialiser',        [AuthController::class, 'resetPassword'])->name('auth.reset.post');
});

// Connexion sociale (Google, Facebook…)
Route::get('/auth/{provider}/redirect', [AuthController::class, 'socialRedirect'])->name('auth.social');
Route::get('/auth/{provider}/callback', [AuthController::class, 'socialCallback'])->name('auth.social.callback');

// Déconnexion
Route::post('/deconnexion', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('auth.logout');

/* ═══════════════════════════════════════════════════════
   COMMANDE / CHECKOUT
═══════════════════════════════════════════════════════ */

Route::prefix('commande')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');

    Route::post('/', [CheckoutController::class, 'process'])
        ->middleware('auth')
        ->name('checkout.process');

    Route::get('/merci/{order}', [CheckoutController::class, 'success'])
        ->middleware('auth')
        ->name('checkout.success');
});

// Webhook paiement (Stripe / PayDunya / Fedapay…) — sans CSRF
Route::post('/commande/webhook', [CheckoutController::class, 'webhook'])
    ->name('checkout.webhook')
    ->withoutMiddleware(['web']);

/* ═══════════════════════════════════════════════════════
   ESPACE CLIENT — connexion obligatoire
═══════════════════════════════════════════════════════ */

Route::prefix('mon-compte')->middleware('auth')->group(function () {

    Route::get('/', [AccountController::class, 'index'])->name('account.index');

    // Commandes
    Route::get('/commandes',                 [AccountController::class, 'orders'])->name('account.orders');
    Route::get('/commandes/{order}',         [AccountController::class, 'orderDetail'])->name('account.order');
    Route::get('/commandes/{order}/facture', [AccountController::class, 'invoice'])->name('account.invoice');

    // Profil
    Route::get('/profil',              [AccountController::class, 'profile'])->name('account.profile');
    Route::put('/profil',              [AccountController::class, 'profileUpdate'])->name('account.profile.update');
    Route::put('/profil/mot-de-passe', [AccountController::class, 'passwordUpdate'])->name('account.password.update');

    // Adresses
    Route::get('/adresses',                   [AccountController::class, 'addresses'])->name('account.addresses');
    Route::post('/adresses',                  [AccountController::class, 'addressStore'])->name('account.addresses.store');
    Route::put('/adresses/{address}',         [AccountController::class, 'addressUpdate'])->name('account.addresses.update');
    Route::delete('/adresses/{address}',      [AccountController::class, 'addressDestroy'])->name('account.addresses.destroy');
    Route::post('/adresses/{address}/defaut', [AccountController::class, 'addressDefault'])->name('account.addresses.default');

    // Notifications
    Route::get('/notifications',       [AccountController::class, 'notifications'])->name('account.notifications');
    Route::post('/notifications/lire', [AccountController::class, 'markRead'])->name('account.notifications.read');
});

/* ═══════════════════════════════════════════════════════
   WISHLIST — connexion obligatoire
═══════════════════════════════════════════════════════ */

Route::prefix('favoris')->middleware('auth')->group(function () {
    Route::get('/',              [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/ajouter',      [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/supprimer',    [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/basculer',     [WishlistController::class, 'toggle'])->name('wishlist.toggle');
});

/* ═══════════════════════════════════════════════════════
   ADMINISTRATION — accès admin uniquement
═══════════════════════════════════════════════════════ */

Route::prefix('admin')->name('admin.')->group(function () {

    // Connexion admin — pas de guest middleware (géré dans le controller)
    Route::get('/connexion',  [AdminAuth::class, 'loginForm'])->name('login');
    Route::post('/connexion', [AdminAuth::class, 'login'])->name('login.post');

    // Déconnexion admin (guard admin uniquement, pas le client)
    Route::post('/deconnexion', [AdminAuth::class, 'logout'])->name('logout');

    // Routes protégées — uniquement le middleware admin (guard admin)
    Route::middleware(['admin'])->group(function () {

    // Tableau de bord
    Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');

    // Produits
    Route::resource('produits', AdminProduct::class)->parameters(['produits' => 'product']);

    // Catégories
    Route::resource('categories', AdminCategory::class)->parameters(['categories' => 'category']);

    // Commandes
    Route::get('commandes',              [AdminOrder::class, 'index'])->name('orders.index');
    Route::get('commandes/{order}',      [AdminOrder::class, 'show'])->name('orders.show');
    Route::put('commandes/{order}/statut', [AdminOrder::class, 'updateStatus'])->name('orders.status');

    // Blog
    Route::resource('blog', AdminBlog::class)->parameters(['blog' => 'post']);

    // Médias
    Route::get('medias',          [AdminMedia::class, 'index'])->name('media.index');
    Route::post('medias/upload',  [AdminMedia::class, 'upload'])->name('media.upload');
    Route::delete('medias',       [AdminMedia::class, 'destroy'])->name('media.destroy');

    // Clients (inscrits sur le site)
    Route::get('utilisateurs',           [AdminUser::class, 'index'])->name('users.index');
    Route::delete('utilisateurs/{user}', [AdminUser::class, 'destroy'])->name('users.destroy');

    // Équipe admin (accès créés depuis le dashboard)
    Route::get('equipe',              [AdminUser::class, 'team'])->name('team.index');
    Route::post('equipe',             [AdminUser::class, 'teamStore'])->name('team.store');
    Route::delete('equipe/{user}',    [AdminUser::class, 'teamDestroy'])->name('team.destroy');

    // Carrousel
    Route::resource('carrousel', AdminSlide::class)->parameters(['carrousel' => 'slide']);

    }); // fin middleware auth+admin
}); // fin prefix admin