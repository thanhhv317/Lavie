<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AgencyRequest;
use App\Agency;
use App\AgencyImage;
use App\AgencyProduct;
use Auth;
use File;
use DB;

class AgencyController extends Controller
{
    public function getUserId()
    {
        return Auth::user()->id;
    }

    public function index()
    {
        $id = $this->getUserId();
    	$agency = new Agency;
        $agency = $agency->getAllDataById($id)->toArray();
    	$size = count($agency);

    	for ($i=0; $i < $size; $i++) { 
    		$id = $agency[$i]['id'];
    		$agency_img = new AgencyImage;
            $agency_img = $agency_img->getDataByAgencyId($id, true);
    		$agency[$i]['image'] = $agency_img;
    	}

    	return view('admin.agency.list')->with('agency', $agency);
    }

    public function getAddAgency()
    {
        return view('admin.agency.add');
    }

    public function postAddAgency(AgencyRequest $request)
    {
        DB::beginTransaction();
        try {
            $id = $this->getUserId();
            $agency = new Agency;
            $agency = $agency->addData($id, $request); // result is id - new item

            $agency_id = $agency;
            $file = $request->file('fImage');
       
            foreach ($file as $key => $value) {
                $file_name = $value->getClientOriginalName();
                $this->addImage($agency_id, $file_name, $value);
            }
            DB::commit();
            return redirect()->route('seller.agency');
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function getEditAgency($id)
    {
        $agency = new Agency;
        $agency = $agency->getDataById($id, true);

        $agency_img = new AgencyImage;
        $agency_img = $agency_img->getDataByAgencyId($id);
        
        return view('admin.agency.edit')->with(['agency' => $agency, 'agency_img' => $agency_img]);
    }

    public function postEditAgency($id, AgencyRequest $request)
    {
        DB::beginTransaction();
        try {
            $agency = new Agency;
            $agency->updateDataById($id, $request);
            
            if ($files = $request->file('fImage')) {
                foreach ($files as $key => $value) {
                    $file_name  = $value->getClientOriginalName();
                    $this->addImage($id, $file_name, $value);
                }
            }
            DB::commit();
            return redirect()->route('seller.agency');

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function addImage($id, $file_name, $value)
    {
        $agency_img = new AgencyImage;
        $value->move(public_path('/uploads/agency'), $file_name);
        $agency_img = $agency_img->addData($id, $file_name);
    }

    public function delImgAgency(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $agency_img = new AgencyImage;
            $agency_img = $agency_img->deleteDataById($id); // result is Image

            $img = $agency_img;
            $this->delImageAtHost($img);
            return 1;
        } else {
            return "not found";
        }
    }

    public function delAgency($id)
    {
        DB::beginTransaction();
        try {
            //delete agency image
            $agency_img = new AgencyImage;
            $agency_img = $agency_img->getDataByAgencyId($id, false);

            foreach ($agency_img as $key => $value) {
                $value->deleteDataById($id, false);
                $this->delImageAtHost($value->image);
            }
            //delete agency product
            $agency_product = new AgencyProduct;
            $agency_product = $agency_product->deleteDataByAttrId($id, 'agency_id');
            
            $agency = new Agency;
            $agency = $agency->deleteDataById($id);

            DB::commit();
            return redirect()->route('seller.agency');
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function delImageAtHost($image)
    {
        $image_path = public_path('/uploads/agency/') . $image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
    }

}
