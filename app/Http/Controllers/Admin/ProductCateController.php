<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCateRequest;

use Illuminate\Http\Request;
use App\ProductCate;
use Input, File;
use Validator;

class ProductCateController extends Controller {

	public function getDanhSach()
    {
        if($_GET['type']=='san-pham-mau') $trang='Sản phẩm mẫu';
        else if($_GET['type']=='da-lam') $trang='Đã làm';
        
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $data = ProductCate::where('com',$com)->orderBy('id','desc')->get();
        return view('admin.productcate.list', compact('data'));
    }
    public function getAdd()
    {
        if($_GET['type']=='san-pham-mau') $trang='Sản phẩm mẫu';
        else if($_GET['type']=='da-lam') $trang='Đã làm';
        
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $parent = ProductCate::select('id','name','parent_id')->where('com',$com)->get()->toArray();
        return view('admin.productcate.add', compact('parent'));
    }
    public function postAdd(ProductCateRequest $request)
    {
        $com = $request->txtCom;
        $img = $request->file('fImages');
        $path_img='upload/product';
        $img_name='';
        if(!empty($img)){
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
        }
        $icon_img = $request->file('icon_fImages');
        $icon_img_name='';
        if(!empty($icon_img)){
            $icon_img_name=time().'_'.$icon_img->getClientOriginalName();
            $icon_img->move($path_img,$icon_img_name);
        }
        $bg_img = $request->file('bg_fImages');
        $bg_img_name='';
        if(!empty($bg_img)){
            $bg_img_name=time().'_'.$bg_img->getClientOriginalName();
            $bg_img->move($path_img,$bg_img_name);
        }
        $cate = new ProductCate;

        $cate->photo = $img_name;
        $cate->icon = $icon_img_name;
        $cate->background = $bg_img_name;
        if($request->txtProductCate){
            $cate->parent_id = $request->txtProductCate;
        }
        $cate->name = $request->txtName;
        $cate->alias = changeTitle($request->txtName);
        
        $cate->com  = $com;
        $cate->title = $request->txtTitle;
        $cate->keyword = $request->txtKeyword;
        $cate->description = $request->description;
        $cate->stt = $request->stt;
        // if($request->noibat=='on'){
        //     $product_cate->noibat = 1;
        // }else{
        //     $product_cate->noibat = 0;
        // }
        if($request->status=='on'){
            $cate->status = 1;
        }else{
            // $cate->status = 0;
        }
        $cate->show_sidebar = $request->show_sidebar ? 1 : 0;
        $cate->show_menu = $request->show_menu ? 1 : 0;
        // dd($cate);
        $cate->save();
        return redirect('backend/productcate?type='.$com)->with('status','Thêm mới thành công !');
    }
    public function getEdit(Request $request)
    {
        $id= $request->get('id');
        //Tìm article thông qua mã id tương ứng
        $data = ProductCate::find($id);
        if(!empty($data)){
            if($request->get('hienthi')>0){
                if($data->status == 1){
                    $data->status = 0; 
                }else{
                    $data->status = 1; 
                }
                $data->update();
                return redirect()->route('admin.productcate.index')->with('status','Cập nhật thành công !');
            }
            
            $parent = ProductCate::orderBy('stt', 'asc')->get()->toArray();
           // Gọi view edit.blade.php hiển thị bải viết
            return view('admin.productcate.edit',compact('data','parent','id'));
        }else{
            $data = ProductCate::all();
            return redirect()->route('admin.productcate.index')->with('status','Dữ liệu không có thực');
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
        $product_cate = ProductCate::find($id);
        if(!empty($product_cate)){
            $path_img='upload/product';
            $img = $request->file('fImages');
            $img_current = 'upload/product/'.$request->img_current;
            if(!empty($img)){
                // $path_img='upload/product';
                $img_name=time().'_'.$img->getClientOriginalName();
                $img->move($path_img,$img_name);
                $product_cate->photo = $img_name;
            }
            
            $icon_img = $request->file('icon_fImages');
            $icon_img_current = 'upload/product/'.$request->icon_img_current;
            if(!empty($icon_img)){
                $icon_img_name=time().'_'.$icon_img->getClientOriginalName();
                $icon_img->move($path_img,$icon_img_name);
                $product_cate->icon = $icon_img_name;
            }
            $bg_img = $request->file('bg_fImages');
            $bg_img_current = 'upload/product/'.$request->bg_img_current;
            if(!empty($bg_img)){
                $bg_img_name=time().'_'.$bg_img->getClientOriginalName();
                $bg_img->move($path_img,$bg_img_name);
                $product_cate->background = $bg_img_name;
            }


            if($request->txtProductCate!= $id && $request->txtProductCate>0){
                $product_cate->parent_id = $request->txtProductCate;
            }else{
                $product_cate->parent_id = 0;
            }
            $product_cate->name = $request->txtName;
            $product_cate->alias = changeTitle($request->txtName);
            $product_cate->title = $request->txtTitle;
            $product_cate->keyword = $request->txtKeyword;
            $product_cate->description = $request->txtDescription;
            $product_cate->mota = $request->mota;
            $product_cate->stt = $request->stt;
            if($request->noibat=='on'){
                $product_cate->noibat = 1;
            }else{
                $product_cate->noibat = 0;
            }
            if($request->status=='on'){
                $product_cate->status = 1;
            }else{
                $product_cate->status = 0;
            }
            $product_cate->show_sidebar = $request->show_sidebar ? 1 : 0;
            $product_cate->show_menu = $request->show_menu ? 1 : 0;
            // dd($product_cate);
            $product_cate->save();
            return redirect()->back()->with('status','Cập nhật thành công');
        }else{
            return redirect('backend/productcate/')->with('status','Dữ liệu không có thực');
        }
    }
    public function getDelete($id)
    {
        $product = ProductCate::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('status','Xóa thành công');
    }
    public function getDeleteList($id){
        $listid = explode(",",$id);
        foreach($listid as $listid_item){
            $product = ProductCate::findOrFail($listid_item);
            $product->delete();
            //File::delete('upload/product/'.$product->photo);
        }
        return redirect()->route('admin.productcate.index');
    }
}
