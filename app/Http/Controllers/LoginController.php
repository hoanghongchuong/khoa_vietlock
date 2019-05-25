<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin(){
    	return view('templates.login');
    }
    public function postLogin(Request $request){
    	$this->validate($request, 
    		[
	    		'email' => 'required',
	    		'password' => 'required'
	    	],
	    	[
	    		'email.required' => 'Bạn chưa nhập email',
	    		'password.required' => 'Bạn chưa nhập password'
	    	]
	    );
	    if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password]))
	    {
	    	return redirect()->route('index');
	    }
	    else
	    {
	    	return redirect()->back()->with('mess','Email hoặc mật khẩu không chính xác');
	    }
    }
    public function logout(){
    	Auth::logout();
    	return redirect(route('index'));
    }
}
