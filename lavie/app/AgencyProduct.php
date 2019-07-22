<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgencyProduct extends Model
{
    protected $table = 'agency_products';
    protected $fillable = ['id', 'agency_id', 'product_id', 'quantity', 'discount_rate'];

    public function addData($agency_id, $product_id, $quantity = 0, $discount_rate = 0)
    {
        $this->agency_id      = $agency_id;
        $this->product_id     = $product_id;
        $this->quantity       = $quantity;
        $this->discount_rate  = $discount_rate;
        $this->save();
    }

    public function getDataByProductId($id, $flag = true)
    {
        if ($flag == true)
            return $this->select('*')->where('product_id', $id)->get()->toArray();
        return $this->select('*')->where('product_id', $id)->get();
    }

    public function getDataByIdAndProductId($id, $product_id)
    {
        return $this->select('*')->where('agency_id', $id)->where('product_id', $product_id)->first();
    }

    public function updateQuantityAndDiscoundtRate($quantity, $discount_rate)
    {
        $this->quantity = $quantity;
        $this->discount_rate = $discount_rate;
        $this->save();
    }

    public function getDataByProIdAndAgenId($product_id, $agency_id)
    {
        return $this->where([['product_id', $product_id], ['agency_id', $agency_id]])->first();
    }

    public function deleteDataById($id)
    {
        return $this->find($id)->delete();
    }

    public function deleteDataByAttrId($id, $attr = 'product_id')
    {
        return $this->where($attr, $id)->delete();
    }

}
