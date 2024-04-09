<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirtimeTransactionGroup extends Model
{
    protected $table = 'transaction_groups';

    protected $visible = [
        "id", "total_amount", "item_number", "payment_ref", "payment_method", "customer_phone", 'transactions', 'vendor',
    ];

    protected $fillable = [
        'ip',
        "total_amount",
        "payment_ref",
        "user_id",
        "item_number",
        "payment_method",
        "service_name",
        'customer_phone',
        "client_request",
        "client_response",
        'client_vend_request',
        'client_vend_response',
        "created_at",
        "updated_at"
    ];

    public function transactions()
    {
        return $this->hasMany(AirtimeTransaction::class, 'group_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class);
    }
}
