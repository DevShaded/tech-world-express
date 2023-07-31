<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserInformation extends Model
{
    use HasFactory;

    protected $table = 'user_information';

    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'address',
        'address2',
        'city',
        'country',
        'state_province',
        'zip_postal_code',
        'phone',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
