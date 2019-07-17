<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgencyProduct extends Model
{
    protected $table = 'agency_products';
    protected $fillable = ['id', 'agency_id', 'product_id', 'quantity', 'discount_rate'];

    
}
