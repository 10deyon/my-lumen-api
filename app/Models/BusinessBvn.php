<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessBvn extends Model 
{
    protected $hidden = ['created_at', 'updated_at'];
    
    protected $fillable = [
        "business_id",
        "bvn_number"
    ];

    public function business() {
        return $this->belongsTo(Business::class);
    }
}
