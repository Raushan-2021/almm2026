<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Notification extends Model
{
    protected $table = 'notification';
    //protected $table="application_details";
    protected $casts = [
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    static function getNotification(){
        
        $data = Notification::where('to_user',Auth::user()->id)->where('to_user_type',Auth::getDefaultDriver())->where('status',0)->limit(6)->orderby('updated_at','DESC')->get()->toArray();
        $count = Notification::where('to_user',Auth::user()->id)->where('to_user_type',Auth::getDefaultDriver())->where('status',0)->count();
        return response()->json(['count'=>$count,'data'=>$data]);
    }
 
}