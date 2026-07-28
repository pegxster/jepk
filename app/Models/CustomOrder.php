<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

/**
 * Demande de création "Sur Mesure" soumise depuis le formulaire de la
 * page d'accueil. Avant, ces demandes n'étaient jamais enregistrées :
 * le client recevait un message de confirmation mais personne ne les
 * voyait jamais côté admin.
 */
class CustomOrder extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'custom_orders';

    const STATUS_NOUVEAU  = 'nouveau';
    const STATUS_CONTACTE = 'contacte';
    const STATUS_TERMINE  = 'termine';
    const STATUS_ANNULE   = 'annule';

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_phone',
        'type_creation',
        'taille',
        'coloris',
        'description',
        'budget',
        'delai',
        'photo',
        'status',
    ];

    public static function statusLabel(string $status): string
    {
        return match ($status) {
            self::STATUS_NOUVEAU  => 'Nouvelle',
            self::STATUS_CONTACTE => 'Contactée',
            self::STATUS_TERMINE  => 'Terminée',
            self::STATUS_ANNULE   => 'Annulée',
            default => $status,
        };
    }

    public static function statusColor(string $status): string
    {
        return match ($status) {
            self::STATUS_NOUVEAU  => '#E8896A',
            self::STATUS_CONTACTE => '#4A90D9',
            self::STATUS_TERMINE  => '#2ECC71',
            self::STATUS_ANNULE   => '#E74C3C',
            default => '#999',
        };
    }
}
