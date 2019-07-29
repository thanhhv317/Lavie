<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\Agency;
use App\AgencyProduct;
use App\ProductCategory;
use App\Category;

class SingleProductController extends Controller
{
    public function getData($slug, $product_id)
    {
    	$product = new Product;
    	$product = $product->getAllDataById($product_id);

    	$size = count($product);

        $this->groupImg($product, $size);
        $this->groupAgency($product, $size);

        $p_cate = new ProductCategory;
        $p_cate = $p_cate->getDataByProductId($product_id);

        $arr_id = [];
        foreach ($p_cate as $key => $value) {
            $arr_id[] = $value['category_id'];
        }

        $cate = new Category;
        $cate = $cate->getDataById($arr_id)->toArray();
        $product[0]['categories'] = $cate;

        $product = $product[0]->toArray();

        // 20 product same categories
        $product_cate = new Product;
        $product_cate = $product_cate->getCateById($product_id);

        $cate_id_arr = [];
        foreach ($product_cate as $key => $value) {
        	$cate_id_arr[] = $value['category_id'];
        }

        $product_same_cate = new Product;
        $product_same_cate = $product_same_cate->getDataSameCate($cate_id_arr);

        $product_id_arr = [];
        foreach ($product_same_cate as $key => $value) {
        	$product_id_arr[] = $value['product_id'];
        }
        $product_id_arr = array_unique($product_id_arr); // array store product_ids.
        foreach ($product_id_arr as $key => $value) {
        	if($value == $product_id) unset($product_id_arr[$key]);
        }

        $product_same = new Product;
        $product_same = $product_same->getAllDataInArrayProductId($product_id_arr);

        $size = count($product_same);

    	for ($i=0; $i <= $size; $i++) { 
    		$this->groupImg($product_same, $i);
   			$this->groupAgency($product_same, $i);
    	}
    	// complete same product by category
    	$product_same = $product_same->toArray();


    	$user_id = new Product;
    	$user_id = $user_id->getUserId($product_id);
    	$user_id = $user_id[0]->user_id;

    	$seller_product = new Product;
    	$seller_product = $seller_product->getAllDataByUserId($user_id, $product_id);

    	$size = count($seller_product);

    	for ($i=0; $i <= $size; $i++) { 
    		$this->groupImg($seller_product, $i);
   			$this->groupAgency($seller_product, $i);
    	}
    	// complete same product by category
    	$seller_product = $seller_product->toArray();



    	// echo "<pre>";
    	// print_r($product);
    	// echo "</pre>";

    	return view('homepage.productDetail')->with([
    		'product'	  	 => $product,
    		'product_same'	 => $product_same,
    		'seller_product' => $seller_product
    	]);

    }

    public function groupImg($product, $size)
    {
        for ($i=0; $i < $size; $i++) { 
            $id = $product[$i]['product_id'];
            $product_img = new ProductImage;
            $product_img = $product_img->getAllDataById($id);
            $product[$i]['image'] = $product_img;
        }
    }

    public function groupAgency($product, $size)
    {
        for ($i=0; $i < $size; $i++) { 
            $id = $product[$i]['product_id'];
            $agency_product = new AgencyProduct;
            $agency_product = $agency_product->getDataByProductId($id);
            $product[$i]['agen_pro'] = $agency_product;
        }
    }
}
