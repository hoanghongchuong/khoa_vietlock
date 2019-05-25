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
use DB;
class AboutController extends Controller
{
    public function index()
    {  
        if($_GET['type']=='gioi-thieu') $trang='giới thiệu';
        else if($_GET['type']=='tuyen-dung') $trang='tuyển dụng';
        else if($_GET['type']=='chung-chi') $trang='Chứng chỉ kĩ thuật';
        $data = About::all();
        return view('admin.about.index', compact('data','trang'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function getList(Request $request){
        if($_GET['type']=='gioi-thieu') $trang='giới thiệu';
        else if($_GET['type']=='chung-chi') $trang='Chứng chỉ kĩ thuật';
        else $trang = "bài viết";
        // $data = About::get();

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        // dd($com);
        $data = About::select()->where('com',$com)->get();
        // dd($data);
        return view('admin.about.list', compact('data','trang'));
        
    }
    public function getAdd(){
        if($_GET['type']=='gioi-thieu') $trang='giới thiệu';
        else if($_GET['type']=='chung-chi') $trang='Chứng chỉ kĩ thuật';
        else $trang = "bài viết";
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $data = About::select()->where('com' , $com)->get();
        return view('admin.about.add', compact('data','trang'));
    }
    public function postAdd(Request $request){
        $com = $request->txtCom;
        $img_name='';
        if(!empty($img)){
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
        }
        $about = new About;
        $about->name = $request->txtName;
        if($request->txtAlias){
            $about->alias = $request->txtAlias;
        }else{
            $about->alias = changeTitle($request->txtName);
        }
        $about->photo = $img_name;
        $about->mota = $request->txtDesc;
        $about->content = $request->txtContent;
        $about->com= $request->txtCom;
        $about->title = $request->txtTitle;
        $about->keyword = $request->txtKeyword;
        $about->description = $request->txtDescription;
        $about->save();
        return redirect('backend/about?type='.$com);
    }
    public function getEdit(Request $request)
    {
        $id= $request->get('id');    
        if($_GET['type']=='gioi-thieu') $trang='Giới thiệu';
        else if($_GET['type']=='chung-chi') $trang='Chứng chỉ kĩ thuật';
        else if($_GET['type']=='bang-gia') $trang='Bảng giá';
        else $trang= 'Bài viết';


        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        
        // $data = About::select()->where('com',$com)->where('id',$id)->first();
        $data = DB::table('about')->where('com',$com)->first();
        // dd($data);
        if(empty($data)){ 
            $data = new About;
            $data->com = $com;
            $data->content = $request->txtContent;
            $data->user_id = Auth::user()->id;

            if($data->save()){
                $data = About::select()->where('com' , $com)->get()->first();
            }
            
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
        else if($_GET['type']=='chung-chi') $trang='Chứng chỉ kĩ thuật';
        else if($_GET['type']=='bang-gia') $trang='Bảng giá';
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
                $img_name=time().'_'.$img->getClientOriginalName();
                $img->move($path_img,$img_name);
                $data->photo = $img_name;
                if (File::exists($img_current)) {
                    File::delete($img_current);
                }
            }
            $img_bg = $request->file('fImages_bg');
            $img_current_bg = 'upload/hinhanh/'.$request->img_current_bg;
            if(!empty($img_bg)){
                $path_img='upload/hinhanh';
                $img_name_bg=time().'_'.$img_bg->getClientOriginalName();
                $img_bg->move($path_img,$img_name_bg);
                $data->background = $img_name_bg;
                if (File::exists($img_current_bg)) {
                    File::delete($img_current_bg);
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
            // $data->status = 1;
            if($request->status=='on'){
                $data->status = 1;
            }else{
                $data->status = 0;
            }
            $data->user_id   = Auth::user()->id;
            // dd($data);    
            $data->save();
            return redirect('backend/about/edit?type='.$com)->with('status','Cập nhật thành công');
        }else{
            return redirect()->back()->with('status','Dữ liệu không có thực');
        }
    }

    public function getDelete($id){
       if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $about = About::findOrFail($id);
        $about->delete();
        File::delete('upload/about/'.$about->photo);
        return redirect('backend/about/edit?type='.$com)->with('status','Xóa thành công');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    
}
