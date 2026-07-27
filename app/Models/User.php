<?php

namespace App\Models;

use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = 'mongodb';
    protected $table = 'users';

    protected $fillable = [
        'name',
        'prenom',
        'nom',
        'email',
        'password',
        'telephone',
        'birthday',
        'avatar',
        'is_admin',
        'newsletter',
        'loyalty_points',
        'addresses',
        'wishlist',
        'reset_token',
        'reset_token_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_admin'          => 'boolean',
        'newsletter'        => 'boolean',
        'loyalty_points'    => 'integer',
        'addresses'         => 'array',
        'wishlist'          => 'array',
    ];

    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }

    public function getFullNameAttribute(): string
    {
        if ($this->prenom || $this->nom) {
            return trim($this->prenom . ' ' . $this->nom);
        }
        return $this->name ?? '';
    }

    public function getPrenomDisplayAttribute(): string
    {
        return $this->prenom ?? explode(' ', $this->name ?? 'Client')[0];
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return product_image_url($this->avatar);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name) . '&background=D4547A&color=fff&size=140';
    }
}
