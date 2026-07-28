<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Str;

class Quartier extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'quartiers';

    protected $fillable = [
        'nom',
        'commune',
        'nom_norm',
        'commune_norm',
        'is_custom',
    ];

    protected $casts = [
        'is_custom' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($quartier) {
            $quartier->nom_norm = Str::lower(Str::ascii($quartier->nom ?? ''));
            $quartier->commune_norm = Str::lower(Str::ascii($quartier->commune ?? ''));
        });
    }

    /**
     * Recherche des quartiers par nom ou commune (insensible à la casse/accents).
     */
    public static function search(string $term, int $limit = 15)
    {
        $term = trim($term);

        // Champ vide (au focus) : on affiche la liste complète, triée par
        // commune, pour permettre de parcourir tous les quartiers d'Abidjan.
        if ($term === '') {
            return static::orderBy('commune')->orderBy('nom')->get(['nom', 'commune']);
        }

        $norm = Str::lower(Str::ascii($term));

        return static::where('nom_norm', 'like', '%' . $norm . '%')
            ->orWhere('commune_norm', 'like', '%' . $norm . '%')
            ->orderBy('nom')
            ->limit($limit)
            ->get(['nom', 'commune']);
    }

    /**
     * Mots à ne jamais accepter comme nouveau quartier (test, injures...).
     * Liste volontairement courte : simple garde-fou, pas une modération complète.
     */
    private static array $motsInterdits = [
        'merde', 'con', 'connard', 'connasse', 'putain', 'pute', 'salope',
        'test', 'aaa', 'xxx', 'asdf', 'fuck', 'shit', 'bitch',
    ];

    /**
     * Un nom de quartier plausible : lettres (accentuées), chiffres, espaces,
     * apostrophes et tirets, longueur raisonnable, au moins une lettre, et
     * absent de la liste des mots interdits.
     */
    private static function estUnNomPlausible(string $nom): bool
    {
        $len = mb_strlen($nom);
        if ($len < 2 || $len > 80) {
            return false;
        }

        if (!preg_match("/^[\p{L}0-9 '\-]+$/u", $nom)) {
            return false;
        }

        if (!preg_match('/\p{L}/u', $nom)) {
            return false;
        }

        $norm = Str::lower(Str::ascii($nom));
        foreach (self::$motsInterdits as $mot) {
            if ($norm === $mot || str_contains($norm, $mot)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Retrouve un quartier existant à partir d'une saisie libre ("Nom, Commune"),
     * ou l'ajoute automatiquement à la liste s'il est inconnu et plausible.
     * Une saisie invalide (test, injure...) n'est jamais ajoutée à la liste
     * partagée, mais ne bloque pas la commande en cours (retourne null).
     */
    public static function findOrCreateFromInput(?string $raw): ?self
    {
        $raw = trim((string) $raw);
        if ($raw === '') {
            return null;
        }

        [$nom, $commune] = array_pad(array_map('trim', explode(',', $raw, 2)), 2, null);
        if ($nom === '' || $nom === null) {
            return null;
        }

        $norm = Str::lower(Str::ascii($nom));
        $existing = static::where('nom_norm', $norm)->first();
        if ($existing) {
            return $existing;
        }

        if (!self::estUnNomPlausible($nom) || ($commune && !self::estUnNomPlausible($commune))) {
            return null;
        }

        return static::create([
            'nom'       => $nom,
            'commune'   => $commune ?: 'Abidjan',
            'is_custom' => true,
        ]);
    }
}
