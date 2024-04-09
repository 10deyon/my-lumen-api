<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettlementHistory extends Model
{
    protected $table = "settlement_histories";
    
    protected $fillable = [
        "user_id",
        "transaction_reference",
        "amount",
        "status",
        "commission",
        "total_transactions",
        "account_number",
        "account_name",
        "bank_name",
        "sort_code"
    ];
    
    public function merchant() {
        return $this->belongsTo(Merchant::class)->with("profile");
    }
    
    public function account() {
        return $this->belongsTo(MerchantAccount::class)->with("bank");
    }
    
    public function collections() {
        return $this->hasMany(Collection::class, "settlement_id", "id");
    }
}
