<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;
use App\AgencyProduct;
use App\ProductImage;
use App\Category;
use App\Product;
use App\Agency;

class HomePageController extends Controller
{
    public function index()
    {
        $product = Product::join('agency_products', 'products.id', '=', 'agency_products.product_id')
                   ->join('product_images', 'product_images.product_id', '=', 'products.id')
                   ->get()->toArray();
                   // ->paginate(12);

    	// $product = ProductImage::distinct('product_id', 'image')->select( 'product_id', 'image')->get()->toArray();

        echo "<pre>";
        print_r($product);
        echo "</pre>";

        $size = count($product);

        for ($i=0; $i < $size-1; $i++) { 
        	if($product[$size]['product_id'] == $product[$size+1]['product_id'])
        	{
        		unset(var)
        		// xoa thang do ra di
        	}
        }

        // return view('test')->with(['product' => $product]);

    }
}
