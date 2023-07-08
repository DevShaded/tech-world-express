<?php

namespace App\Models\Product\Information;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInformationPicture extends Model
{
    use HasFactory;

    protected $table = 'product_information_pictures';
    protected $fillable = [
        'product_information_id',
        'image',
    ];

    public function productInformation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductInformation::class);
    }
}
