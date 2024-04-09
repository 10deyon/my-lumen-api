<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataTransaction extends Model
{
	protected $hidden = ['user_id', 'api_vend_request', 'api_vend_response', 'created_at', 'updated_at'];

	protected $fillable = [
		'ip',
		'transaction_id',
		'amount',
		'phone_number',
		'bundle_id',
		'status',
		'request_time',
		'response_time',
		'api_vend_request',
		'api_vend_response'
	];

	public function getClientRequestAttribute()
	{
		return json_decode($this->attributes['client_request']);
	}
	public function getClientResponseAttribute()
	{
		return json_decode($this->attributes['client_response']);
	}

	public function getApiVendRequestAttribute()
	{
		return json_decode($this->attributes['api_vend_request']);
	}
	public function getApiVendResponseAttribute()
	{
		return json_decode($this->attributes['api_vend_response']);
	}
	public function getClientVendRequestAttribute()
	{
		return json_decode($this->attributes['client_vend_request']);
	}
	public function getClientVendResponseAttribute()
	{
		return json_decode($this->attributes['client_vend_response']);
	}

	public function dataBundle()
	{
		return $this->belongsTo(DataBundle::class, 'bundle_id', 'id');
	}

	public function dataGroup()
	{
		return $this->belongsTo(TransactionGroup::class, 'group_id', 'id');
	}
}
