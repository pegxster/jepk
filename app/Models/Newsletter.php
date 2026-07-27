<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Newsletter extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'newsletters';

    protected $fillable = ['email', 'is_active', 'subscribed_at'];
    protected $casts = [
        'is_active'     => 'boolean',
        'subscribed_at' => 'datetime',
    ];
}
