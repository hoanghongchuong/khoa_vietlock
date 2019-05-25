<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ThuongHieu;
class ThuongHieuController extends Controller
{
     public function index(){
    	$data = ThuongHieu::all();
    	return view('admin.thuonghieu.index',compact('data'));
    }
    public function getCreate(){
    	return view('admin.thuonghieu.create');
    }

    public function postCreate(Request $req){
        $thuonghieu = new ThuongHieu;
        $thuonghieu->name = $req->txtName;
        if($request->txtAlias){
            $thuonghieu->alias = $request->txtAlias;
        }else{
            $thuonghieu->alias = changeTitle($request->txtName);
        }
        $thuonghieu->save();
        return redirect(route('admin.thuonghieu.index'));
    }

    public function getEdit($id){
    	$data = ThuongHieu::where('id',$id)->first();
    	return view('admin.thuonghieu.edit',compact('data'));
    }
    public function postEdit(Request $request, $id){
        $data = ThuongHieu::where('id',$id)->first();
        $data->name = $request->txtName;
        if($request->txtAlias){
                $data->alias = $request->txtAlias;
            }else{
                $data->alias = changeTitle($request->txtName);
            }
        $data->save();
        return redirect(route('admin.thuonghieu.index'));
    }

    public function delete($id){
        $data = ThuongHieu::find($id);
        $data->delete();
        return redirect()->back();
    }
}
