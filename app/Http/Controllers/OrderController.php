<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\User;
use App\OrderDetail;
use Auth;
use DB;

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

    public function viewOrderDetail($id)
    {
    	$order_detail = new OrderDetail;
    	$order_detail = $order_detail->getDataByOrderId($id);

    	$link = "" . asset('uploads/products');

    	$arr = [$order_detail, $link];

    	return $arr;
    }

    public function setStatus(Request $request)
    {
    	if ($request->ajax()) {
    		$order = new Order;
    		$order = $order->setStatusById($request->id, $request->status);
    		return 1;
    	} else {
    		return "file not found";
    	}
    }

    public function editOrderDetail(Request $request)
    {
    	if ($request->ajax()) {
            DB::beginTransaction();
            try {
        		$order_detail = new OrderDetail;
        		$order_detail = $order_detail->updateQuantityById($request);

                $new_quantity = $request->quantity;

                $order = new Order;
                $order = $order->updateDataById($order_detail, $new_quantity);

                DB::commit();
                return $order;
            } catch (Exception $e) {
                DB::rollBack();
            }
    	} else {
    		return "not found !";
    	}
    }

    public function deleteOrderDetail(Request $request)
    {
        if ($request->ajax()) {
            DB::beginTransaction();
            try {
                $order_detail = new OrderDetail;
                $order_detail = $order_detail->deleteData($request->id);

                $order_id = $order_detail['order_id'];

                $order = new Order;
                $order = $order->updateDataById($order_detail, 0);
                
                if ($order <= 0 ) {
                    // order is null
                    $this->_delOrder($order_id);
                    echo 1;
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
            }
        } else {
            return "not found";
        }
    }

    public function deleteOrder(Request $request)
    {
        if ($request->ajax()) {
            DB::beginTransaction();
            try {
                $order_detail = new OrderDetail;
                $order_detail = $order_detail->deleteDataByOrderId($request->id);

                $this->_delOrder($request->id);
                DB::commit();
                return 1;
            } catch (Exception $e) {
                DB::rollBack();
            }
        } else {
            return "not found !";
        }
    }

    public function _delOrder($id)
    {
        $_order = new Order;
        $_order = $_order->deleteOrderById($id);
    }
}
