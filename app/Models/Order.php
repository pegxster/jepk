<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $table = 'orders';

    const STATUS_PENDING          = 'pending';
    const STATUS_CONTACTED        = 'contacted';
    const STATUS_DEPOSIT_RECEIVED = 'deposit_received';
    const STATUS_PROCESSING       = 'processing';
    const STATUS_READY            = 'ready';
    const STATUS_DELIVERED        = 'delivered';
    const STATUS_CANCELLED        = 'cancelled';

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
        'adresse',
        'quartier',
        'commune',
        'ville',
        'pays',
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

    public function getFormattedShippingAddressAttribute(): array
    {
        $addr = $this->shipping_address;
        if (is_string($addr)) {
            $decoded = json_decode($addr, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $addr = $decoded;
            } else {
                return [
                    'name'     => $this->customer_name ?? '—',
                    'phone'    => $this->customer_phone ?? '—',
                    'adresse'  => $addr,
                    'address'  => $addr,
                    'quartier' => $this->quartier ?? null,
                    'commune'  => $this->commune ?? null,
                    'ville'    => $this->ville ?? 'Abidjan',
                    'city'     => $this->ville ?? 'Abidjan',
                    'pays'     => $this->pays ?? 'Côte d\'Ivoire',
                    'country'  => $this->pays ?? 'Côte d\'Ivoire',
                    'note'     => $this->notes ?? null,
                ];
            }
        }

        $arr = is_array($addr) ? $addr : (is_object($addr) ? (array) $addr : []);

        $adresse  = $arr['adresse'] ?? $arr['address'] ?? $this->adresse ?? null;
        $quartier = $arr['quartier'] ?? $this->quartier ?? null;
        $commune  = $arr['commune'] ?? $this->commune ?? null;
        $ville    = $arr['ville'] ?? $arr['city'] ?? $this->ville ?? 'Abidjan';
        $pays     = $arr['pays'] ?? $arr['country'] ?? $this->pays ?? 'Côte d\'Ivoire';
        $note     = $arr['note'] ?? $this->notes ?? null;
        $name     = $arr['name'] ?? $this->customer_name ?? '—';
        $phone    = $arr['phone'] ?? $this->customer_phone ?? '—';

        return [
            'name'     => $name,
            'phone'    => $phone,
            'adresse'  => $adresse,
            'address'  => $adresse,
            'quartier' => $quartier,
            'commune'  => $commune,
            'ville'    => $ville,
            'city'     => $ville,
            'pays'     => $pays,
            'country'  => $pays,
            'note'     => $note,
        ];
    }

    public function getDeliverySummaryAttribute(): string
    {
        $f = $this->formatted_shipping_address;
        $parts = array_filter([
            $f['adresse'] ?? null,
            $f['quartier'] ?? null,
            !empty($f['commune']) && $f['commune'] !== ($f['quartier'] ?? '') ? '('.$f['commune'].')' : null,
            $f['ville'] ?? null,
        ]);

        return !empty($parts) ? implode(' · ', $parts) : 'Lieu non spécifié';
    }

    public static function statusLabel(string $status): string
    {
        return match($status) {
            self::STATUS_PENDING          => 'Nouvelle commande',
            self::STATUS_CONTACTED        => 'Client contacté',
            self::STATUS_DEPOSIT_RECEIVED => 'Acompte reçu',
            self::STATUS_PROCESSING       => 'En fabrication',
            self::STATUS_READY            => 'Pièce prête',
            self::STATUS_DELIVERED        => 'Livrée',
            self::STATUS_CANCELLED        => 'Annulée',
            default => $status,
        };
    }

    public static function statusColor(string $status): string
    {
        return match($status) {
            self::STATUS_PENDING          => '#E8896A',
            self::STATUS_CONTACTED        => '#9B8EC4',
            self::STATUS_DEPOSIT_RECEIVED => '#4A90D9',
            self::STATUS_PROCESSING       => '#F39C12',
            self::STATUS_READY            => '#16A085',
            self::STATUS_DELIVERED        => '#27AE60',
            self::STATUS_CANCELLED        => '#E74C3C',
            default => '#999',
        };
    }

    /* Prochain statut logique dans le workflow JEPK */
    public static function nextStatus(string $status): ?string
    {
        return match($status) {
            self::STATUS_PENDING          => self::STATUS_CONTACTED,
            self::STATUS_CONTACTED        => self::STATUS_DEPOSIT_RECEIVED,
            self::STATUS_DEPOSIT_RECEIVED => self::STATUS_PROCESSING,
            self::STATUS_PROCESSING       => self::STATUS_READY,
            self::STATUS_READY            => self::STATUS_DELIVERED,
            default => null,
        };
    }

    public function depositAmount(): float
    {
        return round(($this->total ?? 0) * 0.5);
    }
}
