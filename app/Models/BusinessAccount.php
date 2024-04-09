<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessAccount extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        "business_id",
        "account_name",
        "account_number",
        "bank_id",
        "bank_name",
        "sort_code"
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class, "business_id");
    }
}
