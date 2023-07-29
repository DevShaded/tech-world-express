<?php

namespace App\Models\User;

use App\Enums\User\UserOrderStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserOrder extends Model
{
    use HasFactory;

    protected $table = 'user_orders';

    protected $fillable = [
        'user_id',
        'order_id',
        'order_date',
        'order_total',
        'order_status',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'status' => UserOrderStatusEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
