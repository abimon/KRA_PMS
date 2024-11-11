<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mpesa extends Model
{
    protected $fillable =[
        "TransactionType",
        "Account_id",
        "TransAmount",
        "MpesaReceiptNumber",
        "TransactionDate",
        "PhoneNumber",
        "response",
    ];
    public function accoun(){
        return $this->belongsTo(Pay::class,"account_id");
    }
}
