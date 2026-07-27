<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Str;

class Quartier extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'quartiers';

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

        if ($term === '') {
            return static::orderBy('nom')->limit($limit)->get(['nom', 'commune']);
        }

        $norm = Str::lower(Str::ascii($term));

        return static::where('nom_norm', 'like', '%' . $norm . '%')
            ->orWhere('commune_norm', 'like', '%' . $norm . '%')
            ->orderBy('nom')
            ->limit($limit)
            ->get(['nom', 'commune']);
    }

    /**
     * Retrouve un quartier existant à partir d'une saisie libre ("Nom, Commune"),
     * ou l'ajoute automatiquement à la liste s'il est inconnu.
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

        return static::create([
            'nom'       => $nom,
            'commune'   => $commune ?: 'Abidjan',
            'is_custom' => true,
        ]);
    }
}
