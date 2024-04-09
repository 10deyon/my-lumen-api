<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempAccountVerification extends Model
{
    protected $table = "temp_account_verification";
    protected $hidden = ['id', 'created_at', 'updated_at', 'api_request', 'api_response'];
    protected $fillable = [
        "reference",
        "bank_id",
        "account_name",
        "account_number",
        "request_time",
        "response_time",
        'api_request',
		'api_response'
    ];
    
    public function getApiRequestAttribute(){
        return json_decode($this->attributes['api_request']);
    }
    
    public function getApiResponseAttribute(){
        return json_decode($this->attributes['api_response']);
    }
}

