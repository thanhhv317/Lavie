<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'agencies';
    protected $fillable = ['id', 'user_id', 'name', 'address'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function agencyImage()
    {
    	return $this->hasMany('App\agencyImage');
    }

    public function product()
    {
    	return $this->belongsToMay('App\Product');
    }
}
