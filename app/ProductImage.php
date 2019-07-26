<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $fillable = ['id', 'product_id', 'image'];

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public function getAllDataById($id)
    {
    	$product_img = $this->where('product_id', $id)->select('*')->get()->toArray();
    	return $product_img;
    }

    public function addData($product_id, $name)
    {
        $this->product_id = $product_id;
        $this->image = $name;
        $this->save();
    }

    public function getDataByProductId($id, $flag = true)
    {
        if ($flag ==true )
            return $this->select('id', 'image')->where('product_id', $id)->get()->toArray();
        return $this->select('id', 'image')->where('product_id', $id)->get();
    }

    public function getDataById($id)
    {
        return $this->find($id);
    }

    public function deleteData()
    {
        return $this->delete();
    }
}
