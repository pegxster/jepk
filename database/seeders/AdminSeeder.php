<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Compte admin
        User::updateOrCreate(
            ['email' => 'admin@jepk.com'],
            [
                'name'     => 'Admin JEPK',
                'password' => 'jepk2024!',
                'is_admin' => true,
            ]
        );

        $this->command->info('Admin créé : admin@jepk.com / jepk2024!');

        // Catégories de base
        $cats = [
            ['name' => 'Maison',      'slug' => 'maison',      'sort_order' => 1, 'description' => 'Coussins, plaids, nappes, tapis et décorations faites à la main pour votre intérieur.'],
            ['name' => 'Adulte',      'slug' => 'adulte',      'sort_order' => 2, 'description' => 'Pulls, gilets, écharpes et bonnets au crochet pour femmes et hommes.'],
            ['name' => 'Enfant',      'slug' => 'enfant',      'sort_order' => 3, 'description' => 'Layettes, doudous, peluches et vêtements doux pour bébés et enfants.'],
            ['name' => 'Accessoires', 'slug' => 'accessoires', 'sort_order' => 4, 'description' => 'Sacs, pochettes, bijoux et idées cadeaux au crochet.'],
        ];

        foreach ($cats as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], array_merge($cat, ['is_active' => true]));
        }

        $this->command->info(count($cats) . ' catégories créées.');

        // Produit exemple
        if (Product::count() === 0) {
            $firstCat = Category::first();
            Product::create([
                'name'              => 'Pull en laine mérinos — Rose Poudré',
                'slug'              => 'pull-laine-merinos-rose-poudre',
                'short_description' => 'Douceur et élégance pour vos soirées d\'hiver.',
                'description'       => 'Ce pull intemporel est confectionné à la main avec une laine mérinos de qualité supérieure. Sa couleur rose poudré s\'adapte à toutes les tenues, casual ou chic.',
                'price'             => 45000,
                'stock'             => 12,
                'sku'               => 'JEPK-001',
                'category_id'       => $firstCat ? (string) $firstCat->_id : null,
                'category_name'     => $firstCat?->name,
                'is_active'         => true,
                'is_featured'       => true,
                'badge'             => 'Nouveau',
                'materials'         => ['Laine mérinos', 'Soie'],
                'colors'            => ['Rose poudré'],
                'tags'              => ['hiver', 'made in ivory coast', 'tendance'],
                'images'            => [],
                'rating'            => 4.8,
                'review_count'      => 24,
            ]);
            $this->command->info('Produit exemple créé.');
        }
    }
}
