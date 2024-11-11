<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $fillable = [
        'user_id',
        'basic_salary',
        'allowances',
        'pension',
        'insurance',
        'period'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
