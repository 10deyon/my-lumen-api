<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $hidden = ["created_at", "updated_at"];
    
    protected $fillable = [
        'user_id',
        'transaction_id',
        'transaction_reference',
        'collection_method',
        'link_id',
        'ussd_code',
        'bank_name',
        'account_number',
        'account_name',
        'payment_method',
        'payment_reference',
        'amount',
        'payout_amount',
        'description',
        'verified_at',
        'settled',
        'settlement_id',
        'date',
        'link_reference',
        'phone_number',
        'email',
    ];
    
    public function link() {
        return $this->belongsTo(User::class, "link_id");
    }

    protected $appends = array('link');

    public function getLinkAttribute() {
        return env("FRONT_END_URL")."/payment_link?reference={$this->link_reference}";
    }
    
    public function settlement() {
        return $this->belongsTo(SettlementHistory::class, "settlement_id", "id");
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
