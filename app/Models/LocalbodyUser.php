<?php

namespace App\Models;

use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LocalbodyUser extends Authenticatable
{
    use Notifiable;

    protected $guard = 'localbody';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'program_id',
        'name',
        'contact_person',
        'phone',
        'nodal',
        'agency_type',
        'superior_agency',
        'address',
        'state_id',
        'district_id',
        'pincode',
        'website',
        'email',
        'localbody_id',
        'logo',
        'username',
        'password',
        'date_of_reg',
        'short_info',
        'sub_district_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getAll($state = null)
    {
        $query = self::join('states', 'states.code', 'localbody_users.state_id')
                    ->select('localbody_users.*', 'states.name as state');

        if($state !== null){
            $query->where('localbody_users.state_id', $state);
        }

        $query->orderby('localbody_users.updated_at', 'DESC');
        return $query->get();
    }

    public static function getById($state = null, $localbodyId)
    {
        $query = self::join('states', 'states.code', 'localbody_users.state_id')
                    ->select('localbody_users.*', 'states.name as state')
                    ->where('id', $localbodyId);

        if($state !== null){
            $query->where('localbody_users.state_id', $state);
        }

        return $query->first();
    }

    public function sendPasswordResetNotification($token){
        Mail::send('emails.resetPassword', [
            'name'      => $this->name,
            'reset_url'     => route('password.reset', ['token' => $token, 'email' => $this->email, 'type' => 'LOCALBODY']),
        ], function($message){
            $message->subject('Reset Password Request');
            $message->to($this->email);
        });
    }
}
