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
        $product = new Product;
        $product = $product->getAllData();

     	$size = count($product);

    	for ($i=0; $i < $size; $i++) { 
    		$id = $product[$i]['product_id'];
    		$product_img = new ProductImage;
            $product_img = $product_img->getAllDataById($id);
    		$product[$i]['image'] = $product_img;
    	}

    	for ($i=0; $i < $size; $i++) { 
            $id = $product[$i]['product_id'];
            $agency_product = new AgencyProduct;
            $agency_product = $agency_product->getDataByProductId($id);
            $product[$i]['agen_pro'] = $agency_product;
        }

    	// echo "<pre>";
    	// print_r($product);
    	// echo "</pre>";

        return view('test')->with(['product' => $product]);
    }

    public function searchByPriceSlide($min, $max)
    {
    	echo $min . " - " . $max;
    }

    public function searchByNameProduct(Request $request)
    {
    	$product = new Product;
        $product = $product->getAllDataByName($request->name);

     	$size = count($product);

    	for ($i=0; $i < $size; $i++) { 
    		$id = $product[$i]['product_id'];
    		$product_img = new ProductImage;
            $product_img = $product_img->getAllDataById($id);
    		$product[$i]['image'] = $product_img;
    	}

    	for ($i=0; $i < $size; $i++) { 
            $id = $product[$i]['product_id'];
            $agency_product = new AgencyProduct;
            $agency_product = $agency_product->getDataByProductId($id);
            $product[$i]['agen_pro'] = $agency_product;
        }

    	// echo "<pre>";
    	// print_r($product->toArray());
    	// echo "</pre>";

        return view('test')->with(['product' => $product]);
    }
}
