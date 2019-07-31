<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;

    protected $table = "order_details";
    protected $fillable = ['id', 'order_id', 'product_id', 'price', 'quantity'];

    public function createOrderDetail($data)
    {
    	$this->order_id 	= $data['order_id'];
    	$this->product_id 	= $data['product_id'];
    	$this->price 		= $data['price'];
    	$this->quantity 	= $data['quantity'];
    	$this->save();
    }

    public function getDataByOrderId($order_id)
    {
        return $this->join('products', 'order_details.product_id', 'products.id')
        ->join('product_images', 'product_images.product_id', 'order_details.product_id')
        ->where([['order_id', $order_id], ['product_images.status', 1]])->get()->toArray();
    }


}
