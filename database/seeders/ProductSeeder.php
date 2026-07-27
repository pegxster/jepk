<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Catégories attendues (créées si absentes) + image de couverture + description courte.
     */
    private static array $categoryDefaults = [
        'Fils Rares'      => ['img' => 'assets/images/jepk1.jpg',  'desc' => 'Laines & fils rares sélectionnés pour vos créations.'],
        'Kits Signature'  => ['img' => 'assets/images/jepk9.jpg',  'desc' => 'Kits complets prêts à crocheter, fil + patron + accessoires.'],
        'Accessoires'     => ['img' => 'assets/images/jepk25.jpg', 'desc' => 'Sacs, bijoux et idées cadeaux faits main.'],
        'Maison'          => ['img' => 'assets/images/jepk42.jpg', 'desc' => 'Coussins, plaids, nappes et décorations crochetées.'],
        'Adulte'          => ['img' => 'assets/images/jepk5.jpg',  'desc' => 'Pulls, écharpes, bonnets et mode au crochet.'],
        'Enfant'          => ['img' => 'assets/images/jepk10.jpg', 'desc' => 'Layettes, doudous et vêtements pour les tout-petits.'],
    ];

    /**
     * 44 produits — un pour chaque photo disponible dans public/assets/images (jepk1.jpg → jepk44.jpg).
     * Prix de lancement modestes ; à ajuster ensuite depuis le tableau de bord admin.
     */
    private static array $products = [
        // ── Fils Rares ──
        ['Fils Rares', 'Laine Mérinos Soyeuse — Ivoire',        4500,  null,  'n'],
        ['Fils Rares', 'Alpaga des Andes — Camel',               6500,  null,  null],
        ['Fils Rares', 'Mohair & Soie — Lavande',                7000,  5500,  'p'],
        ['Fils Rares', 'Coton Bio Peigné — Blanc Cassé',         3500,  null,  null],
        ['Fils Rares', 'Laine Cachemire — Nude',                 8500,  null,  'n'],
        ['Fils Rares', 'Fil Bambou Doux — Vert Sauge',           4000,  null,  null],
        ['Fils Rares', 'Laine Bouclette — Terracotta',           5000,  null,  null],
        ['Fils Rares', 'Fil Chenille Velours — Rose Poudré',     5500,  4200,  'p'],

        // ── Kits Signature ──
        ['Kits Signature', 'Kit Pull Côtes Anglaises',           17500, null,  'n'],
        ['Kits Signature', 'Kit Écharpe Torsadée Hiver',         12000, null,  null],
        ['Kits Signature', 'Kit Bonnet Duo Débutante',           9500,  null,  null],
        ['Kits Signature', 'Kit Sac Filet Été',                  11000, 8500,  'p'],
        ['Kits Signature', 'Kit Chaussons Bébé',                 8000,  null,  null],
        ['Kits Signature', 'Kit Plaid Chevrons',                 18000, null,  'n'],
        ['Kits Signature', 'Kit Gilet Sans Manches',             15500, null,  null],
        ['Kits Signature', 'Kit Coussin Granny Square',          9000,  null,  null],

        // ── Accessoires ──
        ['Accessoires', 'Trousse Range-Crochets',                6000,  null,  null],
        ['Accessoires', 'Marque-Mailles Perles (Lot de 10)',     2500,  null,  null],
        ['Accessoires', 'Sac à Ouvrage Brodé',                   7000,  5500,  'p'],
        ['Accessoires', 'Anneaux Compteurs de Rangs',            3000,  null,  null],
        ['Accessoires', 'Crochets Ergonomiques (Set)',           6500,  null,  'n'],
        ['Accessoires', 'Pelotes Dévidoir Portable',             4500,  null,  null],
        ['Accessoires', 'Ciseaux Brodés Vintage',                3500,  null,  null],

        // ── Maison ──
        ['Maison', 'Coussin Crocheté Fait Main',                 9000,  null,  null],
        ['Maison', 'Nappe Ronde Dentelle',                       14000, null,  null],
        ['Maison', 'Plaid Chevrons Cocooning',                   19500, 15000, 'p'],
        ['Maison', 'Tapis Rond Tressé',                          13000, null,  null],
        ['Maison', 'Panière de Rangement Crochet',               8500,  null,  'n'],
        ['Maison', 'Set de Table Feuille (Lot de 4)',            6000,  null,  null],
        ['Maison', 'Suspension Macramé Fleurie',                 7500,  null,  null],

        // ── Adulte ──
        ['Adulte', 'Pull Col Roulé Douceur',                     22000, null,  'n'],
        ['Adulte', 'Gilet Long Bohème',                          24500, null,  null],
        ['Adulte', 'Écharpe Infinie Chevrons',                   11000, null,  null],
        ['Adulte', 'Bonnet Pompon Hiver',                        7500,  null,  null],
        ['Adulte', 'Poncho Franges Automne',                     19000, 15500, 'p'],
        ['Adulte', 'Châle Dentelle Soirée',                      16500, null,  null],
        ['Adulte', 'Sac à Main Crochet Été',                     13500, null,  null],

        // ── Enfant ──
        ['Enfant', 'Layette Naissance Douceur',                  12500, null,  'n'],
        ['Enfant', 'Doudou Lapin Crocheté',                      6500,  null,  null],
        ['Enfant', 'Bonnet Oreilles Ourson',                     5500,  null,  null],
        ['Enfant', 'Chaussons Bébé Coquillage',                  5000,  null,  null],
        ['Enfant', 'Robe Petite Fille Été',                      11500, 9000,  'p'],
        ['Enfant', 'Couverture Bébé Nuage',                      10500, null,  null],
        ['Enfant', 'Bavoir Brodé Naissance',                     4500,  null,  null],
    ];

    public function run(): void
    {
        // 1. Créer les catégories manquantes
        $categoryIds = [];
        foreach (self::$categoryDefaults as $name => $def) {
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name'        => $name,
                    'description' => $def['desc'],
                    'image'       => $def['img'],
                    'is_active'   => true,
                    'sort_order'  => 0,
                ]
            );
            $categoryIds[$name] = (string) $category->_id;
        }

        // 2. Créer les produits, un par photo (jepk1.jpg → jepk44.jpg)
        $created = 0;
        foreach (self::$products as $i => [$catName, $name, $price, $salePrice, $badge]) {
            $slug = Str::slug($name);
            if (Product::where('slug', $slug)->exists()) {
                continue;
            }

            $image = 'assets/images/jepk' . ($i + 1) . '.jpg';

            Product::create([
                'name'               => $name,
                'slug'               => $slug,
                'description'        => 'Création artisanale ' . strtolower($name) . ', réalisée à la main avec amour dans nos ateliers JEKP.',
                'short_description'  => 'Fait main · 100% artisanal',
                'price'              => $price,
                'sale_price'         => $salePrice,
                'images'             => [$image],
                'category_id'        => $categoryIds[$catName] ?? null,
                'category_name'      => $catName,
                'stock'              => rand(5, 30),
                'sku'                => 'JKP-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'is_active'          => true,
                'is_featured'        => in_array($badge, ['n', 'p']),
                'tags'               => [$catName, 'Artisanal', 'Handmade'],
                'materials'          => ['Laine & Coton'],
                'colors'             => ['Rose Poudré', 'Nude'],
                'badge'              => $badge,
                'rating'             => round(rand(40, 50) / 10, 1),
                'review_count'       => rand(0, 24),
            ]);

            $created++;
        }

        $this->command?->info("Produits JEKP : {$created} nouveaux produits ajoutés.");
    }
}
