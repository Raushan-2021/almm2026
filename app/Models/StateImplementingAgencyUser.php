<?php

namespace App\Models;

use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StateImplementingAgencyUser extends Authenticatable
{
    use Notifiable;

    protected $guard = 'state-implementing-agency';

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
        'address',
        'state_id',
        'district_id',
        'pincode',
        'website',
        'email',
        'short_info',
        'logo',
        'state_implementing_agency_id',
        'password',
        'date_of_reg'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function GetAll($state = null)
    {
        $query = self::join('states', 'states.code', 'state_implementing_agency_users.state_id')
                    ->select('state_implementing_agency_users.*', 'states.name as state');
                    
        if($state !== null){
            $query->where('state_implementing_agency_users.state_id', $state);
        }

        $query->orderBy('state_implementing_agency_users.updated_at', 'DESC');

        return $query->get();
    }

    public static function getById($state = null, $stateImplementingAgencyId)
    {
        $query = self::join('states', 'states.code', 'state_implementing_agency_users.state_id')
                    ->select('state_implementing_agency_users.*', 'states.name as state')
                    ->where('id', $stateImplementingAgencyId);

        if($state !== null){
            $query->where('state_implementing_agency_users.state_id', $state);
        }

        return $query->first();
    }


    public function sendPasswordResetNotification($token){
        Mail::send('emails.resetPassword', [
            'name'      => $this->name,
            'reset_url'     => route('password.reset', ['token' => $token, 'email' => $this->email, 'type' => 'STATEIMPLEMENTINGAGENCY']),
        ], function($message){
            $message->subject('Reset Password Request');
            $message->to($this->email);
        });
    }
}
