<?php

namespace App\Models;

use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class Installer extends Authenticatable
{
    use Notifiable;

    protected $guard = 'installer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'program_id',
        'installer_id',
        'name',
        'category',
        'address',
        'state_id',
        'district_id',
        'pincode',
        'bdtc_biogas_training_certificate_no',
        'bank_name',
        'branch_address',
        'account_no',
        'account_type',
        'ifsc_code',
        'branch_code',
        'micr_code',
        'contact_person',
        'phone',
        'short_info',
        'comment',
        'email',
        'aadhar_no',
        'bdtc_biogas_training_certificate',
        'picture',
        'website',
        'company_reg_no',
        'installation_experiance',
        'installed_plants',
        'password',
        'date_of_reg'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at','update_at'
    ];

    public static function getAll($state = NULL, $status = NULL)
    {
        $query = self::select('installers.*', 'states.name as state', 'sia_installers_association.status as associated')
                        ->join('states', 'states.code', 'installers.state_id');

        if(Auth::getDefaultDriver() == 'state-implementing-agency'){
            $query->leftjoin('sia_installers_association', function ($join) {
                            $join->on('sia_installers_association.installer_id', 'installers.id')
                                ->where('sia_installers_association.state_implementing_agency_user_id', Auth::id());
                        });
        }
        elseif(Auth::getDefaultDriver() == 'mnre' || Auth::getDefaultDriver() == 'localbody'){
            $query->leftjoin('sia_installers_association', 'sia_installers_association.installer_id', 'installers.id');
            switch($status){
                case 'ASSO':
                    $query->where('sia_installers_association.status', '!=', NULL);
                break;
                case 'PEND':
                    $query->where('sia_installers_association.status', NULL);
                break;
            }
        }

        if($state == 'All');
        elseif($state !== null){
            $query->where('installers.state_id', $state);
        }

        $query->orderBy('installers.updated_at', 'DESC');

        return $query->get();
    }

    public static function getById($state = null, $installerId)
    {
        $query = self::select('installers.*', 'states.name as state', 'sia_installers_association.status as associated')
                        ->join('states', 'states.code', 'installers.state_id')            
                        ->leftjoin('sia_installers_association', function ($join) {
                            $join->on('sia_installers_association.installer_id', 'installers.id')
                                ->where('sia_installers_association.state_implementing_agency_user_id', Auth::id());
                        })
                        ->where('installers.id', $installerId);

        if($state !== null){
            $query->where('installers.state_id', $state);
        }

        return $query->first();
    }

    public static function getUserProfile($userId)
    {
        $installer = self::where('id', $userId)->first();
        $imageUrl = 'public/images/installers/'.$installer->installer_id.'/picture/'.$installer->picture;
        $installer->picture = !empty($installer->picture) ? url('api/v1/get-public-image/'.base64_encode($imageUrl)) : NULL;
        return $installer;
    }

    public function sendPasswordResetNotification($token){
        Mail::send('emails.resetPassword', [
            'name'      => $this->name,
            'reset_url'     => route('password.reset', ['token' => $token, 'email' => $this->email, 'type' => 'INSTALLER']),
        ], function($message){
            $message->subject('Reset Password Request');
            $message->to($this->email);
        });
    }
}
