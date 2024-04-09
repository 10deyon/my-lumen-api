<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        "user_id",
        "commission_rate",
        "frequency",
        "business_name",
        "cac_number",
        "reg_date",
        "reg_number",
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function account() {
        return $this->hasOne(BusinessAccount::class)->where('active', true);
    }

    public function accounts() {
        return $this->hasMany(BusinessAccount::class);
    }

    public function bvn() {
        return $this->hasOne(BusinessBvn::class);
    }

    public function address() {
        return $this->hasOne(BusinessAddress::class);
    }

    public function collection() {
        return $this->hasMany(Collection::class);
    }

    public function settlements() {
        return $this->hasMany(SettlementHistory::class);
    }

    public function link() {
        return $this->hasMany(SettlementHistory::class);
    }
}
