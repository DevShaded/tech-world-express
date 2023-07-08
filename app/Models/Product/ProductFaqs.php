<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFaqs extends Model
{
    use HasFactory;

    protected $table = 'product_faqs';
    protected $fillable = [
        'product_id',
        'question',
        'answer',
    ];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
