<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use App\Images;
use Input, File;
use Validator;
use Auth;
use DB,Hash;

class UsersController extends Controller
{
    public function index()
    {
        $data = DB::table('user')->select()->first();
        
        return view('admin.users.edit', compact('data'));
    }
    public function getAdmin()
    {
        $id_user=Auth::user()->id;
        $data = DB::table('users')->select()->where('id', $id_user)->get()->first();
        
        return view('admin.users.admin', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updateinfo(Request $request)
    {
        $this->validate($request,
            [
                "txtName" => "required",
                // "txtPassword" => "required",
                //'txtPasswordNew' => 'min:8|confirmed'
            ],
            [
                "txtName.required" => "Bạn chưa nhập tên",
                //"txtPasswordNew.length" => "Mật khẩu ít nhất 8 ký tự",
                // "txtPassword.required" => "Bạn chưa nhập lại mật khẩu"
            ]
        );
        $id_user = Auth::user()->id;
        //$user = DB::table('users')->select('id',$id_user)->first();

        $data = Users::find($id_user);
        if(!empty($data)){
            $img = $request->file('fImages');

            if(!empty($img)){
                $path_img='upload/users';
                $img_name=$img->getClientOriginalName();
                $img->move($path_img,$img_name);
                $data->photo = $img_name;
            }
            $data->name = $request->txtName;
            if(!empty($request->txtPasswordNew)){
                $data->password = Hash::make($request->txtPasswordNew);
            }
            
            $data->address = $request->txtAddress;
            $data->phone = $request->txtPhone;
            $data->email = $request->txtEmail;
            // if($request->status=='on'){
            //     $product->status = 1;
            // }else{
            //     $product->status = 0;
            // }
            $data->save();

            return redirect('backend/users/info')->with('status','Cập nhật thành công');
        }else{
            return redirect('backend')->with('status','Cập nhật dữ liệu lỗi');
        }
    }
}
