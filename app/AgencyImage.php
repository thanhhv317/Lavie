<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgencyImage extends Model
{
    protected $table = 'agency_images';
    protected $fillable = ['id', 'agency_id', 'image'];

    public function agency()
    {
    	return $this->belongsTo('App\Agency');
    }

    public function getDataByAgencyId($id, $flag = true)
    {
    	if ($flag == true)
	    	return $this->select('*')->where('agency_id', $id)->get()->toArray();
	    return $this->select('*')->where('agency_id', $id)->get();
    }

    public function addData($agency_id, $name)
    {
    	$this->agency_id = $agency_id;
        $this->image	 = $name;
        $this->save();
    }

    public function deleteDataById($id, $hasId = true)
    {
    	if ($hasId == true)
    	{
			$img = $this->find($id);
			$result = $img->image;
			$img->delete();
			return $result;
    	}
    	return $this->delete();
    }
}
