<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    use SoftDeletes;

    protected $table = 'transaction_details';
    protected $fillable = [
        'product_id',
        'price',
        'shipping_status',
        'resi',
        'code',
        'transactions_id'
    ];

    protected $hidden = [];

    public function product() {
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function transaction() {
        return $this->hasOne(Transaction::class,'id','transactions_id');
    }
}
