<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataProvider extends Model
{
    protected $visible = ["name", "id"];

	protected $fillable = ["name", "min_vend", "max_vend"];

    // public function transaction() {
	// 	return $this->hasMany(DataTransaction::class, 'provider_id', 'id');
    // }

	public function dataBundles() {
		return $this->hasMany(DataBundle::class, 'provider_id', 'id');
    }
}
