<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    /** @use HasFactory<\Database\Factories\AffiliateFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'birthdate',
        'cpf',
        'phone_number',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
