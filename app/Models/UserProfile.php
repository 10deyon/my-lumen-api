<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $hidden = ["updated_at", "created_at"];
    
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'gender',
        'bank_id',
        'account_num',
        'state_id',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
