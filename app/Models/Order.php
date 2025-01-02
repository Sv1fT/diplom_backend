<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'from_city_id',
        'to_city_id',
        'datetime_from',
        'datetime_to',
        'weight',
        'price',
        'order_number',
        'user_id',
        'active',
    ];

    protected $casts = [
        'datetime_from' => 'datetime',
        'datetime_to' => 'datetime',
    ];

    public function city_from(): BelongsTo
    {
        return $this->belongsTo(City::class, 'from_city_id');
    }
    public function city_to(): BelongsTo
    {
        return $this->belongsTo(City::class, 'to_city_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
