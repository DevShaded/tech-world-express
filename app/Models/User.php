<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\User\UserBilling;
use App\Models\User\UserInformation;
use App\Models\User\UserOrder;
use App\Models\User\UserOrderItem;
use App\Models\User\UserShipping;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userInformation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserInformation::class);
    }

    public function userBilling(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserBilling::class);
    }

    public function userShipping(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserShipping::class);
    }

    public function userOrders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserOrder::class);
    }

    public function userOrderItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserOrderItem::class);
    }
}
