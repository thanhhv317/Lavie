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
        ->where([['order_id', $order_id], ['product_images.status', 1]])
        ->select('*', 'order_details.id as o_id')
        ->get()->toArray();
    }

    public function updateQuantityById($data)
    {
        $current_quantity = $this->select('quantity', 'price', 'order_id')->where('id', $data->order_id)->first()->toArray();
        $this->where('id', $data->order_id)->update(['quantity' => $data->quantity]);
        return $current_quantity;
    }

    public function deleteData($id)
    {
        $item = $this->find($id);
        $quantity = $item->quantity;
        $price = $item->price;
        $order_id = $item->order_id;
        $detail = ['order_id' => $order_id ,'quantity' => $quantity, 'price' => $price];

        $item->delete();

        return $detail;
    }

    public function deleteMe($id)
    {
        $this->find($id)->delete();
    }

    public function deleteDataByOrderId($order_id)
    {
        $this->where('order_id', $order_id)->delete();
    }

    public function getDataByArrayOrderId($arr_id)
    {
        return $this->join('products', 'order_details.product_id', 'products.id')
        ->whereIn('order_id', $arr_id)
        ->select('products.name', 'order_details.price', 'order_details.quantity')
        ->get()->toArray();
    }

}
