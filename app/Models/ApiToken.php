<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    public $timestamps = false;
	protected $fillable = ['user_id','user_type','token','expiry'];
}
