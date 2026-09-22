<?php

namespace Database\Seeders;

use App\Models\Quartier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QuartierSeeder extends Seeder
{
    private static array $quartiers = [
        // ── ABOBO ──────────────────────────────────────────────────────
        ['Abobo', 'Abobo'], ['Abobo-Gare', 'Abobo'], ['Abobo Baoulé', 'Abobo'],
        ['PK18', 'Abobo'], ['PK22', 'Abobo'], ['PK24', 'Abobo'],
        ['Abobo Sagbé', 'Abobo'], ['Abobo Avocatier', 'Abobo'],
        ['Abobo Peulh', 'Abobo'], ['Abobo Millionnaire', 'Abobo'],
        ['Abobo Tampico', 'Abobo'], ['Abobo Anonkoua-Kouté', 'Abobo'],
        ['Abobo Doumé', 'Abobo'], ['Abobo Assagnier', 'Abobo'],
        ['Abobo Ahouanikro', 'Abobo'], ['Abobo Niangon', 'Abobo'],
        ['Baldwin', 'Abobo'], ['Boulisth', 'Abobo'],
        ['Clouetcha', 'Abobo'], ['Clouetcha 1', 'Abobo'], ['Clouetcha 2', 'Abobo'],
        ['Derrière Rails', 'Abobo'], ['Derrière Rails II', 'Abobo'],
        ['Gboh-Kouéhi', 'Abobo'], ['Houphouëtville', 'Abobo'],
        ['Kouhikro', 'Abobo'], ['Koweit', 'Abobo'],
        ['Lokojah', 'Abobo'], ['Morogbè', 'Abobo'],
        ['M\'Pouto', 'Abobo'], ['Agnissankoi', 'Abobo'],
        ['Sogefiha', 'Abobo'], ['Château', 'Abobo'],
        ['Zone Industrielle Abobo', 'Abobo'],

        // ── ADJAMÉ ──────────────────────────────────────────────────────
        ['Adjamé', 'Adjamé'], ['Adjamé Liberté', 'Adjamé'],
        ['Williamsville', 'Adjamé'], ['Fraternité', 'Adjamé'],
        ['Boulay', 'Adjamé'], ['Chapelle', 'Adjamé'],
        ['Carrefour Adjamé', 'Adjamé'], ['Atéouè', 'Adjamé'],
        ['Koutte', 'Adjamé'], ['Sépoto', 'Adjamé'],
        ['Nouveau Marché', 'Adjamé'], ['Comité', 'Adjamé'],
        ['Bracodi', 'Adjamé'], ['220 Logements', 'Adjamé'],
        ['Liberté', 'Adjamé'], ['Williamsville II', 'Adjamé'],
        ['Adjamé Commerce', 'Adjamé'], ['Marché Adjamé', 'Adjamé'],
        ['Anador', 'Adjamé'], ['Siafato', 'Adjamé'],

        // ── ATTÉCOUBÉ ──────────────────────────────────────────────────
        ['Attécoubé', 'Attécoubé'], ['Adama Sanogo', 'Attécoubé'],
        ['Bédié', 'Attécoubé'], ['Gbégbéni', 'Attécoubé'],
        ['Kili', 'Attécoubé'], ['Locodjro', 'Attécoubé'],
        ['Santé', 'Attécoubé'], ['Agban Village', 'Attécoubé'],
        ['Washington', 'Attécoubé'], ['Azito', 'Attécoubé'],
        ['Bèmè', 'Attécoubé'], ['Abdjouhi', 'Attécoubé'],
        ['Yopougon Kouté', 'Attécoubé'], ['Attécoubé Camp', 'Attécoubé'],

        // ── COCODY ──────────────────────────────────────────────────────
        ['Cocody', 'Cocody'], ['Cocody Centre', 'Cocody'],
        ['Riviera 1', 'Cocody'], ['Riviera 2', 'Cocody'],
        ['Riviera 3', 'Cocody'], ['Riviera 4', 'Cocody'],
        ['Riviera Faya', 'Cocody'], ['Riviera Maya', 'Cocody'],
        ['Riviera Golf', 'Cocody'], ['Riviera Palmeraie', 'Cocody'],
        ['Angré', 'Cocody'], ['Angré 7ème Tranche', 'Cocody'],
        ['Angré 8ème Tranche', 'Cocody'], ['Angré 9ème Tranche', 'Cocody'],
        ['Angré Château', 'Cocody'], ['Bonoumin', 'Cocody'],
        ['II Plateaux', 'Cocody'], ['Les Vallons', 'Cocody'],
        ['II Plateaux Les Vallons', 'Cocody'], ['Mermoz', 'Cocody'],
        ['Ambassades', 'Cocody'], ['Les Ambassadeurs', 'Cocody'],
        ['Djibi', 'Cocody'], ['Palmeraie', 'Cocody'],
        ['Blockhauss', 'Cocody'], ['Blokosso', 'Cocody'],
        ['Saint-Jean', 'Cocody'], ['Anono', 'Cocody'],
        ['Danga', 'Cocody'], ['Faya Cocody', 'Cocody'],
        ['M\'Badon', 'Cocody'], ['Attoban', 'Cocody'],
        ['An 2', 'Cocody'], ['Djorobè', 'Cocody'],
        ['Deux Plateaux', 'Cocody'], ['Belleville Cocody', 'Cocody'],
        ['Cocody Koutte', 'Cocody'], ['Murier', 'Cocody'],
        ['Camp Galion', 'Cocody'], ['Cocody Université', 'Cocody'],
        ['Les Palmiers', 'Cocody'], ['Cité des Arts', 'Cocody'],
        ['Camp Banco', 'Cocody'],

        // ── KOUMASSI ──────────────────────────────────────────────────
        ['Koumassi', 'Koumassi'], ['Koumassi Centre', 'Koumassi'],
        ['Remblais', 'Koumassi'], ['Séhicourt', 'Koumassi'],
        ['Grand Campement', 'Koumassi'], ['Sicobois', 'Koumassi'],
        ['Kilometre 4', 'Koumassi'], ['Kilometre 8', 'Koumassi'],
        ['Niangon Koumassi', 'Koumassi'], ['Tayavon', 'Koumassi'],
        ['Prodomo', 'Koumassi'], ['Sicogi', 'Koumassi'],
        ['Zone Industrielle Koumassi', 'Koumassi'],
        ['Génie 2000', 'Koumassi'], ['Extension Koumassi', 'Koumassi'],
        ['Divo Koumassi', 'Koumassi'], ['Campement', 'Koumassi'],

        // ── MARCORY ──────────────────────────────────────────────────
        ['Marcory', 'Marcory'], ['Marcory Centre', 'Marcory'],
        ['Zone 4', 'Marcory'], ['Zone 4B', 'Marcory'],
        ['Zone 4 Extension', 'Marcory'], ['Kpouessé', 'Marcory'],
        ['Résidentiel Marcory', 'Marcory'], ['Anoumabo', 'Marcory'],
        ['Biétry', 'Marcory'], ['VGE', 'Marcory'],
        ['Marcory Sécateur', 'Marcory'], ['Marcory Sud', 'Marcory'],
        ['Sans-Fil', 'Marcory'], ['Bel-Air', 'Marcory'],

        // ── PLATEAU ──────────────────────────────────────────────────
        ['Plateau', 'Plateau'], ['Centre-ville', 'Plateau'],
        ['Rue du Commerce', 'Plateau'], ['Cité Administrative', 'Plateau'],
        ['Indénié', 'Plateau'], ['Sorbonne', 'Plateau'],
        ['Ebrie', 'Plateau'],

        // ── PORT-BOUËT ──────────────────────────────────────────────────
        ['Port-Bouët', 'Port-Bouët'], ['Port-Bouët Centre', 'Port-Bouët'],
        ['Vridi', 'Port-Bouët'], ['Vridi Canal', 'Port-Bouët'],
        ['Aéroport', 'Port-Bouët'], ['Adjouffou', 'Port-Bouët'],
        ['Akouédo', 'Port-Bouët'], ['Gbagba', 'Port-Bouët'],
        ['Jean-Folly', 'Port-Bouët'], ['Gonzagueville', 'Port-Bouët'],
        ['Petit Bassam', 'Port-Bouët'], ['Dioul-Abou', 'Port-Bouët'],
        ['Abouabou', 'Port-Bouët'], ['Zone Industrielle Vridi', 'Port-Bouët'],
        ['Houphouët-Boigny', 'Port-Bouët'],

        // ── TREICHVILLE ──────────────────────────────────────────────────
        ['Treichville', 'Treichville'], ['Treichville Centre', 'Treichville'],
        ['Dar-Es-Salam', 'Treichville'], ['Belleville', 'Treichville'],
        ['Boucotte', 'Treichville'], ['Fort Médée', 'Treichville'],
        ['Kouamé Gnankpe', 'Treichville'], ['Madiano', 'Treichville'],
        ['Nouvelle Ville', 'Treichville'], ['Arras', 'Treichville'],
        ['Zone Industrielle Treichville', 'Treichville'],

        // ── YOPOUGON ──────────────────────────────────────────────────
        ['Yopougon', 'Yopougon'], ['Yopougon Centre', 'Yopougon'],
        ['Siporex', 'Yopougon'], ['Yopougon Siporex', 'Yopougon'],
        ['Wassakara', 'Yopougon'], ['Yopougon Wassakara', 'Yopougon'],
        ['Académie', 'Yopougon'], ['Yopougon Académie', 'Yopougon'],
        ['Kouté', 'Yopougon'], ['Yopougon Kouté', 'Yopougon'],
        ['Niangon Nord', 'Yopougon'], ['Niangon Sud', 'Yopougon'],
        ['Niangon Lokoa', 'Yopougon'], ['Lokoa', 'Yopougon'],
        ['Selmer', 'Yopougon'], ['Yopougon Selmer', 'Yopougon'],
        ['Maroc', 'Yopougon'], ['Yopougon Maroc', 'Yopougon'],
        ['Millionnaire', 'Yopougon'], ['Yopougon Millionnaire', 'Yopougon'],
        ['Andokoi', 'Yopougon'], ['Yopougon Andokoi', 'Yopougon'],
        ['Toits Rouges', 'Yopougon'], ['Yopougon Toit Rouge', 'Yopougon'],
        ['Doukouré', 'Yopougon'], ['Sebroko', 'Yopougon'],
        ['Attié', 'Yopougon'], ['Zoo', 'Yopougon'],
        ['Banco 1', 'Yopougon'], ['Banco 2', 'Yopougon'], ['Banco 3', 'Yopougon'],
        ['Carrefour Yopougon', 'Yopougon'], ['Yopougon Gare', 'Yopougon'],
        ['Jean Paul II', 'Yopougon'], ['Kount', 'Yopougon'],
        ['Faya', 'Yopougon'], ['Yopougon Faya', 'Yopougon'],
        ['Yopougon Gesco', 'Yopougon'], ['Yopougon Koweit', 'Yopougon'],
        ['Yopougon Hill', 'Yopougon'], ['Yopougon Sideci', 'Yopougon'],
        ['Yopougon Port-Bouët 2', 'Yopougon'], ['Doukouré 2', 'Yopougon'],
        ['Zinc', 'Yopougon'], ['Yopougon Fidèle', 'Yopougon'],
        ['Yopougon Williamsville', 'Yopougon'], ['Yopougon Mahou', 'Yopougon'],
        ['Yopougon Stélicité', 'Yopougon'], ['Yopougon Angré', 'Yopougon'],
        ['Yopougon Koumassi', 'Yopougon'],

        // ── ANYAMA ──────────────────────────────────────────────────────
        ['Anyama', 'Anyama'], ['Anyama Centre', 'Anyama'],
        ['Anyama Akporo', 'Anyama'], ['Anyama-Adjamé', 'Anyama'],
        ['Latta', 'Anyama'], ['Akannjé', 'Anyama'],

        // ── SONGON ──────────────────────────────────────────────────────
        ['Songon Agban', 'Songon'], ['Songon Kassemblé', 'Songon'],
        ['Songon Dagbé', 'Songon'], ['Songon Centre', 'Songon'],
        ['Ahouanou', 'Songon'],

        // ── BINGERVILLE ──────────────────────────────────────────────────
        ['Bingerville', 'Bingerville'], ['Bingerville Centre', 'Bingerville'],
        ['Broukro', 'Bingerville'], ['M\'Badon Bingerville', 'Bingerville'],
        ['Abatta', 'Bingerville'], ['N\'Gokro', 'Bingerville'],
        ['Amissa', 'Bingerville'],

        // ── GRAND-BASSAM ──────────────────────────────────────────────────
        ['Grand-Bassam', 'Grand-Bassam'], ['Impérial', 'Grand-Bassam'],
        ['Moossou', 'Grand-Bassam'], ['Quartier France', 'Grand-Bassam'],

        // ── AUTRES VILLES CI ──────────────────────────────────────────────────
        ['Yamoussoukro Centre', 'Yamoussoukro'],
        ['Bouaké Centre', 'Bouaké'], ['Belleville Bouaké', 'Bouaké'],
        ['San-Pédro', 'San-Pédro'], ['Daloa', 'Daloa'],
        ['Korhogo', 'Korhogo'], ['Man', 'Man'],
        ['Gagnoa', 'Gagnoa'], ['Abengourou', 'Abengourou'],
        ['Divo', 'Divo'], ['Sassandra', 'Sassandra'],
        ['Bondoukou', 'Bondoukou'], ['Agboville', 'Agboville'],
        ['Adzopé', 'Adzopé'], ['Dabou', 'Dabou'],
        ['Tiassalé', 'Tiassalé'], ['Dimbokro', 'Dimbokro'],
    ];

    public function run(): void
    {
        $created = 0;

        foreach (self::$quartiers as [$nom, $commune]) {
            $norm    = Str::lower(Str::ascii($nom));
            $normCom = Str::lower(Str::ascii($commune));

            $exists = Quartier::where('nom_norm', $norm)
                ->where('commune_norm', $normCom)
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

        $this->command?->info("Quartiers d'Abidjan : {$created} nouveaux quartiers ajoutés. Total : " . Quartier::count());
    }
}
