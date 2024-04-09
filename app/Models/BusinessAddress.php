<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessAddress extends Model 
{
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        "address",
        "state_id",
        "local_govt_id",
        "business_id",
        "state",
        "local_govt",
    ];
    
    public function business() {
        return $this->belongsTo(Business::class);
    }
}
