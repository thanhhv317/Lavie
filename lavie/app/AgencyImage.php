<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgencyImage extends Model
{
    protected $table = 'agency_images';
    protected $fillable = ['id', 'agency_id', 'image'];

    public function agency()
    {
    	return $this->belongsTo('App\Agency');
    }
}
