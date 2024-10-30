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
        'active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function activate()
    {
        $this->update(['active' => true]);
    }

    public function inactivate()
    {
        $this->update(['active' => false]);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }
}
