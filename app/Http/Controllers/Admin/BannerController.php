<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use App\Position;
use File;

class BannerController extends Controller
{
    //
    public function getList(){
    	$data = Banner::get();
    	return view('admin.banner.list', compact('data'));
    }
    public function getAdd(){
    	$data = Position::get();
    	return view('admin.banner.add', compact('data'));
    }
    public function postAdd(Request $req){
    	$img = $req->file('fImages');
        $path_img='upload/banner';
        $img_name='';
        if(!empty($img)){
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
        }
    	$data = new Banner();
    	$data->image = $img_name; 
    	$data->position = $req->position;
        $data->link = $req->txtLink;
        $data->title = $req->title;
    	$data->mota = $req->mota;
    	$data->save();
    	return redirect()->route('admin.banner.index');
    }
    public function getEdit($id){
    	$data = Banner::findOrFail($id);
    	$position = Position::get()->toArray();
    	// dd($position);
    	return view('admin.banner.edit', compact('data','position'));
    }
    public function update(Request $req, $id){
    	$data = Banner::find($id);
        $img = $req->file('fImages');
        $img_current = 'upload/banner/'.$req->img_current;
        // dd($img_current);
        if(!empty($img)){
            $path_img='upload/banner';
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
            $data->image = $img_name;
            if (File::exists($img_current)) {
                File::delete($img_current);
            }
        }
    	$data->title = $req->title;
        $data->mota = $req->mota;
    	$data->link = $req->txtLink;
    	$data->position = $req->position;
    	$data->save();
    	return redirect()->route('admin.banner.index');
    }
    public function getDelete($id){
    	$data = Banner::find($id);
    	$data->delete();
    	return redirect()->back();
    }
}
