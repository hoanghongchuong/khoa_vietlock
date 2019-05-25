<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UploadFileRequest;
use App\Http\Controllers\Controller;
use App\BangGia;
use File, Input;
class BangGiaController extends Controller
{
   public function getList(){
    	$data = BangGia::get();
    	return view('admin.banggia.index', compact('data'));
    }
    public function getAdd(){
    	return view('admin.banggia.create', compact('data'));
    }
    public function postAdd(UploadFileRequest $req){
    	if($req->hasFile('filesTest')){
        	$file_name = $req->file('filesTest');
            $file_names = time().'_'.$file_name->getClientOriginalName();
            $fileName = changeTitle($file_names).'.'.$file_name->getClientOriginalExtension();
        }
    	$data = new BangGia();
    	$data->name = $req->txtName;
    	$data->content = $req->content;
        if(!empty($fileName)){
        	$data->doc = $fileName;
        	$req->file('filesTest')->move('upload/document/', $fileName);
        }
    	if($req->txtAlias){
            $data->alias = $req->txtAlias;
        }else{
            $data->alias = changeTitle($req->name);
        }
    	$data->save();
    	return redirect()->route('admin.banggia.index')->with('status','Thêm thành công');
    }
    public function getEdit($id){
    	$data = BangGia::findOrFail($id);
    	return view('admin.banggia.edit', compact('data'));
    }
    public function update(UploadFileRequest $req, $id){
    	$data = BangGia::find($id);
    	$file_name = $file_name = $req->file('filesTest');
    	$file_current = 'upload/document/'.$req->file_current;
    	if(!empty($file_name)){
    		$path_file = 'upload/document';
    		$fileName = time().'_'.$file_name->getClientOriginalName();
    		$file_name->move($path_file, $fileName);
    		$data->doc = $fileName;
    		if(File::exists($file_current)){
    			File::delete($file_current);
    		}
    	}

    	$data->name = $req->txtName;
    	$data->content = $req->content;
    	$data->save();
    	return redirect()->route('admin.banggia.index')->with('status','Cập nhật thành công');
    }
    public function getDelete($id){
    	$data = BangGia::find($id);
    	$data->delete();
    	return redirect()->back()->with('status','Đã xóa thành công');
    }
}
