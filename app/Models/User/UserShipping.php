<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShipping extends Model
{
    use HasFactory;

    protected $table = 'user_shipping';

    protected $fillable = [
        'user_id',
        'shipping_address',
        'shipping_city',
        'shipping_state_province',
        'shipping_country',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
