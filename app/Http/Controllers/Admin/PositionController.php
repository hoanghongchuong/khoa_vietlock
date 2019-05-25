<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Position;
class PositionController extends Controller
{
    //
    public function getList(){
    	$data = Position::get();
    	return view('admin.banner_position.list', compact('data'));
    }
    public function getAdd(){
    	return view('admin.banner_position.add');
    }
    public function postAdd(Request $req){
    	$data = new Position();
    	$data->name = $req->txtName;
    	$data->save();
    	return redirect()->route('admin.position.index');
    }
    public function getEdit($id){
    	$data = Position::find($id);
    	return view('admin.banner_position.edit', compact('data'));
    }
    public function update(Request $req, $id){
    	$data = Position::find($id);
    	$data->name = $req->txtName;
    	$data->save();
    	return redirect()->route('admin.position.index');
    }
    public function getDelete($id){
    	$data = Position::find($id);
    	$data->delete();
    	return redirect()->back();
    }
}
