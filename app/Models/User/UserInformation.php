<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $table = 'user_information';
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
        'state_province',
        'country',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
