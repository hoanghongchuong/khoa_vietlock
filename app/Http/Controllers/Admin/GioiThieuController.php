<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\GioithieuRequest;
use App\Http\Controllers\Controller;
use App\GioiThieu;
use File;
class GioiThieuController extends Controller
{
    public function index(){
    	$data = GioiThieu::all();
    	return view('admin.gioithieu.list', compact('data'));
    }
    public function getAdd(){

    	return view('admin.gioithieu.add');
    }
    public function postAdd(GioithieuRequest $request){
        $img = $request->file('fImages');
        $path_img='upload/banner';
        $img_name='';
        if(!empty($img)){
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
        }
    	$data = new GioiThieu;
    	$data->name = $request->txtName;
    	 if($request->txtAlias){
            $data->alias = $request->txtAlias;
        }else{
            $data->alias = changeTitle($request->txtName);
        }
        $data->image = $img_name; 
        $data->mota = $request->txtDesc;
        $data->content = $request->txtContent;
        $data->title = $request->txtTitle;
        $data->keyword = $request->txtKeyword;
        $data->description = $request->txtDescription;
        if($request->status=='on'){
            $data->status = 1;
        }else{
            $data->status = 0;
        }
        $data->save();
    	return redirect()->route('admin.gioithieu.index')->with('status','Thêm thành công');
    }
    public function getEdit($id){
    	$data = GioiThieu::find($id);
    	return view('admin.gioithieu.edit',compact('data'));
    }
    public function postEdit(Request $request, $id){
    	$data = GioiThieu::where('id',$id)->first();
        $img = $request->file('fImages');
        $img_current = 'upload/banner/'.$request->img_current;
        if(!empty($img)){
            $path_img='upload/banner';
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
            $data->image = $img_name;
            if (File::exists($img_current)) {
                File::delete($img_current);
            }
        }
        $data->name = $request->txtName;
        if($request->txtAlias){
                $data->alias = $request->txtAlias;
            }else{
                $data->alias = changeTitle($request->txtName);
            }
            $data->mota = $request->txtDesc;
        $data->content = $request->txtContent;
        $data->title = $request->txtTitle;
        $data->keyword = $request->txtKeyword;
        $data->description = $request->txtDescription;
        if($request->status=='on'){
            $data->status = 1;
        }else{
            $data->status = 0;
        }
        $data->save();
    	return redirect()->route('admin.gioithieu.index')->with('status','Cập nhật thành công');
    }
    public function delete($id){
    	$data = GioiThieu::find($id);
    	$data->delete();
    	return redirect()->back()->with('status','Xoá thành công');
    }
}
