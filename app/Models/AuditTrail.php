<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    protected $table = 'audit_trail';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'action_type', 'module_name','description','device','ip_address','user_type',
    ];
}