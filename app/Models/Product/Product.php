<?php

namespace App\Models\Product;

use App\Models\User\UserOrderItem;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'sku',
        'name',
        'slug',
    ];

    public function userOrderItem(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserOrderItem::class);
    }
}
