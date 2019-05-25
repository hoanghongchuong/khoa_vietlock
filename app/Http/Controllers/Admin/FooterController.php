<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\About;
use App\Images;
use Input, File;
use Validator;
use Auth;

class AboutController extends Controller
{
    public function index()
    {  
        if($_GET['type']=='gioi-thieu') $trang='giới thiệu';
        else if($_GET['type']=='tuyen-dung') $trang='tuyển dụng';
        $data = About::all();
        return view('admin.about.index', compact('data','trang'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit(Request $request)
    {
        if($_GET['type']=='gioi-thieu') $trang='Giới thiệu';
        else if($_GET['type']=='lien-he') $trang='Liên hệ';
        else $trang= 'Bài viết';


        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }

        $data = About::select()->where('com' , $com)->get()->first();
        if(empty($data)){ 
            $data = new About;
            $data->com = $com;

            $data->user_id = Auth::user()->id;

            if($data->save()){
                $data = About::select()->where('com' , $com)->get()->first();
            }
            // Gọi view edit.blade.php hiển thị bải viết
        }
        return view('admin.about.edit',compact('data','trang'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        if($_GET['type']=='gioi-thieu') $trang='Giới thiệu';
        else if($_GET['type']=='lien-he') $trang='Liên hệ';
        else $trang= 'Bài viết';

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $data = About::select()->where('com' , $com)->get()->first();
        if(!empty($data)){
            $img = $request->file('fImages');
            $img_current = 'upload/hinhanh/'.$request->img_current;
            if(!empty($img)){
                $path_img='upload/hinhanh';
                $img_name=$img->getClientOriginalName();
                $img->move($path_img,$img_name);
                $data->photo = $img_name;
                if (File::exists($img_current)) {
                    File::delete($img_current);
                }
            }
            $data->name = $request->txtName;
            $data->alias = changeTitle($request->txtName);
            
            $data->mota = $request->txtDesc;
            $data->title = $request->txtTitle;
            $data->content = $request->txtContent;
            $data->keyword = $request->txtKeyword;
            $data->description = $request->txtDescription;
            $data->com = $request->txtCom;
            $data->status = 1;
            // if($request->status=='on'){
            //     $news->status = 1;
            // }else{
            //     $news->status = 0;
            // }
            $data->user_id   = Auth::user()->id;

            $data->save();
            return redirect('admin/about/edit?type='.$com)->with('status','Cập nhật thành công');
        }else{
            return redirect()->back()->with('status','Dữ liệu không có thực');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    
}
