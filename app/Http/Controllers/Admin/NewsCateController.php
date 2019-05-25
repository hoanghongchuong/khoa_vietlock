<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCateRequest;

use Illuminate\Http\Request;
use App\NewsCate;
use Input, File;
use Validator;

class NewsCateController extends Controller {
    
	public function getDanhSach()
    {
        if($_GET['type']=='tin-tuc') $trang='tin tức';
        else if($_GET['type']=='dich-vu') $trang='dich vụ';
        else if($_GET['type']=='bai-viet') $trang='bài viết';
        else $trang = "bài viết";
        $data = NewsCate::all();
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $data = NewsCate::select()->where('com' , $com)->get();
    	return view('admin.newscate.list', compact('data','trang'));
    }
    public function getAdd()
    {
        if($_GET['type']=='tin-tuc') $trang='tin tức';
        else if($_GET['type']=='dich-vu') $trang='dich vụ';
        else if($_GET['type']=='bai-viet') $trang='bài viết';
        else $trang = "bài viết";

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $parent = NewsCate::select('id','name','parent_id')->where('com' , $com)->get()->toArray();
    	return view('admin.newscate.add', compact('parent','trang'));
    }
    public function postAdd(Request $request)
    {
        $com= $request->txtCom;
    	$cate = new NewsCate;

        $img = $request->file('fImages');
        $path_img='upload/news';
        $img_name='';
        if(!empty($img)){
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
        }

        $img2 = $request->file('fImagesBg');
        $path_img2='upload/news';
        $img_name2='';
        if(!empty($img2)){
            $img_name2=$img2->getClientOriginalName();
            $img2->move($path_img2,$img_name2);
        }

        $cate->photo = $img_name;
        $cate->background = $img_name2;
        $cate->parent_id = $request->txtNewsCate;
        $cate->name = $request->txtName;
        $cate->alias = changeTitle($request->txtName);
        $cate->mota = $request->txtDesc;
        $cate->keyword = $request->txtKeyword;
        $cate->description = $request->txtDescription;
        $cate->stt = $request->stt;
        $cate->com = $com;

        if($request->status=='on'){
            $cate->status = 1;
        }else{
            $cate->status = 0;
        }
        $cate->save();
        return redirect('backend/newscate?type='.$com)->with('status','Thêm mới thành công !');
    }
    public function getEdit(Request $request)
    {
        if($_GET['type']=='tin-tuc') $trang='tin tức';
        else if($_GET['type']=='dich-vu') $trang='dich vụ';
        else if($_GET['type']=='bai-viet') $trang='bài viết';
        else $trang = "bài viết";

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $id= $request->get('id');
        //Tìm article thông qua mã id tương ứng
        $data = NewsCate::find($id);
        if(!empty($data)){
            if($request->get('hienthi')>0){
                if($data->status == 1){
                    $data->status = 0; 
                }else{
                    $data->status = 1; 
                }
                $data->update();
                return redirect('backend/newscate?type='.$com)->with('status','Cập nhật thành công !');
            }
            if($request->get('delete_bg')>0){
                $background='upload/news/'.$request->get('delete_bg');
                File::delete($background);
                $data->background='';
                $data->update();
                return redirect('backend/news?edit&id='.$id.'&type='.$com)->with('status','Xóa backgound thành công !');
            }
            $parent = NewsCate::orderBy('stt', 'asc')->where('com' , $com)->get()->toArray();
           // Gọi view edit.blade.php hiển thị bải viết
            return view('admin.newscate.edit',compact('data','parent','id','trang'));
        }else{
            $data = NewsCate::all();
            //return redirect()->route('admin.newscate.index')->with('status','Dữ liệu không có thực');
            return redirect('backend/newscate?type='.$com)->with('status','Dữ liệu không có thực !');
        }
    }

    public function update(Request $request)
    {
        $this->validate($request,
            ["txtName" => "required"],
            ["txtName.required" => "Bạn chưa nhập tên danh mục"]
        );
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $id=$request->get('id');
        $news_cate = NewsCate::find($id);
        if(!empty($news_cate)){
            $img = $request->file('fImages');
            $img_current = 'upload/news/'.$request->img_current;
            if(!empty($img)){
                $path_img='upload/news';
                $img_name=time().'_'.$img->getClientOriginalName();
                $img->move($path_img,$img_name);
                $news_cate->photo = $img_name;
                if (File::exists($img_current)) {
                    File::delete($img_current);
                }
            }

            $img2 = $request->file('fImagesBg');
            $img_current2 = 'upload/news/'.$request->img_current2;
            if(!empty($img2)){
                $path_img2='upload/news';
                $img_name2=time().'_'.$img2->getClientOriginalName();
                $img2->move($path_img2,$img_name2);
                $news_cate->background = $img_name2;
                if (File::exists($img_current2)) {
                    File::delete($img_current2);
                }
            }

            if($request->txtNewsCate!= $id && $request->txtNewsCate>0){
                $news_cate->parent_id = $request->txtNewsCate;
            }else{
                $news_cate->parent_id = 0;
            }
            $news_cate->name = $request->txtName;
            $news_cate->alias = changeTitle($request->txtName);
            $news_cate->mota = $request->txtDesc;
            $news_cate->title = $request->txtTitle;
            $news_cate->keyword = $request->txtKeyword;
            $news_cate->description = $request->txtDescription;
            $news_cate->stt = $request->stt;
            $news_cate->com = $request->txtCom;
            if($request->status=='on'){
                $news_cate->status = 1;
            }else{
                $news_cate->status = 0;
            }

            $news_cate->save();

            return redirect('backend/newscate/edit?id='.$id.'&type='.$com)->with('status','Cập nhật thành công');
        }else{
            return redirect()->back()->with('status','Dữ liệu không có thực');
        }
    }
    public function getDelete($id)
    {
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $product = NewsCate::findOrFail($id);
        $product->delete();
        return redirect('backend/newscate?type='.$com)->with('status','Xóa thành công');
    }
    public function getDeleteList($id){
        if($_GET['type']=='tin-tuc') $trang='tin tức';
        else if($_GET['type']=='dich-vu') $trang='dich vụ';
        else if($_GET['type']=='bai-viet') $trang='bài viết';
        else $trang = "bài viết";
        
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $listid = explode(",",$id);
        foreach($listid as $listid_item){
            $product = NewsCate::findOrFail($listid_item);
            $product->delete();
        }
        return redirect('backend/newscate?type='.$com)->with('status','Xóa thành công');
    }
}
