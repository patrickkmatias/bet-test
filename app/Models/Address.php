<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;

    protected $fillable = ['affiliate_id', 'city', 'state', 'street'];

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }
}