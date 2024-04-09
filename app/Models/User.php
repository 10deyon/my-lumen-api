<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable; //, HasRoles;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'type',
        'email',
        'phone_number',
        "password",
        "verification_token",
        "verified_at",
        "verification_otp",
        "verified_at",
        "forget_password_token",
        "timestamp"
    ];

    protected $hidden = ["verification_token", "verification_otp", 'password', 'created_at', 'updated_at'];

    public function business()
    {
        return $this->hasOne(Business::class);
    }

    public function businessAccount()
    {
        return $this->hasOneThrough(BusinessAccount::class, Business::class);
    }

    public function airtime()
    {
        return $this->hasMany(AirtimeTransaction::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function transactionGroup()
    {
        return $this->hasOne(TransactionGroup::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->last_name) . ' ' . ucfirst($this->first_name) . ' ' . ucfirst($this->middle_name);
    }
}
