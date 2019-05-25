<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;

use Illuminate\Http\Request;
use App\Menu;
use Input, File;
use Validator;



class MenuController extends Controller {
    
	public function getDanhSach()
    {
        if($_GET['type']=='menu-top') $trang='menu top';
        else if($_GET['type']=='dich-vu') $trang='dich vụ';
        else if($_GET['type']=='bai-viet') $trang='dịch vụ & hỗ trợ';
        else $trang = "bài viết";
        $data = Menu::all();
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $data = Menu::select()->where('com' , $com)->orderBy('stt','asc')->get();
    	return view('admin.menu.list', compact('data','trang'));
    }
    public function getAdd()
    {
        if($_GET['type']=='menu-top') $trang='menu top';
        else if($_GET['type']=='dich-vu') $trang='dich vụ';
        else if($_GET['type']=='bai-viet') $trang='dịch vụ & hỗ trợ';
        else $trang = "bài viết";

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $parent = Menu::select('id','name','parent_id')->where('com' , $com)->get()->toArray();
    	return view('admin.menu.add', compact('parent','trang'));
    }
    public function postAdd(MenuRequest $request)
    {
        $com= $request->txtCom;
    	$cate = new Menu;
        $cate->parent_id = $request->txtmenu;
        $cate->name = $request->txtName;
        $cate->alias = $request->txtAlias;
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
        return redirect('backend/menu?type='.$com)->with('status','Thêm mới thành công !');
    }
    public function getEdit(Request $request)
    {
        if($_GET['type']=='menu-top') $trang='menu top';
        else if($_GET['type']=='dich-vu') $trang='dich vụ';
        else if($_GET['type']=='bai-viet') $trang='dịch vụ & hỗ trợ';
        else $trang = "bài viết";

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $id= $request->get('id');
        //Tìm article thông qua mã id tương ứng
        $data = Menu::find($id);
        if(!empty($data)){
            if($request->get('hienthi')>0){
                if($data->status == 1){
                    $data->status = 0; 
                }else{
                    $data->status = 1; 
                }
                $data->update();
                return redirect('backend/menu?type='.$com)->with('status','Cập nhật thành công !');
            }
            
            $parent = Menu::orderBy('stt', 'asc')->where('com' , $com)->get()->toArray();
           // Gọi view edit.blade.php hiển thị bải viết
            return view('admin.menu.edit',compact('data','parent','id','trang'));
        }else{
            $data = Menu::all();
            //return redirect()->route('admin.menu.index')->with('status','Dữ liệu không có thực');
            return redirect('backend/menu?type='.$com)->with('status','Dữ liệu không có thực !');
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
        $news_cate = Menu::find($id);
        if(!empty($news_cate)){
            if($request->txtmenu!= $id && $request->txtmenu>0){
                $news_cate->parent_id = $request->txtmenu;
            }else{
                $news_cate->parent_id = 0;
            }
            $news_cate->name = $request->txtName;
            $news_cate->alias = $request->txtAlias;
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

            return redirect('backend/menu/edit?id='.$id.'&type='.$com)->with('status','Cập nhật thành công');
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
        $product = Menu::findOrFail($id);
        $product->delete();
        return redirect('backend/menu?type='.$com)->with('status','Xóa thành công');
    }
    public function getDeleteList($id){
        if($_GET['type']=='tin-tuc') $trang='tin tức';
        else if($_GET['type']=='dich-vu') $trang='dich vụ';
        else if($_GET['type']=='bai-viet') $trang='dịch vụ & hỗ trợ';
        else $trang = "bài viết";
        
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $listid = explode(",",$id);
        foreach($listid as $listid_item){
            $product = Menu::findOrFail($listid_item);
            $product->delete();
        }
        return redirect('backend/menu?type='.$com)->with('status','Xóa thành công');
    }
}
