<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillMaterial extends Model
{
    //
    protected $table="master_bill_material";
    static function getBillMaterialTitle($bill_id){
        return self::select('bill_title')->where('id',$bill_id)->first();
    }
    
}
