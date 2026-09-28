<?php

namespace App\Models;

use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RlmmMomAppvdMnre extends Authenticatable
{
    use Notifiable;

    protected $guard = 'MNREWIND';
    protected $table = 'mom_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'approval_message', 'approval_file', 'approved_at', 'niwe_msg', 'niwe_file'
    ];

   
    

}
