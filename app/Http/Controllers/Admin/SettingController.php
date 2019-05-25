<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use App\Images;
use Input, File;
use Validator;
use Auth;
use DB;

class SettingController extends Controller
{
    public function index()
    {
        $data = DB::table('setting')->select()->first();
        
        return view('admin.setting.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        // $this->validate($request,
        //     ["txtName" => "required"],
        //     ["txtName.required" => "Bạn chưa nhập tên danh mục"]
        // );
        $setting = DB::table('setting')->select()->first();

        $data = Setting::find($setting->id);
        if(!empty($data)){
            $img = $request->file('fImages');
            if(!empty($img)){
                $path_img='upload/hinhanh';
                $img_name=time().'_'.$img->getClientOriginalName();
                $img->move($path_img,$img_name);
                $data->photo = $img_name;
            }

            $img_footer = $request->file('fImages_footer');
            if(!empty($img_footer)){
                $path_img='upload/hinhanh';
                $img_name_footer=time().'_'.$img_footer->getClientOriginalName();
                $img_footer->move($path_img,$img_name_footer);
                $data->photo_footer = $img_name_footer;
            }

            $img_page = $request->file('fImages_page');
            if(!empty($img_page)){
                $path_img='upload/hinhanh';
                $img_name_page=time().'_'.$img_page->getClientOriginalName();
                $img_page->move($path_img,$img_name_page);
                $data->photo_page = $img_name_page;
            }

            $img2 = $request->file('fImagesFavico');
            if(!empty($img2)){
                $path_img2='upload/hinhanh';
                $img_name2=time().'_'.$img2->getClientOriginalName();
                $img2->move($path_img2,$img_name2);
                $data->favico = $img_name2;
            }
            $data->name = $request->txtName;
            $data->mota = $request->txtDesc;

            $data->company = $request->txtCompany;
            $data->address = $request->txtAddress;
            $data->phone = $request->txtPhone;
            $data->hotline = $request->txtHotline;
            $data->fax = $request->txtFax;
            $data->website = $request->txtWebsite;
            $data->email = $request->txtEmail;
            $data->title_index = $request->txtTitle_index;
            $data->copyright = $request->txtCopyright;
            $data->codechat = $request->txtCodechat;
            $data->analytics = $request->txtAnalytics;
            $data->google = $request->txtGoogle;
            $data->skype = $request->txtSkype;
            $data->twitter = $request->txtTwitter;
            $data->facebook = $request->txtFacebook;
            $data->youtube = $request->txtYoutube;
            $data->toado = $request->txtToado;
            $data->iframemap = $request->txtIframemap;


            $data->title = $request->txtTitle;
            $data->content = $request->txtContent;
            $data->keyword = $request->txtKeyword;
            $data->description = $request->txtDescription;
            // if($request->status=='on'){
            //     $product->status = 1;
            // }else{
            //     $product->status = 0;
            // }
            $data->save();

            return redirect('backend/setting')->with('status','Cập nhật thành công');
        }else{
            return redirect('backend')->with('status','Cập nhật dữ liệu lỗi');
        }
    }
}
