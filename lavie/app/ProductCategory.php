<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $fillable = ['id', 'product_id', 'category_id'];

	public function addData($product_id, $category_id)
	{
	 	$this->product_id  = $product_id;
        $this->category_id = $category_id;
    	$this->save();
	}

	public function getDataByProductId($id, $flag = true)
	{
		if ($flag == true)
			return  $this->select('*')->where('product_id', $id)->get()->toArray();
		return  $this->select('*')->where('product_id', $id)->get();
	}

	public function getDataByProIdAndCateId($product_id, $category_id)
	{
		return $this->where([['product_id', $product_id], ['category_id', $category_id]])->first();
	}

	public function deleteNotIn($product_id, $category_arr)
	{
		return $this->where('product_id', $product_id)->whereNotIn('category_id', $category_arr)->delete();
	}

	public function deleteDataByProductId($id)
    {
        return $this->where('product_id', $id)->delete();

    }
}
