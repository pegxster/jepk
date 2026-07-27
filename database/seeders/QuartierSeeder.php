<?php

namespace Database\Seeders;

use App\Models\Quartier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QuartierSeeder extends Seeder
{
    /**
     * Quartiers d'Abidjan (source : OpenStreetMap — communes & quartiers).
     * Liste de base, réutilisable et enrichie automatiquement par les clients
     * via App\Models\Quartier::findOrCreateFromInput() au moment de la commande.
     */
    private static array $quartiers = [
        // Abobo
        ['Abobo', 'Abobo'], ['Abobo-Gare', 'Abobo'], ['PK18', 'Abobo'], ['Pk18-Plateau', 'Abobo'],
        ['Abobo-Peulh', 'Abobo'], ['Gboh-Kouéhi', 'Abobo'], ['Kouhikro', 'Abobo'], ['Lokojah', 'Abobo'],
        ['Morogbè', 'Abobo'], ['Abobo-Assagnier', 'Abobo'], ['Boulisth', 'Abobo'], ['Baldwin', 'Abobo'],
        ['Abobo-Niangon', 'Abobo'], ['Abobo Millionnaire', 'Abobo'], ['Abobo Tampico', 'Abobo'],
        ['Abobo PK5', 'Abobo'], ['Abobo Anonkoua-Kouté', 'Abobo'], ['Abobo Sagbé', 'Abobo'],
        ['Abobo Avocatier', 'Abobo'], ['Abobo Ahouanikro', 'Abobo'],

        // Adjamé
        ['Adjamé', 'Adjamé'], ['Boulay', 'Adjamé'], ['Chapelle', 'Adjamé'], ['Carrefour', 'Adjamé'],
        ['Atéouè', 'Adjamé'], ['Koutte', 'Adjamé'], ['Sépoto', 'Adjamé'], ['Issia', 'Adjamé'],
        ['Nouveau Marché', 'Adjamé'], ['Comité', 'Adjamé'], ['Liberté', 'Adjamé'], ['Bracodi', 'Adjamé'],
        ['220 Logements', 'Adjamé'],

        // Attécoubé
        ['Attécoubé', 'Attécoubé'], ['Adama Sanogo', 'Attécoubé'], ['Bédié', 'Attécoubé'],
        ['Gbégbéni', 'Attécoubé'], ['Kili', 'Attécoubé'], ['Yopougon Kouté', 'Attécoubé'],
        ['Abdjouhi', 'Attécoubé'], ['Bèmè', 'Attécoubé'], ['Locodjro', 'Attécoubé'], ['Santé', 'Attécoubé'],

        // Cocody
        ['Cocody', 'Cocody'], ['Riviera', 'Cocody'], ['Riviera 2', 'Cocody'], ['Riviera Palmeraie', 'Cocody'],
        ['Angré', 'Cocody'], ['Angré 8ème Tranche', 'Cocody'], ['Angré 9ème Tranche', 'Cocody'],
        ['Angré Château', 'Cocody'], ['An 2', 'Cocody'], ['Djorobè', 'Cocody'], ['Deux Plateaux', 'Cocody'],
        ['Les Ambassadeurs', 'Cocody'], ['Belleville', 'Cocody'], ['Cocody Koutte', 'Cocody'],
        ['Cocody II Plateaux', 'Cocody'], ['Murier', 'Cocody'], ['Camp Galion', 'Cocody'],
        ['Cocody Université', 'Cocody'], ['Cocody Angré', 'Cocody'], ['Cocody Mermoz', 'Cocody'],
        ['Riviera Golf', 'Cocody'], ['Cocody Les Palmiers', 'Cocody'], ['Blockhauss', 'Cocody'],
        ['Danga', 'Cocody'], ['Faya', 'Cocody'], ['M\'Badon', 'Cocody'], ['Attoban', 'Cocody'],

        // Koumassi
        ['Koumassi', 'Koumassi'], ['Remblais', 'Koumassi'], ['Séhicourt', 'Koumassi'],
        ['Kilometre 4', 'Koumassi'], ['Kilometre 8', 'Koumassi'], ['Niangon', 'Koumassi'],
        ['Tayavon', 'Koumassi'], ['Prodomo', 'Koumassi'], ['Sicogi', 'Koumassi'], ['Divo', 'Koumassi'],

        // Marcory
        ['Marcory', 'Marcory'], ['Zone 4', 'Marcory'], ['Zone 4B', 'Marcory'], ['Kpouessé', 'Marcory'],
        ['Résidentiel', 'Marcory'], ['Anoumabo', 'Marcory'], ['Biétry', 'Marcory'], ['VGE', 'Marcory'],
        ['Marcory Sécateur', 'Marcory'], ['Marcory Sud', 'Marcory'],

        // Plateau
        ['Plateau', 'Plateau'], ['Centre-ville', 'Plateau'], ['Rue du Commerce', 'Plateau'],
        ['Cité Administrative', 'Plateau'], ['Indénié', 'Plateau'], ['Sorbonne', 'Plateau'],

        // Port-Bouët
        ['Port-Bouët', 'Port-Bouët'], ['Vridi', 'Port-Bouët'], ['Aéroport', 'Port-Bouët'],
        ['Adjouffou', 'Port-Bouët'], ['Akouédo', 'Port-Bouët'], ['Gbagba', 'Port-Bouët'],
        ['Jean-Folly', 'Port-Bouët'], ['Vridi Canal', 'Port-Bouët'],

        // Treichville
        ['Treichville', 'Treichville'], ['Dar-Es-Salam', 'Treichville'], ['Belleville', 'Treichville'],
        ['Boucotte', 'Treichville'], ['Fort Médée', 'Treichville'], ['Kouamé Gnankpe', 'Treichville'],
        ['Madiano', 'Treichville'], ['Nouvelle Ville', 'Treichville'], ['Arras', 'Treichville'],

        // Yopougon
        ['Yopougon', 'Yopougon'], ['Yopougon Siporex', 'Yopougon'], ['Yopougon Niangon', 'Yopougon'],
        ['Yopougon Selmer', 'Yopougon'], ['Yopougon Andokoi', 'Yopougon'], ['Yopougon Mahou', 'Yopougon'],
        ['Yopougon Stélicité', 'Yopougon'], ['Yopougon Angré', 'Yopougon'], ['Yopougon Williamsville', 'Yopougon'],
        ['Yopougon Koumassi', 'Yopougon'], ['Yopougon Kouté', 'Yopougon'], ['Yopougon Hill', 'Yopougon'],
        ['Yopougon Koweit', 'Yopougon'], ['Yopougon Gesco', 'Yopougon'], ['Yopougon Toit Rouge', 'Yopougon'],
        ['Yopougon Wassakara', 'Yopougon'], ['Yopougon Sideci', 'Yopougon'], ['Yopougon Port-Bouët 2', 'Yopougon'],

        // Autres communes du District d'Abidjan
        ['Songon Agban', 'Songon'], ['Songon Kassemblé', 'Songon'], ['Songon Dagbé', 'Songon'],
        ['Bingerville', 'Bingerville'], ['Bingerville Centre', 'Bingerville'], ['Broukro', 'Bingerville'],
        ['M\'Badon Bingerville', 'Bingerville'],
        ['Anyama', 'Anyama'], ['Anyama Centre', 'Anyama'], ['Anyama Akporo', 'Anyama'],

        // Hors Abidjan (autres grandes villes de Côte d'Ivoire)
        ['Yamoussoukro', 'Yamoussoukro'], ['Bouaké', 'Bouaké'], ['San-Pédro', 'San-Pédro'],
        ['Daloa', 'Daloa'], ['Korhogo', 'Korhogo'], ['Man', 'Man'], ['Gagnoa', 'Gagnoa'],
        ['Abengourou', 'Abengourou'], ['Grand-Bassam', 'Grand-Bassam'],
    ];

    public function run(): void
    {
        $created = 0;

        foreach (self::$quartiers as [$nom, $commune]) {
            $norm = Str::lower(Str::ascii($nom));

            $exists = Quartier::where('nom_norm', $norm)
                ->where('commune_norm', Str::lower(Str::ascii($commune)))
                ->exists();

            if (!$exists) {
                Quartier::create([
                    'nom'       => $nom,
                    'commune'   => $commune,
                    'is_custom' => false,
                ]);
                $created++;
            }
        }

        $this->command?->info("Quartiers d'Abidjan : {$created} nouveaux quartiers ajoutés.");
    }
}
