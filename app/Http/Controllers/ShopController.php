<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private static array $defaultProducts = [
        [
            'id'           => 'p1',
            'name'         => 'Robe Soleil',
            'slug'         => 'robe-soleil',
            'category_name'=> 'Robes',
            'price'        => 20000,
            'sale_price'   => null,
            'badge'        => 'n',
            'badge_label'  => 'Nouveau',
            'image'        => 'assets/images/catalogue/image2.jpg',
            'stock'        => 9999,
            'description'  => 'Robe légère au crochet, parfaite pour le soleil. Disponible en S, M, L, XL sur commande.',
            'colors'       => ['Nude', 'Rose Poudré', 'Blanc'],
            'materials'    => ['Laine au crochet 100% fait main'],
        ],
        [
            'id'           => 'p2',
            'name'         => 'Top Bohème',
            'slug'         => 'top-boheme',
            'category_name'=> 'Tops',
            'price'        => 5000,
            'sale_price'   => null,
            'badge'        => null,
            'badge_label'  => null,
            'image'        => 'assets/images/catalogue/image9.jpg',
            'stock'        => 9999,
            'description'  => 'Top féminin au crochet, décontracté et chic. Personnalisable en taille et couleur.',
            'colors'       => ['Rose', 'Lavande', 'Camel'],
            'materials'    => ['Laine au crochet 100% fait main'],
        ],
        [
            'id'           => 'p3',
            'name'         => 'Chapeau Panama',
            'slug'         => 'chapeau-panama',
            'category_name'=> 'Chapeaux',
            'price'        => 6000,
            'sale_price'   => null,
            'badge'        => 'n',
            'badge_label'  => 'Nouveau',
            'image'        => 'assets/images/catalogue/image40.jpg',
            'stock'        => 9999,
            'description'  => 'Chapeau artisanal au crochet, style et originalité. Taille unique ou sur mesure.',
            'colors'       => ['Nude', 'Blanc', 'Naturel'],
            'materials'    => ['Laine au crochet 100% fait main'],
        ],
        [
            'id'           => 'p4',
            'name'         => 'Sac Mini Bohème',
            'slug'         => 'sac-mini-boheme',
            'category_name'=> 'Sacs à Main',
            'price'        => 5000,
            'sale_price'   => null,
            'badge'        => null,
            'badge_label'  => null,
            'image'        => 'assets/images/catalogue/image47.jpg',
            'stock'        => 9999,
            'description'  => 'Sac à main bohème en crochet, léger et unique. Personnalisable en couleur.',
            'colors'       => ['Rose', 'Camel', 'Brun'],
            'materials'    => ['Laine au crochet 100% fait main'],
        ],
        [
            'id'           => 'p5',
            'name'         => 'Duo Amoureux',
            'slug'         => 'duo-amoureux',
            'category_name'=> 'Tenues Couple',
            'price'        => 25000,
            'sale_price'   => null,
            'badge'        => 'n',
            'badge_label'  => 'Nouveau',
            'image'        => 'assets/images/catalogue/image37.jpg',
            'stock'        => 9999,
            'description'  => 'Ensemble assorti pour deux, créé au crochet avec amour. Idéal pour les occasions spéciales.',
            'colors'       => ['Blanc & Nude', 'Rose & Brun'],
            'materials'    => ['Laine au crochet 100% fait main'],
        ],
        [
            'id'           => 'p6',
            'name'         => 'Bouquet Élégant',
            'slug'         => 'bouquet-elegant',
            'category_name'=> 'Bouquets de Fleurs',
            'price'        => 13000,
            'sale_price'   => null,
            'badge'        => null,
            'badge_label'  => null,
            'image'        => 'assets/images/catalogue/image70.jpg',
            'stock'        => 9999,
            'description'  => 'Bouquet de fleurs éternel au crochet — ne fane jamais ! Cadeau idéal pour toutes occasions.',
            'colors'       => ['Rose', 'Rouge', 'Multicolore'],
            'materials'    => ['Laine au crochet 100% fait main'],
        ],
        [
            'id'           => 'p7',
            'name'         => 'Boléro Festif',
            'slug'         => 'bolero-festif',
            'category_name'=> 'Boléros',
            'price'        => 7000,
            'sale_price'   => null,
            'badge'        => null,
            'badge_label'  => null,
            'image'        => 'assets/images/catalogue/image12.jpg',
            'stock'        => 9999,
            'description'  => 'Boléro festif au crochet pour sublimer toutes vos tenues. Sur mesure disponible.',
            'colors'       => ['Blanc', 'Nude', 'Rose'],
            'materials'    => ['Laine au crochet 100% fait main'],
        ],
        [
            'id'           => 'p8',
            'name'         => 'Miroir Ovale Déco',
            'slug'         => 'miroir-ovale-deco',
            'category_name'=> 'Miroirs Crochetés',
            'price'        => 6000,
            'sale_price'   => null,
            'badge'        => 'n',
            'badge_label'  => 'Nouveau',
            'image'        => 'assets/images/catalogue/image73.jpg',
            'stock'        => 9999,
            'description'  => 'Miroir décoratif entouré d\'un cadre en crochet fait main. Pièce unique pour votre intérieur.',
            'colors'       => ['Naturel', 'Blanc', 'Brun'],
            'materials'    => ['Laine au crochet 100% fait main'],
        ],
        [
            'id'           => 'p9',
            'name'         => 'Sac Ordi Mini',
            'slug'         => 'sac-ordi-mini',
            'category_name'=> "Sacs d'Ordinateur",
            'price'        => 5000,
            'sale_price'   => null,
            'badge'        => null,
            'badge_label'  => null,
            'image'        => 'assets/images/catalogue/image63.jpg',
            'stock'        => 9999,
            'description'  => 'Sac pour ordinateur au crochet, alliant style artisanal et fonctionnalité. Résistant et unique.',
            'colors'       => ['Camel', 'Brun', 'Noir'],
            'materials'    => ['Laine au crochet 100% fait main'],
        ],
    ];

    public function index(Request $request)
    {
        $query = Product::active();

        // Recherche par mot-clé
        $searchTerm = $request->input('search') ?: $request->input('q');
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('category_name', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filtrage par catégorie (nom exact en priorité)
        if ($request->filled('categorie') && $request->categorie !== 'tous') {
            $catVal = $request->categorie;
            $query->where(function ($q) use ($catVal) {
                $q->where('category_name', $catVal)
                  ->orWhere('category_id', $catVal)
                  ->orWhere('category_name', 'like', '%' . $catVal . '%');
            });
        }

        // Prix min / max
        if ($request->filled('prix_min')) {
            $query->where('price', '>=', (float) $request->prix_min);
        }
        if ($request->filled('prix_max')) {
            $query->where('price', '<=', (float) $request->prix_max);
        }

        // Tri
        if ($request->filled('tri')) {
            match($request->tri) {
                'prix_asc'  => $query->orderBy('price', 'asc'),
                'prix_desc' => $query->orderBy('price', 'desc'),
                'nouveaute' => $query->orderBy('created_at', 'desc'),
                'popularite'=> $query->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc'),
                default     => $query->orderBy('created_at', 'desc'),
            };
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        // Si aucun produit en base de données, utiliser les produits par défaut filtrés
        $displayProducts = $products;
        if ($products->isEmpty() && !Product::exists()) {
            $list = collect(self::$defaultProducts);

            if (!empty($searchTerm)) {
                $term = strtolower($searchTerm);
                $list = $list->filter(fn($p) => str_contains(strtolower($p['name']), $term) || str_contains(strtolower($p['category_name']), $term));
            }
            if ($request->filled('categorie') && $request->categorie !== 'tous') {
                $cat = strtolower($request->categorie);
                $list = $list->filter(fn($p) => str_contains(strtolower($p['category_name']), $cat) || str_contains(strtolower($p['slug']), $cat));
            }
            if ($request->filled('prix_max')) {
                $maxP = (float) $request->prix_max;
                $list = $list->filter(fn($p) => ($p['sale_price'] ?? $p['price']) <= $maxP);
            }
            if ($request->filled('tri')) {
                match($request->tri) {
                    'prix_asc'  => $list = $list->sortBy('price'),
                    'prix_desc' => $list = $list->sortByDesc('price'),
                    default     => null,
                };
            }
            $displayProducts = $list->values();
        }

        return view('shop.index', [
            'products'        => $products,
            'displayProducts' => $displayProducts,
            'categories'      => $categories,
            'defaultProducts' => self::$defaultProducts,
        ]);
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->first();

        // Si non trouvé en BDD, chercher dans les produits par défaut
        if (!$product) {
            $found = collect(self::$defaultProducts)->firstWhere('slug', $slug);

            if (!$found) {
                // Fallback sur le premier si slug inconnu
                $found = self::$defaultProducts[0];
            }

            // Convertir en objet générique
            $product = (object) [
                '_id'              => $found['id'],
                'name'             => $found['name'],
                'slug'             => $found['slug'],
                'description'      => $found['description'],
                'short_description'=> $found['description'],
                'price'            => $found['price'],
                'sale_price'       => $found['sale_price'],
                'image'            => $found['image'],
                'images'           => [$found['image']],
                'category_name'    => $found['category_name'],
                'stock'            => $found['stock'],
                'colors'           => $found['colors'],
                'materials'        => $found['materials'],
                'tags'             => [$found['category_name'], 'Artisanal', 'Handmade'],
            ];
        }

        $related = Product::active()
            ->where('_id', '!=', $product->_id ?? null)
            ->limit(4)->get();

        if ($related->isEmpty()) {
            $related = collect(self::$defaultProducts)
                ->where('slug', '!=', $slug)
                ->take(4)
                ->map(fn($p) => (object)[
                    '_id'          => $p['id'],
                    'name'         => $p['name'],
                    'slug'         => $p['slug'],
                    'price'        => $p['price'],
                    'sale_price'   => $p['sale_price'],
                    'image'        => $p['image'],
                    'images'       => [$p['image']],
                    'category_name'=> $p['category_name'],
                    'badge'        => $p['badge'],
                ]);
        }

        return view('shop.show', compact('product', 'related'));
    }
}

