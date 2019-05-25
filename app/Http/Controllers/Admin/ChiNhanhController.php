<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ChiNhanh;
use File;
class ChiNhanhController extends Controller
{
    public function index(){
    	$chinhanh = ChiNhanh::all();
    	return view('admin.chinhanh.index', compact('chinhanh'));	
    }
    public function getCreate(){

    	return view('admin.chinhanh.create');
    }

    public function postCreate(Request $request){
        $img = $request->file('fImages');
        $path_img='upload/hinhanh';
        $img_name='';
        if(!empty($img)){
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
        }
    	$chinhanh = new ChiNhanh;
    	$chinhanh->name = $request->txtName;
    	$chinhanh->phone = $request->txtPhone;
        $chinhanh->website = $request->website;
        $chinhanh->address = $request->txtAddress;
    	$chinhanh->map = $request->map;
        $chinhanh->photo = $request->img_name;
    	$chinhanh->save();
    	return redirect(route('admin.chinhanh.index'))->with('status','Thêm mới thành công !');
    }
    public function getEdit($id){
    	$chinhanh = ChiNhanh::where('id',$id)->first();
    	// dd($chinhanh);
    	return view('admin.chinhanh.edit',compact('chinhanh'));
    }

    public function postEdit(Request $request, $id){
    	$chinhanh = ChiNhanh::where('id',$id)->first();
        $img = $request->file('fImages');
        $img_current = 'upload/hinhanh/'.$request->img_current;
        if(!empty($img)){
            $path_img='upload/hinhanh';
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
            $chinhanh->photo = $img_name;
            if (File::exists($img_current)) {
                File::delete($img_current);
            }
        }
    	$chinhanh->name = $request->txtName;
    	$chinhanh->phone = $request->txtPhone;
        $chinhanh->website = $request->website;
    	$chinhanh->address = $request->txtAddress;
        $chinhanh->map = $request->map;
    	$chinhanh->save();
    	return redirect(route('admin.chinhanh.index'))->with('status','Sửa thành công !');
    }
    public function delete($id){
    	$data = ChiNhanh::find($id);
    	$data->delete();
    	return redirect()->back()->with('status','Xóa thành công !');
    }
}
