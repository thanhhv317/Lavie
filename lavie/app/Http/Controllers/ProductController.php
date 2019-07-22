<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\ProductCategory;
use App\ProductImage;
use App\Agency;
use App\AgencyProduct;
use DB;
use Auth;
use File;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
    	// $product = Product::paginate(7)->toArray();
        $product =
            Product::join('agency_products', 'products.id', '=', 'agency_products.product_id')
                   ->join('agencies', 'agencies.id', '=', 'agency_products.agency_id')
                   ->join('users', 'agencies.user_id', '=', 'users.id')
                   ->where('users.id', $id)
                   ->select('*','products.name as pname')
                   ->paginate(5);

    	$size = count($product);

       
    	for ($i=0; $i < $size; $i++) { 
    		$id = $product[$i]['product_id'];
    		$product_img = ProductImage::select('*')->where('product_id', $id)->get()->toArray();
    		$product[$i]['image'] = $product_img;
    	}

        // echo "<pre>";
        // print_r($product);
        // echo "</pre>";


    	return view('admin.product.list')->with('product', $product);
    }

    public function getAddProduct()
    {
    	$agency = Agency::select('*')->where('user_id',Auth::user()->id)->get();
    	$category = Category::all();
    	return view('admin.product.add')->with(['category' => $category, 'agency' => $agency]);
    }

    public function postAddProduct(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
        	$product = new Product;
        	$product->name 		 = $request->name;
        	$product->base_price = $request->base_price;
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

            $cate = $request->cate;  //array
            foreach ($cate as $key => $value) {
    	        $product_cate = new ProductCategory;
    	        $product_cate->product_id  = $product_id;
    	        $product_cate->category_id = $value;
            	$product_cate->save();
            }

            $agency = $request->agency; // array
            foreach ($agency as $key => $value) {
                $agency_product = new AgencyProduct;
                $agency_product->agency_id      = $value;
                $agency_product->product_id     = $product_id;
                $agency_product->quantity       = 0;
                $agency_product->discount_rate  = 0;
                $agency_product->save();
            }
            DB::commit();
            return redirect()->route('seller.product');
        }
        catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function getEditProduct($id)
    {
        $product = Product::find($id)->toArray();
        $product_img = ProductImage::select('id', 'image')->where('product_id',$id)->get()->toArray();
        $agency_product = AgencyProduct::select('*')->where('product_id',$id)->get()->toArray();
        $product_cate = ProductCategory::select('*')->where('product_id',$id)->get()->toArray();
        $agency = Agency::select('*')->where('user_id',Auth::user()->id)->get();
        $category = Category::all();
        return view('admin.product.edit')->with([
            'product' => $product, 
            'product_img' => $product_img, 
            'agency' => $agency, 
            'category' => $category,
            'product_cate' => $product_cate,
            'agency_product' => $agency_product
        ]);
    }

    public function postEditProduct($id, ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            // store product
            $product = Product::find($id);
            $product->name       = $request->name;
            $product->base_price = $request->base_price;
            $product->save();

            // store product_image
            $file = $request->file('fImage');
            if (isset($file)){
                foreach ($file as $key => $value) {
                    $file_name = $value->getClientOriginalName();
                    $product_image = new ProductImage;
                    $product_image->product_id = $id;
                    $value->move(public_path('/uploads/products'), $file_name);
                    $product_image->image = $file_name;
                    $product_image->save();
                }
            }

            //store agency
            $agency = $request->agency;
            $quantity = $request->quantity;
            $discount_rate = $request->discount_rate;
            $size = count($agency);

            for ($i=0; $i < $size; $i++) { 
                $agency_product = AgencyProduct::select('*')->where('agency_id', $agency[$i])->where('product_id', $id)->first();
                $agency_product->quantity = $quantity[$i];
                $agency_product->discount_rate = $discount_rate[$i];
                $agency_product->save();
            }

            //store product category
            $category = $request->cate;
            $test = 0;
            $size = count($category);
            for ($i=0; $i < $size; $i++) { 
                if (($product_cate = ProductCategory::where([['product_id', $id], ['category_id', $category[$i]] ])->first())) {
                    // isset product_category;
                }
                else {
                    // add product_category
                    $product_cate = ProductCategory::create(['product_id' => $id, 'category_id' => $category[$i]]);
                }
            }
            DB::table('product_categories')->where('product_id', $id)->whereNotIn('category_id', $category)->delete();

            //add agency for product
            if ($request->has('new_agency')){
                $new_agency         = $request->new_agency;
                $new_quantity       = $request->new_quantity;
                $new_discount_rate  = $request->new_discount_rate;

                $cate_size = count($new_agency);
                for ($i=0; $i < $cate_size; $i++) { 
                    if (($agency_product = AgencyProduct::where([['product_id', $id], ['agency_id', $new_agency[$i]] ])->first())) {
                        // isset agency_product;
                    }
                    else {
                        // add agency_product
                        $agency_product = AgencyProduct::create(['product_id' => $id, 'agency_id' => $new_agency[$i], 'quantity' => $new_quantity[$i], 'discount_rate' => $new_discount_rate[$i]]);
                    }
                }
            }

            DB::commit();
            return redirect()->back();
            // echo "<pre>";
            // print_r($request->all());
            // echo "</pre>";
        }
        catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function delImgProduct(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $product_image = ProductImage::find($id);
            $image_path = public_path('/uploads/products/') . $product_image->image;
            $product_image->delete();
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            return 1;
        }
        else {
            return "not found";
        }
    }

    public function delAgencyProduct(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $agency_product = AgencyProduct::find($id);
            $agency_product->delete();
            return 1;
        }
        else{
            return "not found";
        } 
    }

    public function delProduct($id)
    {
        DB::beginTransaction();
        try {
            //delete product image
            $product_image = ProductImage::select('*')->where('product_id', $id)->get();
            foreach ($product_image as $key => $value) {
                $image_path = public_path('/uploads/products/') . $value->image;
                $value->delete();
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            //delete product cate
            ProductCategory::where('product_id', $id)->delete();

            //delete agency product;
            AgencyProduct::where('product_id', $id)->delete();

            // delete product
            $product = Product::find($id);
            $product->delete();

            DB::commit();
            return redirect()->back();
        }
        catch (Exception $e) {
            DB::rollBack();
        }
    }
}
