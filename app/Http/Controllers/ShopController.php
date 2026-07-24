<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private static array $defaultProducts = [
        [
            'id'          => 'p1',
            'name'        => 'Laine Mérinos Soyeux',
            'slug'        => 'laine-merinos-soyeux',
            'category_name'=> 'Fils Rares',
            'price'       => 15000,
            'sale_price'  => null,
            'badge'       => 'n',
            'badge_label' => 'Nouveau',
            'image'       => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600',
            'stock'       => 12,
            'description' => 'Une laine mérinos ultra-douce, idéale pour des créations chaleureuses et respirantes.',
            'colors'      => ['Nude', 'Rose Poudré', 'Crème'],
            'materials'   => ['100% Laine Mérinos'],
        ],
        [
            'id'          => 'p2',
            'name'        => 'Kit Pull Couture N°1',
            'slug'        => 'kit-pull-couture-n1',
            'category_name'=> 'Kits Signature',
            'price'       => 55000,
            'sale_price'  => 45000,
            'badge'       => 'p',
            'badge_label' => 'Promo',
            'image'       => 'https://images.unsplash.com/photo-1584917865442-de89be371e2b?w=600',
            'stock'       => 8,
            'description' => 'Un kit complet avec le fil, le patron explicatif et le crochet pour confectionner votre pull.',
            'colors'      => ['Rose Vif', 'Lavande'],
            'materials'   => ['Laine & Alpaga'],
        ],
        [
            'id'          => 'p3',
            'name'        => 'Aiguilles Bambou Premium',
            'slug'        => 'aiguilles-bambou-premium',
            'category_name'=> 'Accessoires',
            'price'       => 12000,
            'sale_price'  => null,
            'badge'       => null,
            'badge_label' => null,
            'image'       => 'https://images.unsplash.com/photo-1574359411659-15573a27fd0c?w=600',
            'stock'       => 25,
            'description' => 'Set d\'aiguilles en bambou naturel lissé à la main pour une glisse parfaite des mailles.',
            'colors'      => ['Naturel'],
            'materials'   => ['Bambou Bio'],
        ],
        [
            'id'          => 'p4',
            'name'        => 'Alpaga des Andes Naturel',
            'slug'        => 'alpaga-des-andes-naturel',
            'category_name'=> 'Fils Rares',
            'price'       => 18500,
            'sale_price'  => null,
            'badge'       => 'n',
            'badge_label' => 'Nouveau',
            'image'       => 'https://images.unsplash.com/photo-1616400619175-5beda3a17896?w=600',
            'stock'       => 15,
            'description' => 'Fibres d\'alpaga d\'une douceur incomparable. Légèreté et isolation thermique d\'exception.',
            'colors'      => ['Camel', 'Chocolat'],
            'materials'   => ['100% Alpaga'],
        ],
        [
            'id'          => 'p5',
            'name'        => 'Kit Écharpe Hiver Doux',
            'slug'        => 'kit-echarpe-hiver-doux',
            'category_name'=> 'Kits Signature',
            'price'       => 27500,
            'sale_price'  => null,
            'badge'       => null,
            'badge_label' => null,
            'image'       => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600',
            'stock'       => 10,
            'description' => 'Tout le matériel nécessaire pour créer une écharpe torsadée tendance et cocooning.',
            'colors'      => ['Gris Rosé', 'Pêche'],
            'materials'   => ['Mérinos & Mohair'],
        ],
        [
            'id'          => 'p6',
            'name'        => 'Mohair & Soie Précieux',
            'slug'        => 'mohair-soie-precieux',
            'category_name'=> 'Fils Rares',
            'price'       => 26000,
            'sale_price'  => 21000,
            'badge'       => 'p',
            'badge_label' => 'Promo',
            'image'       => 'https://images.unsplash.com/photo-1584917865442-de89be371e2b?w=600',
            'stock'       => 6,
            'description' => 'Alliant le duvet du mohair et la brillance de la soie pour un rendu vaporeux et chic.',
            'colors'      => ['Lavande', 'Rose Poudré'],
            'materials'   => ['70% Mohair, 30% Soie'],
        ],
        [
            'id'          => 'p7',
            'name'        => 'Trousse Range-Aiguilles',
            'slug'        => 'trousse-range-aiguilles',
            'category_name'=> 'Accessoires',
            'price'       => 15500,
            'sale_price'  => null,
            'badge'       => 'n',
            'badge_label' => 'Nouveau',
            'image'       => 'https://images.unsplash.com/photo-1574359411659-15573a27fd0c?w=600',
            'stock'       => 20,
            'description' => 'Rangement élégant en tissu molletonné pour organiser tous vos crochets et aiguilles.',
            'colors'      => ['Rose Blush'],
            'materials'   => ['Coton Bio'],
        ],
        [
            'id'          => 'p8',
            'name'        => 'Kit Bonnet Débutant',
            'slug'        => 'kit-bonnet-debutant',
            'category_name'=> 'Kits Signature',
            'price'       => 19000,
            'sale_price'  => null,
            'badge'       => null,
            'badge_label' => null,
            'image'       => 'https://images.unsplash.com/photo-1616400619175-5beda3a17896?w=600',
            'stock'       => 14,
            'description' => 'Le kit idéal pour débuter au crochet et réaliser votre tout premier bonnet en quelques heures.',
            'colors'      => ['Nude', 'Camel'],
            'materials'   => ['100% Laine'],
        ],
        [
            'id'          => 'p9',
            'name'        => 'Laine Cachemire Nude',
            'slug'        => 'laine-cachemire-nude',
            'category_name'=> 'Fils Rares',
            'price'       => 29500,
            'sale_price'  => null,
            'badge'       => 'n',
            'badge_label' => 'Nouveau',
            'image'       => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600',
            'stock'       => 5,
            'description' => 'Cachemire pur d\'une extrême finesse. La quintessence du luxe et de la douceur.',
            'colors'      => ['Nude Rose'],
            'materials'   => ['100% Cachemire'],
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

        // Filtrage par catégorie
        if ($request->filled('categorie') && $request->categorie !== 'tous') {
            $catVal = $request->categorie;
            $query->where(function ($q) use ($catVal) {
                $q->where('category_id', $catVal)
                  ->orWhere('category_name', 'like', '%' . $catVal . '%')
                  ->orWhere('slug', $catVal);
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

