<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CatalogueSeeder extends Seeder
{
    /*
     * Catalogue JEPK — créations artisanales au crochet
     * Source : CATALOGUE JEPK.pptx (images extraites dans public/assets/images/catalogue/)
     *
     * Tarification : prix exprimés en FCFA (K = × 1 000)
     * Exemple : 20K = 20 000 FCFA, 4K5 = 4 500 FCFA, 600F = 600 FCFA
     */
    private static array $catalogue = [

        /* ─── ROBES ─────────────────────────────────────────── */
        [
            'category' => 'Robes',
            'products' => [
                ['Robe Soleil',       20000, 'image2.jpg', 'S : 20 000 F · M : 24 000 F · L : 28 000 F'],
                ['Robe Légère',       20000, 'image1.jpg', 'S : 20 000 F · M : 24 000 F · L : 28 000 F'],
                ['Robe Festive',      35000, 'image4.png', 'S : 35 000 F · M : 43 000 F · L : 50 000 F'],
                ['Robe Quotidienne',  15000, 'image3.jpg', 'S : 15 000 F · M : 18 000 F · L : 21 000 F'],
                ['Robe Évasée',       40000, 'image6.jpg', 'S : 40 000 F · M : 47 000 F · L : 54 000 F'],
                ['Robe Casual Chic',  18000, 'image5.jpg', 'S : 18 000 F · M : 23 000 F · L : 28 000 F'],
                ['Robe Élégante',     24000, 'image7.jpg', 'S : 24 000 F · M : 28 000 F · L : 32 000 F'],
            ],
        ],

        /* ─── TOPS ───────────────────────────────────────────── */
        [
            'category' => 'Tops',
            'products' => [
                ['Top Bohème',   5000, 'image9.jpg',  'S : 5 000 F · M : 7 000 F · L : 9 000 F'],
                ['Top Plissé',   6000, 'image8.jpg',  'S : 6 000 F · M : 8 000 F · L : 10 000 F'],
                ['Top Raffiné',  6000, 'image11.jpg', 'S : 6 000 F · M : 8 000 F · L : 11 000 F'],
                ['Top Nuancé',   7000, 'image10.jpg', 'S : 7 000 F · M : 9 000 F · L : 11 000 F'],
            ],
        ],

        /* ─── BOLÉROS ────────────────────────────────────────── */
        [
            'category' => 'Boléros',
            'products' => [
                ['Boléro Délicat',   4500, 'image13.jpg', 'S : 4 500 F · M : 6 000 F · L : 7 500 F · XL : 9 000 F'],
                ['Boléro Festif',    7000, 'image12.jpg', 'S : 7 000 F · M : 8 500 F · L : 10 000 F · XL : 12 000 F'],
                ['Boléro Prestige', 25000, 'image15.jpg', 'S : 25 000 F · M : 30 000 F · L : 35 000 F · XL : 37 000 F'],
                ['Boléro Tendance',  7000, 'image14.jpg', 'S : 7 000 F · M : 8 500 F · L : 10 000 F · XL : 12 000 F'],
            ],
        ],

        /* ─── TENUES PLAGE ───────────────────────────────────── */
        [
            'category' => 'Tenues Plage',
            'products' => [
                ['Set Plage Mini',       6000, 'image20.jpg',  'S : 6 000 F · M : 8 000 F · L : 10 000 F · XL : 12 000 F'],
                ['Set Bord de Mer',     13000, 'image19.jpg',  'S : 13 000 F · M : 16 000 F · L : 18 000 F · XL : 21 000 F'],
                ['Set Plage Premium',   18000, 'image23.jpeg', 'S : 18 000 F · M : 20 000 F · L : 22 000 F · XL : 28 000 F'],
                ['Set Plage Vacances',  12000, 'image22.jpg',  'S : 12 000 F · M : 15 000 F · L : 17 000 F · XL : 20 000 F'],
                ['Set Plage Soleil',     8000, 'image21.jpg',  'S : 8 000 F · M : 9 000 F · L : 10 000 F · XL : 13 000 F'],
            ],
        ],

        /* ─── ENSEMBLE HOMMES ────────────────────────────────── */
        [
            'category' => 'Ensemble Hommes',
            'products' => [
                ['Ensemble Gentleman',  30000, 'image33.jpg', 'S : 30 000 F · M : 35 000 F · L : 37 000 F · XL : 40 000 F'],
                ['Ensemble Casual',     23000, 'image32.jpg', 'S : 23 000 F · M : 25 000 F · L : 27 000 F · XL : 30 000 F'],
                ['Ensemble Prestige',   45000, 'image35.jpg', 'S : 45 000 F · M : 50 000 F · L : 52 000 F · XL : 60 000 F'],
                ['Ensemble Classique',  27000, 'image34.jpg', 'S : 27 000 F · M : 28 000 F · L : 29 000 F · XL : 31 000 F'],
            ],
        ],

        /* ─── COUPLE ─────────────────────────────────────────── */
        [
            'category' => 'Tenues Couple',
            'products' => [
                ['Duo Amoureux',    25000, 'image37.jpg', 'S : 25 000 F · M : 30 000 F · L : 32 000 F · XL : 35 000 F'],
                ['Duo Harmonie',    28000, 'image36.jpg', 'S : 28 000 F · M : 30 000 F · L : 35 000 F · XL : 40 000 F'],
                ['Duo Complicité',  25000, 'image38.jpg', 'S : 25 000 F · M : 26 000 F · L : 27 000 F · XL : 30 000 F'],
            ],
        ],

        /* ─── CHAPEAUX ───────────────────────────────────────── */
        [
            'category' => 'Chapeaux',
            'products' => [
                ['Chapeau Panama',    6000, 'image40.jpg', '6 000 F'],
                ['Chapeau Soleil',   12000, 'image39.jpg', '12 000 F'],
                ['Chapeau Casual',    5000, 'image42.jpg', '5 000 F'],
                ['Chapeau Bucket',    4000, 'image41.jpg', '4 000 F'],
                ['Chapeau Été',       4000, 'image44.jpg', '4 000 F'],
                ['Chapeau Tendance',  5000, 'image43.jpg', '5 000 F'],
                ['Chapeau Élégant',   6000, 'image45.jpg', '6 000 F'],
            ],
        ],

        /* ─── SACS À MAIN ────────────────────────────────────── */
        [
            'category' => 'Sacs à Main',
            'products' => [
                ['Sac Mini Bohème', 5000, 'image47.jpg', '5 000 F'],
                ['Sac Chic',        9000, 'image46.jpg', '9 000 F'],
                ['Sac Élégant',     9000, 'image49.jpg', '9 000 F'],
                ['Sac Casual',      7000, 'image48.jpg', '7 000 F'],
            ],
        ],

        /* ─── ENFANTS ────────────────────────────────────────── */
        [
            'category' => 'Enfants',
            'products' => [
                ['Set Bébé Rose',      8000, 'image51.jpg', '0 à 6 mois : 8 000 F'],
                ['Set Enfant Coloré', 10000, 'image50.jpg', '8-12 ans : 10 000 F · 1-3 ans : 12 000 F · 3-5 ans : 14 000 F'],
                ['Set Enfant Fleuri',  8000, 'image52.jpg', '0-6 mois : 8 000 F · 8-12 ans : 10 000 F · 1-3 ans : 12 000 F'],
            ],
        ],

        /* ─── SACS TRAFOIL ───────────────────────────────────── */
        [
            'category' => 'Sacs Trafoil',
            'products' => [
                ['Sac Trafoil Grand',   13000, 'image54.jpg', '13 000 F'],
                ['Sac Trafoil Classic', 13000, 'image53.jpg', '13 000 F'],
                ['Sac Trafoil Mini',     8000, 'image55.jpg',  '8 000 F'],
            ],
        ],

        /* ─── SACS CUSTOMISÉS ────────────────────────────────── */
        [
            'category' => 'Sacs Customisés',
            'products' => [
                ['Sac Brodé Floral',       11000, 'image57.jpg', '11 000 F — Le prix peut varier selon la forme ou la grandeur'],
                ['Sac Customisé Luxe',     15000, 'image56.jpg', '15 000 F — Le prix peut varier selon la forme ou la grandeur'],
                ['Sac Arabesque',          16000, 'image59.jpg', '16 000 F — Le prix peut varier selon la forme ou la grandeur'],
                ['Sac Patchwork',           8000, 'image58.jpg',  '8 000 F — Le prix peut varier selon la forme ou la grandeur'],
                ['Sac Géométrique',         9000, 'image61.jpg',  '9 000 F — Le prix peut varier selon la forme ou la grandeur'],
                ['Sac Motifs Tropicaux',   12000, 'image60.jpg', '12 000 F — Le prix peut varier selon la forme ou la grandeur'],
                ['Sac Filigrane',          10000, 'image62.jpg', '10 000 F — Le prix peut varier selon la forme ou la grandeur'],
            ],
        ],

        /* ─── SACS D'ORDINATEUR ──────────────────────────────── */
        [
            'category' => "Sacs d'Ordinateur",
            'products' => [
                ['Sac Ordi Slim',     8000, 'image64.jpeg', '8 000 F — Le prix peut varier selon la taille de l\'ordinateur'],
                ['Sac Ordi Mini',     5000, 'image63.jpg',  '5 000 F — Le prix peut varier selon la taille de l\'ordinateur'],
                ['Sac Ordi Pro',      8000, 'image67.jpg',  '8 000 F — Le prix peut varier selon la taille de l\'ordinateur'],
                ['Sac Ordi Casual',   6000, 'image66.jpg',  '6 000 F — Le prix peut varier selon la taille de l\'ordinateur'],
                ['Sac Ordi Premium', 10000, 'image65.jpg', '10 000 F — Le prix peut varier selon la taille de l\'ordinateur'],
            ],
        ],

        /* ─── BOUQUETS DE FLEURS ─────────────────────────────── */
        [
            'category' => 'Bouquets de Fleurs',
            'products' => [
                ['Bouquet Élégant',  13000, 'image70.jpg', '13 000 F — Le prix varie selon le nombre de fleurs et le modèle'],
                ['Bouquet Grand',    20000, 'image69.jpg', '20 000 F — Le prix varie selon le nombre de fleurs et le modèle'],
                ['Bouquet Mini',      6000, 'image72.jpg',  '6 000 F — Le prix varie selon le nombre de fleurs et le modèle'],
                ['Bouquet Simple',    2500, 'image71.jpg',  '2 500 F — Le prix varie selon le nombre de fleurs et le modèle'],
            ],
        ],

        /* ─── MIROIRS ────────────────────────────────────────── */
        [
            'category' => 'Miroirs Crochetés',
            'products' => [
                ['Miroir Rond Simple',   2000, 'image74.jpg', '2 000 F (sans miroir) · 6 000 F (avec miroir)'],
                ['Miroir Ovale Déco',    6000, 'image73.jpg', '6 000 F sans miroir'],
                ['Miroir Bohème',        6000, 'image77.jpg', '6 000 F sans miroir'],
                ['Miroir Artisanal',    10000, 'image76.jpg', '10 000 F sans miroir'],
                ['Miroir Prestige',     15000, 'image75.jpg', '15 000 F sans miroir'],
            ],
        ],

        /* ─── CHOUCHOUS ──────────────────────────────────────── */
        [
            'category' => 'Chouchous',
            'products' => [
                ['Chouchou Fuchsia', 4000, 'image79.jpg', '4 000 F'],
                ['Chouchou Nude',    1000, 'image78.jpg', '1 000 F'],
                ['Chouchou Trio',    1500, 'image82.jpg', '1 500 F'],
                ['Chouchou Coloré',  1500, 'image81.jpg', '1 500 F'],
                ['Chouchou Pastel',  1000, 'image80.jpg', '1 000 F'],
            ],
        ],

        /* ─── PORTE-CLÉS ─────────────────────────────────────── */
        [
            'category' => 'Porte-Clés',
            'products' => [
                ['Porte-Clés Lapin',  600, 'image84.jpg',  '600 F'],
                ['Porte-Clés Étoile', 600, 'image83.jpg',  '600 F'],
                ['Porte-Clés Cœur',   600, 'image87.jpg',  '600 F'],
                ['Porte-Clés Rond',   600, 'image86.jpeg', '600 F'],
                ['Porte-Clés Mini',   600, 'image85.jpeg', '600 F'],
            ],
        ],

        /* ─── BARRETTES ──────────────────────────────────────── */
        [
            'category' => 'Barrettes',
            'products' => [
                ['Barrette Festive',  1000, 'image89.jpg',  '1 000 F'],
                ['Barrette Simple',    500, 'image88.jpg',  '500 F'],
                ['Barrette Fleurie',  1000, 'image92.jpeg', '1 000 F'],
                ['Barrette Élégante',  500, 'image91.jpg',  '500 F'],
                ['Barrette Colorée',  1000, 'image90.jpeg', '1 000 F'],
            ],
        ],
    ];

    public function run(): void
    {
        // Vider les collections existantes
        Product::truncate();
        Category::truncate();

        foreach (self::$catalogue as $group) {
            $catName = $group['category'];
            $firstImg = $group['products'][0][2] ?? null;

            // Créer ou retrouver la catégorie
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($catName)],
                [
                    'name'  => $catName,
                    'image' => $firstImg ? "assets/images/catalogue/{$firstImg}" : null,
                    'is_active' => true,
                ]
            );

            foreach ($group['products'] as [$name, $price, $imageFile, $pricingLabel]) {
                $imagePath = "assets/images/catalogue/{$imageFile}";

                Product::create([
                    'name'              => $name,
                    'slug'              => Str::slug($name) . '-' . uniqid(),
                    'category_id'       => (string) $category->_id,
                    'category_name'     => $catName,
                    'price'             => $price,
                    'sale_price'        => null,
                    'description'       => $pricingLabel,
                    'short_description' => $pricingLabel,
                    'images'            => [$imagePath],
                    'stock'             => 9999,
                    'is_active'         => true,
                    'is_featured'       => false,
                    'badge'             => null,
                    'materials'         => ['Laine au crochet'],
                    'colors'            => [],
                    'tags'              => [strtolower($catName)],
                ]);
            }
        }

        $total = Product::count();
        $cats  = Category::count();
        $this->command->info("✓ Catalogue importé : {$total} articles dans {$cats} catégories.");
    }
}
