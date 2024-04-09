<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirtimeProvider extends Model
{
    protected $table = "data_providers";
    protected $visible = ["id", "name"];
}
