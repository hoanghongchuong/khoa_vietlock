<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use Input, File;
use Validator,Auth;

class SliderController extends Controller
{
    public function getList()
    {  
        if($_GET['type']=='slider') $trang='slider';
        else if($_GET['type']=='doi-tac') $trang='đối tác';
        else if($_GET['type']=='cam-nhan') $trang='cảm nhận khách hàng';
        else if($_GET['type']=='chuyen-muc') $trang='banner chuyên mục';
        else if($_GET['type']=='gioi-thieu') $trang='slider';
        else $trang ='hình ảnh';
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $data = Slider::select()->where('com' , $com)->get();
        return view('admin.slider.list', compact('data','trang'));
    }
    public function getAdd()
    {
        if($_GET['type']=='slider') $trang='slider';
        else if($_GET['type']=='doi-tac') $trang='đối tác';
        else if($_GET['type']=='cam-nhan') $trang='cảm nhận khách hàng';
        else if($_GET['type']=='chuyen-muc') $trang='banner chuyên mục';
        else if($_GET['type']=='gioi-thieu') $trang='slider';
        else $trang ='hình ảnh';

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $data = slider::select()->where('com' , $com)->get();
        return view('admin.slider.add', compact('data','trang'));
    }
    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                "txtName" => "required",
                "fImages" => "nullable|image|max:2048",
                "fImages" => "required"
            ],
            [
                "txtName.required" => "Bạn chưa nhập tên slider",
                "fImages.max" => "Dung lượng ảnh tối đa 2MB",
                "fImages.required" => "Chưa chọn ảnh"
            ]
        );
        $com= $request->txtCom;
        $img = $request->file('fImages');
        $path_img='upload/hinhanh';
        $img_name='';
        if(!empty($img)){
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
        }
        $img2 = $request->file('fImages2');
        $path_img2='upload/hinhanh';
        $img_name2='';
        if(!empty($img2)){
            $img_name2=time().'_'.$img2->getClientOriginalName();
            $img2->move($path_img2,$img_name2);
        }

        $img3 = $request->file('fImages3');       
        $img_name3='';
        if(!empty($img3)){
            $img_name3=time().'_'.$img3->getClientOriginalName();
            $img3->move($path_img,$img_name3);
        }

        $news = new Slider;
        
        $news->name = $request->txtName;
        $news->mota = $request->txtDesc;
        $news->link = $request->txtLink;
        $news->content = $request->txtContent;
        $news->photo = $img_name;
        $news->photo1 = $img_name2;
        $news->photo2 = $img_name3;

        $news->com = $com;
        $news->stt = intval($request->stt);
        if($request->status=='on'){
            $news->status = 1;
        }else{
            $news->status = 0;
        }
        $news->user_id       = Auth::user()->id;
        $news->save();
        return redirect('backend/slider?type='.$com)->with('status','Thêm mới thành công !');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit(Request $request)
    {
        if($_GET['type']=='slider') $trang='slider';
        else if($_GET['type']=='doi-tac') $trang='đối tác';
        else if($_GET['type']=='cam-nhan') $trang='cảm nhận khách hàng';
        else if($_GET['type']=='chuyen-muc') $trang='banner chuyên mục';
        else if($_GET['type']=='chinh-sach') $trang='chính sách';
        else $trang ='hình ảnh';

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $id= $request->get('id');
        //Tìm article thông qua mã id tương ứng
        $data = Slider::find($id);
        if(!empty($data)){
            if($request->get('hienthi')>0){
                if($data->status == 1){
                    $data->status = 0; 
                }else{
                    $data->status = 1; 
                }
                $data->update();
                return redirect('backend/slider?type='.$com)->with('status','Cập nhật thành công !');
            }
            if($request->get('noibat')>0){
                if($data->noibat == 1){
                    $data->noibat = 0; 
                }else{
                    $data->noibat = 1; 
                }
                $data->update();
                return redirect('backend/slider?type='.$com)->with('status','Cập nhật thành công !');
            }
            $news = slider::select('stt')->orderBy('id','asc')->get()->toArray();
            // Gọi view edit.blade.php hiển thị bải viết
            return view('admin.slider.edit',compact('data','news','id','trang'));
        }else{
            return redirect('backend/slider?type='.$com)->with('status','Dữ liệu không có thực !');
        }
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $this->validate($request,
            [
                "txtName" => "required",
                "fImages" => "nullable|image|max:2048",
                "fImages" => "required"
            ],
            [
                "txtName.required" => "Bạn chưa nhập tên slider",
                "fImages.max" => "Dung lượng ảnh tối đa 2MB",
                "fImages.required" => "Chưa chọn ảnh"
            ]
        );
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $id= $request->get('id');
        $news = Slider::findOrFail($id);
        //$news = slider::select()->where('id' , $id)->where('com' , $com)->get();
        if(!empty($news)){
            

            $img = $request->file('fImages');
            $img_current = 'upload/hinhanh/'.$request->img_current;
            if(!empty($img)){
                $path_img='upload/hinhanh';
                $img_name=time().'_'.$img->getClientOriginalName();
                $img->move($path_img,$img_name);
                $news->photo = $img_name;
                if (File::exists($img_current)) {
                    File::delete($img_current);
                }
            }
            $img2 = $request->file('fImages2');
            $img_current2 = 'upload/hinhanh/'.$request->img_current2;
            if(!empty($img2)){
                $path_img2='upload/hinhanh';
                $img_name2=time().'_'.$img2->getClientOriginalName();
                $img2->move($path_img2,$img_name2);
                $news->photo1 = $img_name2;
                if (File::exists($img_current2)) {
                    File::delete($img_current2);
                }
            }

            $img3 = $request->file('fImages3');
            $img_current3 = 'upload/hinhanh/'.$request->img_current3;
            if(!empty($img3)){
                $path_img3='upload/hinhanh';
                $img_name3=time().'_'.$img3->getClientOriginalName();
                $img3->move($path_img3,$img_name3);
                $news->photo2= $img_name3;
                if (File::exists($img_current3)) {
                    File::delete($img_current3);
                }
            }
            $news->name = $request->txtName;
            
            $news->link = $request->txtLink;
            $news->mota = $request->txtDesc;
            $news->content = $request->txtContent;
            $news->com = $request->txtCom;
            $news->stt = intval($request->stt);
            if($request->status=='on'){
                $news->status = 1;
            }else{
                $news->status = 0;
            }
            $news->user_id       = Auth::user()->id;

            $news->save();
            return redirect('backend/slider/edit?id='.$id.'&type='.$com)->with('status','Cập nhật thành công');
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
    public function getDelete($id)
    {
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $news = slider::findOrFail($id);
        $news->delete();
        File::delete('upload/hinhanh/'.$news->photo);
        return redirect('backend/slider?type='.$com)->with('status','Xóa thành công');
    }
    public function getDeleteList($id){
        if($_GET['type']=='slider') $trang='slider';
        else if($_GET['type']=='doi-tac') $trang='đối tác';
        else if($_GET['type']=='cam-nhan') $trang='cảm nhận khách hàng';
        else if($_GET['type']=='chuyen-muc') $trang='banner chuyên mục';
        else $trang ='hình ảnh';

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $listid = explode(",",$id);
        foreach($listid as $listid_item){
            $news = slider::findOrFail($listid_item);
            $news->delete();
            File::delete('upload/hinhanh/'.$news->photo);
        }
        return redirect('backend/slider?type='.$com)->with('status','Xóa thành công');
    }
    
}
