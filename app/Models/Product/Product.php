<?php

namespace App\Models\Product;

use App\Models\Product\Information\ProductInformation;
use App\Models\User\UserOrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'slug',
        'information_id',
        'specification_id',
    ];

    public function userOrderItem(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserOrderItem::class);
    }

    public function information(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductInformation::class);
    }

    public function specification(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductSpecification::class);
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(ProductFaqs::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReviews::class);
    }
}
