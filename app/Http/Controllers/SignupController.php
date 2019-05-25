<?php

namespace App\Http\Controllers;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterAdminRequest;
use DB,Hash;
class SignupController extends Controller
{
    public function signup(){

    	return view('templates.signup');
    }
    public function postSignup(RegisterAdminRequest $request){
    	
    	$thanhvien = new Users;
        $thanhvien->username = $request->username;
        $thanhvien->name = $request->name;
        $thanhvien->email = $request->email;
        $thanhvien->level = 2;
        $thanhvien->password = Hash::make($request->password);
        $thanhvien->remember_token = $request->_token;
        $thanhvien->save();
        return redirect()->route('getLogin')->with('mess','Đăng ký thành công');

    }
}
