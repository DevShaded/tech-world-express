<?php

namespace App\Models\User;

use App\Enums\User\UserOrderStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserOrder extends Model
{
    use HasFactory;

    protected $table = 'user_orders';

    protected $fillable = [
        'user_id',
        'order_date',
        'total_amount',
        'status',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'status' => UserOrderStatusEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userOrderItems(): HasMany
    {
        return $this->hasMany(UserOrderItem::class);
    }
}
