<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RlmmForwardDetail extends Model
{
    protected $table = 'rlmm_forward_details';

    protected $fillable = [
        'application_id', 'user_type', 'action', 'created_at', 'updated_at'
    ];
}

