<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $hidden = ['state_code', 'region_id'];
    protected $fillable = [
        "state_name",
        "state_code",
        "region_id",
    ];

    public function address()
    {
        return $this->hasOne(BeneficiaryAddress::class, "state_id");
    }

    public function lgas()
    {
        return $this->hasMany(LocalGovt::class);
    }
}
