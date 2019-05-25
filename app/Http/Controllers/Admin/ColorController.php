<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Color;
use DB;
class ColorController extends Controller
{
    public function index()
    {
    	$colors = DB::table('colors')->orderBy('id','desc')->get();
    	return view('admin.color.index', compact('colors'));
    }

    public function getCreate()
    {

    	return view('admin.color.create');
    }

    public function postCreate(Request $req)
    {
    	$color = new Color;
    	$color->name = $req->name;
    	$color->code = $req->code;
    	$color->save();
    	return redirect()->route('admin.color.index')->with('status', 'Thêm mới thành công');
    }
    public function getEdit($id)
    {
    	$color = Color::findOrFail($id);
    	return view('admin.color.edit', compact('color'));
    }
    public function postEdit(Request $req, $id)
    {
    	$color = Color::findOrFail($id);
    	$color->name = $req->name;
    	$color->code = $req->code;
    	$color->save();
    	return redirect()->back()->with('status','Cập nhật thành công');
    }

    public function delete($id)
    {
    	$color = Color::find($id);
    	if($color){
    		$color->delete();
    		return redirect()->back()->with('status','Xóa thành công');
    	}else{
    		return redirect()->back()->with('status','màu không tồn tại');
    	}
    }
}
