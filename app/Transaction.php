<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', 
        'insurance_price', 
        'shipping_price', 
        'total_price', 
        'transaction_status',
        'code'
    ];

    protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
