<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\OrderDetail;
use DB;

class CartController extends Controller
{
    public function index()
    {
    	return view('homepage.cart');
    }

    public function getDataCart(Request $request)
    {
    	$cart = $request->cart;
    	$result = [];

    	foreach ($cart as $key => $value) {
    		$item  = json_decode($value);
    		$product = new Product;
    		$product = $product->getRealPriceAndQuantityById($item->id);
    		$item->quantity = ($item->quantity > $product['sum_quantity']) ? $product['sum_quantity'] : $item->quantity;
    		$item->price = $this->caculateRealPrice($product['base_price'], $product['discount_rate']);
            $item->max = $product['sum_quantity'];
    		$item = json_encode($item);
    		$result[] = $item;
    	}
    	return $result;
    }

    private function caculateRealPrice($base_price, $discount_rate)
    {
    	return $base_price - ($base_price * $discount_rate / 100);
    }

    public function orderProduct(Request $request)
    {
        if($request->ajax())
        {
            DB::beginTransaction();
            try {
                $arr = [];
                $cart = $request->cart;
                
                foreach ($cart as $key => $value) {
                    $item  = json_decode($value);
                    array_push($arr, $item->seller_id);
                }

                $arr = array_unique($arr);

                foreach ($arr as $key => $value) {
                    $price = 0;
                    $quantity = 0;
                    foreach ($cart as $key1 => $value1) {
                        $item  = json_decode($value1);
                        if($item->seller_id == $value){
                            $price += $item->price * $item->quantity;
                            $quantity += $item->quantity;
                        }
                    }
                    $order_data = [];
                    $order_data['seller_id']   = $value;
                    $order_data['buyer_id']    = $request->buyer_id;
                    $order_data['status']      = 0;
                    $order_data['price']       = $price;
                    $order_data['cost']        = $request->deliveryCost;
                    $order_data['total_price'] = $price + $request->deliveryCost;
                    $order_data['quantity']    = $quantity;
                    $order_data['pay']         = $request->pay;

                    $order = new Order;
                    $order = $order->createOrder($order_data);

                    foreach ($cart as $key1 => $value1) {
                        $item  = json_decode($value1);
                        if($item->seller_id == $value){
                            $order_detail_data = [];
                            $order_detail_data['order_id'] = $order;
                            $order_detail_data['product_id'] = $item->id;
                            $order_detail_data['price'] = $item->price;
                            $order_detail_data['quantity'] = $item->quantity;

                            $order_detail = new OrderDetail;
                            $order_detail = $order_detail->createOrderDetail($order_detail_data);
                        }
                    }
                    
                }

                DB::commit();
                return 1;
            }
            catch (Exception $e) {
                DB::rollBack();
            }
        }
        else
        {
            return "not found";
        }
    }
}
