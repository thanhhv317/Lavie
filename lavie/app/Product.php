<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Product;
use App\ProductCategory;
use App\ProductImage;
use App\Agency;
use App\AgencyProduct;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['id', 'name', 'base_price'];

    public function productImage()
    {
    	return $this->hasMany('App\ProductImage');
    }

    public function agency()
    {
    	return $this->belongsToMany('App\Agency');
    }

    public function category()
    {
    	return $this->belongsToMany('App\Category');
    }

    public function getAllDataById($id)
    {
        return $product = $this->join('agency_products', 'products.id', '=', 'agency_products.product_id')
                   ->join('agencies', 'agencies.id', '=', 'agency_products.agency_id')
                   ->join('users', 'agencies.user_id', '=', 'users.id')
                   ->where('users.id', $id)
                   ->select('*','products.name as pname')
                   ->paginate(6);
    }

    public function addData($data)
    {
        $this->name       = $data->name;
        $this->base_price = $data->base_price;
        $this->save();
    }

    public function getDataById($id, $flag = true)
    {
        if ($flag == true)
            return $this->find($id)->toArray();
        return $this->find($id);
    }

    public function deleteDataById($id)
    {
        return $this->find($id)->delete();
    }

    public function getAllData()
    {
        return $this->join('agency_products', 'products.id', '=', 'agency_products.product_id')
            ->join('agencies', 'agencies.id', '=', 'agency_products.agency_id')
            ->select('*','products.name as pname')
            ->paginate(12);
    }

    public function getAllDataByName($name)
    {
        return $this->join('agency_products', 'products.id', '=', 'agency_products.product_id')
            ->join('agencies', 'agencies.id', '=', 'agency_products.agency_id')
            ->where('products.name', 'like', $name.'%')
            ->select('*','products.name as pname')
            ->paginate(12);
    }
}
