<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{

    use SoftDeletes;
    
    protected $table = 'product_galleries';
    protected $fillable = ['photo', 'product_id'];

    protected $hidden = [];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}