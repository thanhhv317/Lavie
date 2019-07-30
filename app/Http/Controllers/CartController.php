<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

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
            return $request->all();
        }
        else
        {
            return "not found";
        }
    }
}
