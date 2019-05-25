<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;
class VideoController extends Controller
{
    public function index(){
    	$data = Video::all();
    	return view('admin.video.index', compact('data'));
    }
    public function getCreate(){
    	return view('admin.video.create');
    }
    public function postCreate(Request $request){
        $data = new Video;
        $data->link = $request->link;
        $data->save();
    	return redirect(route('admin.video.index'));
    }
    public function getEdit($id){
    	$data = Video::find($id);
    	// dd($data);
    	return view('admin.video.edit', compact('data'));
    }
    public function postEdit(Request $request, $id){
    	$data = Video::where('id',$id)->first();
    	
    	$data->link = $request->link;
    	$data->save();
    	return redirect(route('admin.video.index'));
    }
    public function delete($id){
    	$data = Video::where('id',$id)->first();
    	$data->delete();
    	return redirect()->back();
    }
}
