<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\PartnerRequest;
use App\Http\Controllers\Controller;
use File;
use App\Partner;

class PartnerController extends Controller
{
    public function getList(){
    	$data = Partner::get();
    	return view('admin.partner.list', compact('data'));
    }
    public function getAdd(){
    	return view('admin.partner.add');
    }
    public function postAdd(PartnerRequest $req){
    	$img = $req->file('fImages');
        $path_img='upload/banner';
        $img_name='';
        if(!empty($img)){
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
        }
    	$data = new Partner();
    	$data->name = $req->name;
        $data->email = $req->email;
        $data->phone = $req->phone;
    	$data->photo = $img_name; 
    	$data->com = "doi-tac";
    	$data->url = $req->txtLink;
    	if($req->status=='on'){
            $data->status = 1;
        }else{
            $data->status = 0;
        }
        // dd($data);
    	$data->save();
    	return redirect()->route('admin.partner.index');
    }
    public function getEdit($id){
    	$data = Partner::findOrFail($id);
    	return view('admin.partner.edit', compact('data'));
    }
    public function update(Request $req, $id){
    	$data = Partner::find($id);
        $img = $req->file('fImages');
        $img_current = 'upload/banner/'.$req->img_current;
        // dd($img_current);
        if(!empty($img)){
            $path_img='upload/banner';
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
            $data->photo = $img_name;
            if (File::exists($img_current)) {
                File::delete($img_current);
            }
        }
    	$data->name = $req->name;
        $data->email = $req->email;
        $data->phone = $req->phone;
    	$data->url = $req->txtLink;
    	if($req->status=='on'){
            $data->status = 1;
        }else{
            $data->status = 0;
        }
    	$data->save();
    	return redirect()->route('admin.partner.index');
    }
    public function getDelete($id){
    	$data = Partner::find($id);
    	$data->delete();
    	return redirect()->back();
    }
}
