<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsumerBankDetails extends Model
{
    protected $table = 'consumer_bank_details';

    protected $fillable = [
        'consumer_id',
        'bank_name',
        'branch_address',
        'account_no',
        'account_type',
        'ifsc_code',
        'branch_code',
        'micr_code',
        'bank_passbook'
    ];
}
