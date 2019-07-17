<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['id', 'name', 'base_price'];

    public function productImage()
    {
    	return $this->hasMany('App\ProductImage');
    }

    public function agency()
    {
    	return $this->belongsToMany('App\Agency');
    }

    public function category()
    {
    	return $this->belongsToMany('App\Category');
    }
}
