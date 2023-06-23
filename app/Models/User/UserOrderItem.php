<?php

namespace App\Models\User;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;

class UserOrderItem extends Model
{
    protected $table = 'user_order_items';

    protected $fillable = [
        'user_order_id',
        'product_id',
        'product_sku',
        'product_name',
        'product_price',
        'quantity',
    ];

    public function userOrder(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserOrder::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
