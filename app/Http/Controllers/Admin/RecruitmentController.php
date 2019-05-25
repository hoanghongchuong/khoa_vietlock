<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recruitment;
class RecruitmentController extends Controller
{
    //
    public function getRecruitment(){
    	$data = Recruitment::get();
    	$trang = "tuyển dụng";
    	return view('admin.recruitment.index', compact('data','trang'));
    }
    public function deleteRecruitment($id){
    	$re = Recruitment::find($id);
    	$re->delete();
    	return redirect()->back()->with('mess','Xoá thành công');
    }
    public function accessRe(Request $req){
    	$recruitment = Recruitment::where('id', $req->recruitment_id)->update(['status' => 1]);
    }
}
