<?php

namespace App\Models\Product\Information;

use App\Models\Category\Category;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductInformation extends Model
{
    use HasFactory;

    protected $table = 'product_informations';
    protected $fillable = [
        'product_id',
        'description',
        'price',
        'product_information_picture_id',
        'highlights',
        'stock',
        'category_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productInformationPicture(): HasOne
    {
        return $this->hasOne(ProductInformationPicture::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
