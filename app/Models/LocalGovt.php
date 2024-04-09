<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalGovt extends Model
{
    protected $hidden = ['lga_code'];

    protected $fillable = [
        "lga",
        "lga_code",
        "state_id",
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
