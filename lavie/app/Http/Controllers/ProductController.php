<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\ProductCategory;
use App\ProductImage;
use App\Agency;
use Auth;

class ProductController extends Controller
{
    public function index()
    {
    	$product = Product::all()->toArray();
    	$size = count($product);

    	for ($i=0; $i < $size; $i++) { 
    		$id = $product[$i]['id'];
    		$product_img = ProductImage::select('*')->where('product_id', $id)->get()->toArray();
    		$product[$i]['image'] = $product_img;
    	}
  
    	return view('admin.product.list')->with('product', $product);
    }

    public function getAddProduct()
    {
    	$agency = Agency::select('*')->where('user_id',Auth::user()->id)->get();
    	$category = Category::all();
    	return view('admin.product.add')->with(['category' => $category, 'agency' => $agency]);
    }

    public function postAddProduct(Request $request)
    {
    	$product = new Product;
    	$product->name 		 = $request->name;
    	$product->base_price = $request->basePrice;
    	$product->save();

    	$product_id = $product->id;
        $file = $request->file('fImage');
   
        foreach ($file as $key => $value) {
            $file_name = $value->getClientOriginalName();
            $product_img = new ProductImage;
            $product_img->product_id = $product_id;
            $value->move(public_path('/uploads/products'), $file_name);
            $product_img->image = $file_name;
            $product_img->save();
        }

        $cate = $request->cate;
        foreach ($cate as $key => $value) {
	        $product_cate = new ProductCategory;
	        $product_cate->product_id = $product_id;
	        $product_cate->category_id = $value;
        	$product_cate->save();
        }

        return redirect()->route('seller.product');
    }
}
