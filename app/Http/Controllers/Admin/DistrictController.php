<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\District;
use App\Province;
class DistrictController extends Controller
{
    public function index(){
    	$data = District::all();
    	return view('admin.district.index',compact('data'));
    }
    public function getCreate(){
    	$province = Province::all();

    	return view('admin.district.add', compact('province'));
    }

    public function postCreate(Request $req){
        $district = new District;
        $district->district_name = $req->txtName;
        $district->province_id = $req->province;
        $district->save();
        return redirect(route('admin.district.index'));
    }

    public function getEdit($id){
    	$district = District::where('id',$id)->first();
        $data = Province::all();
    	return view('admin.district.edit',compact('district','data'));
    }
    public function postEdit(Request $req, $id){
        $district = District::where('id',$id)->first();
        $district->district_name = $req->txtName;
        $district->province_id = $req->province;
        $district->save();
        return redirect(route('admin.district.index'));
    }


    public function delete($id){
        $data = District::find($id);
        $data->delete();
        return redirect()->back();
    }
}
