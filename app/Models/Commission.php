<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    /** @use HasFactory<\Database\Factories\CommissionFactory> */
    use HasFactory;

    protected $fillable = ['affiliate_id', 'value'];

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }
}
