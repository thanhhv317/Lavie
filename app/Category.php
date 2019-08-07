<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table    = 'categories';
    protected $fillable = ['id', 'name'];

    public function product()
    {
    	return $this->belongsToMany('App\Product');
    }

    public function getAllData()
    {
    	return $this->all();
    }

    public function getDataById($arr_id)
    {
        return $this->whereIn('id', $arr_id)->get();
    }
    
}
