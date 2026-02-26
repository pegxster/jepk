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