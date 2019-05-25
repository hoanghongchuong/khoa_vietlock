<?php 

namespace App\Http\Controllers\AdminAuth;



use App\Http\Requests\RegisterAdminRequest;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Http\Requests\UserAdminRequest;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Users;

use App\Images;

use Input, File;

use Validator;

use Auth;

use DB,Hash;





class AuthController extends Controller {



    /*

    |--------------------------------------------------------------------------

    | Registration & Login Controller

    |--------------------------------------------------------------------------

    |

    | This controller handles the registration of new users, as well as the

    | authentication of existing users. By default, this controller uses

    | a simple trait to add these behaviors. Why don't you explore it?

    |

    */

    protected $redirectTo = 'backend';

    

    use AuthenticatesUsers;



    /**

     * Create a new authentication controller instance.

     *

     * @param  \Illuminate\Contracts\Auth\Guard  $auth

     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar

     * @return void

     */

    public function __construct()

    {
        session_start();
        $this->middleware('guest')->except('logout');

    }

    public function getRegister()

    {

        return view('admin.auth.register');

    }

    public function postRegister(RegisterAdminRequest $request)

    {

        $thanhvien = new Users;

        $thanhvien->username = $request->username;

        $thanhvien->name = $request->name;

        $thanhvien->email = $request->email;

        $thanhvien->level = 1;

        $thanhvien->password = Hash::make($request->password);

        $thanhvien->remember_token = $request->_token;

        $thanhvien->save();

        return redirect('backend/login');

    }

    public function getLogin()

    {

        return view('admin.auth.login');

    }

    public function postLogin(UserAdminRequest $request)

    {

        $auth = array(

            'username' => $request->username,

            'password' => $request->password,

            'level' => 1,

            'status' => 1

        );   

        $remember = $request->remember ? true : false;



        if (Auth::attempt($auth, $remember)) {

            $_SESSION['isLoggedIn'] = 'false';

            return redirect('backend')->with('flash_notice', 'Đăng nhập thành công.');;

        }else{

            return redirect('backend/login')->with('flash_error', 'Tên đăng nhập hoặc mật khẩu không đúng.')

            ->withInput();;

        }

    }

    public function logout()

    {

        Auth::logout();

        $_SESSION['isLoggedIn'] = null;

        return redirect()->route('admin.auth.getLogin');

    }



}

