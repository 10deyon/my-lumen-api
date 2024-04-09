<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'user_id', 'remarks'];
    protected $fillable = [
        "user_id",
        "wallet_id",
        'balance',
        'amount',
        'category',
        'remarks',
        'balance_snapshot',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
