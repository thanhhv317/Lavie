<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $fillable = [
    	'name', 'email', 'password', 'provider', 'provider_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
