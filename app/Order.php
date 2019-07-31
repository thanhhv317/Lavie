<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
	
    protected $table = 'orders';
    protected $fillable = [
    	'id', 
    	'seller_id', 
    	'buyer_id', 
    	'status', 
    	'price', 
    	'cost', 
    	'total_price', 
    	'quantity', 
    	'pay',
    ];

    public function createOrder($data)
    {
    	$this->seller_id = $data['seller_id'];
    	$this->buyer_id = $data['buyer_id'];
    	$this->status = $data['status'];
    	$this->price = $data['price'];
    	$this->cost = $data['cost'];
    	$this->total_price = $data['total_price'];
    	$this->quantity = $data['quantity'];
    	$this->pay = $data['pay'];
    	$this->save();
        return $this->id;
    }

    public function getAllOrderBySellerId($seller_id)
    {
        $buyer = $this->join('users', 'users.id','orders.buyer_id')
            ->select('orders.*', 'users.name', 'users.email', 'users.phone')
            ->where('seller_id', $seller_id)
            ->get()->toArray();
        return $buyer;
    }

    public function setStatusById($id, $status)
    {
        $this->where('id', $id)->update(['status' => $status]);
    }
}
