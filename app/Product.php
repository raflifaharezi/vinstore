<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'user_id', 'categories_id','price' ,
                            'description', 'slug'];

    protected $hidden =[];

    //relasi dari satu model ke lebih banyak model
    public function gallery()
    {
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }

    //relasi dari banyak model ke lebih banyak modesatu model
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    //relasi dari satu model ke satu model
    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }
}
