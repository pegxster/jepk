<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $table = 'orders';

    const STATUS_PENDING    = 'pending';
    const STATUS_CONFIRMED  = 'confirmed';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED    = 'shipped';
    const STATUS_DELIVERED  = 'delivered';
    const STATUS_CANCELLED  = 'cancelled';

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'items',
        'subtotal',
        'shipping_cost',
        'discount',
        'total',
        'status',
        'payment_method',
        'payment_status',
        'shipping_address',
        'notes',
        'shipped_at',
        'delivered_at',
    ];

    protected $casts = [
        'items'            => 'array',
        'shipping_address' => 'array',
        'subtotal'         => 'float',
        'shipping_cost'    => 'float',
        'discount'         => 'float',
        'total'            => 'float',
        'shipped_at'       => 'datetime',
        'delivered_at'     => 'datetime',
    ];

    public static function statusLabel(string $status): string
    {
        return match($status) {
            self::STATUS_PENDING    => 'En attente',
            self::STATUS_CONFIRMED  => 'Confirmée',
            self::STATUS_PROCESSING => 'En traitement',
            self::STATUS_SHIPPED    => 'Expédiée',
            self::STATUS_DELIVERED  => 'Livrée',
            self::STATUS_CANCELLED  => 'Annulée',
            default => $status,
        };
    }

    public static function statusColor(string $status): string
    {
        return match($status) {
            self::STATUS_PENDING    => '#E8896A',
            self::STATUS_CONFIRMED  => '#9B8EC4',
            self::STATUS_PROCESSING => '#4A90D9',
            self::STATUS_SHIPPED    => '#27AE60',
            self::STATUS_DELIVERED  => '#2ECC71',
            self::STATUS_CANCELLED  => '#E74C3C',
            default => '#999',
        };
    }
}
