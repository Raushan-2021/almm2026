<?php

namespace App\Models;

use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class Inspector extends Authenticatable
{
    use Notifiable;

    protected $guard = 'inspector';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'state_id',
        'phone',
        'email',
        'dob',
        'user_id',
        'password',
        'comment',
        'date_of_reg',
        'program_id',
        'biogas_training_attended',
        'picture',
        'inspector_id',
        'designation'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at','update_at'
    ];

    public static function getAll($state = null, $status = null)
    {
        $query = self::join('states', 'states.code', 'inspectors.state_id')
                        ->leftjoin('sia_inspectors_association', 'sia_inspectors_association.inspector_id', 'inspectors.id')
                        ->select('inspectors.*', 'states.name as state', 'sia_inspectors_association.inspector_id as associated');

        switch($status){
            case 'ASSO':
                $query->where('sia_inspectors_association.inspector_id', '!=', NULL);
            break;
            case 'PEND':
                $query->where('sia_inspectors_association.inspector_id', NULL);
            break;
        }

        if($state == 'All');
        elseif($state !== null){
            $query->where('inspectors.state_id', $state);
        }

        $query->orderby('inspectors.updated_at','DESC');
        
        return $query->get();
    }

    public static function getById($state = null, $inspectorId)
    {
        $query = self::join('states', 'states.code', 'inspectors.state_id')
                    ->leftjoin('sia_inspectors_association', 'sia_inspectors_association.inspector_id', 'inspectors.id')
                    ->select('inspectors.*', 'states.name as state', 'sia_inspectors_association.inspector_id as associated')
                    ->where('inspectors.id', $inspectorId);

        if($state !== null){
            $query->where('inspectors.state_id', $state);
        }

        return $query->first();
    }

    public static function getUserProfile($userId)
    {
        return self::where('id', $userId)->first();
    }

    public function sendPasswordResetNotification($token){
        Mail::send('emails.resetPassword', [
            'name'      => $this->name,
            'reset_url'     => route('password.reset', ['token' => $token, 'email' => $this->email, 'type' => 'INSPECTOR']),
        ], function($message){
            $message->subject('Reset Password Request');
            $message->to($this->email);
        });
    }
}
