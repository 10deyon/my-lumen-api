<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $hidden = ['code', 'active', 'created_at', 'updated_at'];
}
