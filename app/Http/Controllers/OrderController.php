<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\User;
use App\OrderDetail;
use Auth;

class OrderController extends Controller
{
	private function getUserId()
    {
        return Auth::user()->id;
    }

    public function index()
    {
    	$id = $this->getUserId();
    	$order = new Order;
    	$order = $order->getAllOrderBySellerId($id);
    	
    	// echo "<pre>";
    	// print_r($order);
    	// echo "</pre>";

   		return view('admin.order.listAll')->with('order', $order);
    }

    public function orderDetail($id)
    {
    	$order_detail = new OrderDetail;
    	$order_detail = $order_detail->getDataByOrderId($id);

    	$link = "" . asset('uploads/products');

    	$arr = [$order_detail, $link];

    	return $arr;
    }

    public function setStatus(Request $request)
    {
    	if($request->ajax())
    	{
    		$order = new Order;
    		$order = $order->setStatusById($request->id, $request->status);
    		return 1;
    	}
    	else{
    		return "file not found";
    	}
    }
}
