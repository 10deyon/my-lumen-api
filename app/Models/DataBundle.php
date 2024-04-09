<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataBundle extends Model
{
    protected $hidden = ['created_at', 'updated_at', "provider_id",];

	protected $fillable = ["name", "price", "provider_id", "created_at", "updated_at"];

	public function transaction() {
		return $this->hasMany(DataTransaction::class, 'bundle_id', 'id');
	}

	public function provider() {
		return $this->belongsTo(DataProvider::class);
	}
}
