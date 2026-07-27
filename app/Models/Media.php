<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

/**
 * Images uploadées depuis l'admin (catégories, produits, slides, médiathèque),
 * stockées directement dans MongoDB pour survivre aux redéploiements Render
 * (le plan gratuit ne fournit pas de disque persistant).
 */
class Media extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'media';

    protected $fillable = [
        'filename',
        'mime_type',
        'size',
        'data',
    ];

    protected $casts = [
        'size' => 'integer',
    ];
}
