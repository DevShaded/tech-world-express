<?php

namespace App\Models\User\Country;

use App\Models\User\UserInformation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function userInformation(): HasMany
    {
        return $this->hasMany(UserInformation::class);
    }
}
