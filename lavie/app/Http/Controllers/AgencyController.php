<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AgencyRequest;
use App\Agency;
use App\AgencyImage;
use Auth;
use File;

class AgencyController extends Controller
{
    public function index()
    {
    	$agency = Agency::all()->toArray();
    	$size = count($agency);

    	for ($i=0; $i < $size; $i++) { 
    		$id = $agency[$i]['id'];
    		$agency_img = AgencyImage::select('*')->where('agency_id', $id)->get()->toArray();
    		$agency[$i]['image'] = $agency_img;
    	}
    	return view('admin.agency.list')->with('agency', $agency);
    }

    public function getAddAgency()
    {
        return view('admin.agency.add');
    }

    public function postAddAgency(Request $request)
    {
        $agency = new Agency;
        $agency->name = $request->name;
        $agency->address = $request->address;
        $agency->user_id = Auth::user()->id;
        $agency->save();

        $agency_id = $agency->id;
        $file = $request->file('fImage');
   
        foreach ($file as $key => $value) {
            $file_name = $value->getClientOriginalName();
            $agency_img = new AgencyImage;
            $agency_img->agency_id = $agency_id;
            $value->move(public_path('/uploads/agency'), $file_name);
            $agency_img->image = $file_name;
            $agency_img->save();
        }
        return redirect()->route('seller.agency');
    }

    public function getEditAgency($id)
    {
        $agency = Agency::find($id)->toArray();
        $agency_img = AgencyImage::select('id', 'image')->where('agency_id',$id)->get()->toArray();
        return view('admin.agency.edit')->with(['agency' => $agency, 'agency_img' => $agency_img]);
    }

    public function postEditAgency($id, Request $request)
    {
        $agency = Agency::find($id);
        $agency->name    = $request->name;
        $agency->address = $request->address;
        $agency->save();
        
        if ($files = $request->file('fImage')) {
            foreach ($files as $key => $value) {
                $file_name = $value->getClientOriginalName();
                $agency_img = new AgencyImage;
                $agency_img->agency_id = $id;
                $value->move(public_path('/uploads/agency'), $file_name);
                $agency_img->image = $file_name;
                $agency_img->save();
            }
        }
        return redirect()->route('seller.agency');
    }

    public function delImgAgency($id)
    {
        $agency_img = AgencyImage::find($id);
        $image_path = public_path('/uploads/agency/') . $agency_img->image;
        $agency_img->delete();
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        return 1;
    }

    public function delAgency($id)
    {
        $agency_img = AgencyImage::select('*')->where('agency_id', $id)->get();
        foreach ($agency_img as $key => $value) {
            $image_path = public_path('/uploads/agency/') . $value->image;
            $value->delete();
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $agency = Agency::find($id);
        $agency->delete();

        return redirect()->route('seller.agency');
    }

}
