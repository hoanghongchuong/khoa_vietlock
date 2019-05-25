<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LienKet;
use Input, File;
use Validator,Auth;

class LienKetController extends Controller
{
    public function getList()
    {  
        if($_GET['type']=='slider') $trang='slider';
        else if($_GET['type']=='doi-tac') $trang='đối tác';
        else if($_GET['type']=='cam-nhan') $trang='cảm nhận khách hàng';
        else if($_GET['type']=='chuyen-muc') $trang='banner chuyên mục';
        else if($_GET['type']=='chi-nhanh') $trang='chi nhánh';
        else if($_GET['type']=='catalog') $trang='catalog';
        else $trang ='hình ảnh';
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $data = LienKet::select()->where('com' , $com)->get();
        return view('admin.lienket.list', compact('data','trang'));
    }
    public function getAdd()
    {
        if($_GET['type']=='slider') $trang='slider';
        else if($_GET['type']=='doi-tac') $trang='đối tác';
        else if($_GET['type']=='cam-nhan') $trang='cảm nhận khách hàng';
        else if($_GET['type']=='chuyen-muc') $trang='banner chuyên mục';
        else if($_GET['type']=='chi-nhanh') $trang='chi nhánh';
        else if($_GET['type']=='catalog') $trang='catalog';
        else $trang ='hình ảnh';

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $data = LienKet::select()->where('com' , $com)->get();
        return view('admin.lienket.add', compact('data','trang'));
    }
    public function postAdd(Request $request)
    {
        // $this->validate($request,
        //     ["txtName" => "required"],
        //     ["txtName.required" => "Bạn chưa nhập tên slider"]
        // );
        $this->validate($request,
            [
                'document_file' => 'max:5000'
            ],
            [
                "document_file.max" => "File vượt quá dung lượng cho phép"
            ]
        );
        if($request->hasFile('document_file')){
            $file_name = $request->file('document_file');
            $file_names = time().'_'.$file_name->getClientOriginalName();

            $fileName = changeTitle($file_names).'.'.$file_name->getClientOriginalExtension();
            // dd($fileName);
        }

        $com= $request->txtCom;
        $img = $request->file('fImages');
        $path_img='upload/hinhanh';
        $img_name='';
        if(!empty($img)){
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
        }

        $img2 = $request->file('fImages2');
        $img_name2='';
        if(!empty($img2)){
            $img_name2=time().'_'.$img2->getClientOriginalName();
            $img2->move($path_img,$img_name2);
        }

        $news = new LienKet;
        
        if(!empty($fileName)){
            $news->document = $fileName;
            $request->file('document_file')->move('upload/document/', $fileName);
        }

        $news->name = $request->txtName;
        $news->mota = $request->txtDesc;
        $news->link = $request->txtLink;
        $news->content = $request->txtContent;
        $news->photo = $img_name;
        $news->photo2 = $img_name2;

        $news->com = $com;
        $news->stt = intval($request->stt);
        if($request->status=='on'){
            $news->status = 1;
        }else{
            $news->status = 0;
        }
        $news->user_id = Auth::user()->id;
        $news->save();
        return redirect('backend/lienket?type='.$com)->with('status','Thêm mới thành công !');
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
        else if($_GET['type']=='chi-nhanh') $trang='chi nhánh';
        else if($_GET['type']=='catalog') $trang='catalog';
        else $trang ='hình ảnh';

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $id= $request->get('id');
        //Tìm article thông qua mã id tương ứng
        $data = LienKet::find($id);
        if(!empty($data)){
            if($request->get('hienthi')>0){
                if($data->status == 1){
                    $data->status = 0; 
                }else{
                    $data->status = 1; 
                }
                $data->update();
                return redirect('backend/lienket?type='.$com)->with('status','Cập nhật thành công !');
            }
            if($request->get('noibat')>0){
                if($data->noibat == 1){
                    $data->noibat = 0; 
                }else{
                    $data->noibat = 1; 
                }
                $data->update();
                return redirect('backend/lienket?type='.$com)->with('status','Cập nhật thành công !');
            }
            $news = LienKet::select('stt')->orderBy('id','asc')->get()->toArray();
            // Gọi view edit.blade.php hiển thị bải viết
            return view('admin.lienket.edit',compact('data','news','id','trang'));
        }else{
            return redirect('backend/lienket?type='.$com)->with('status','Dữ liệu không có thực !');
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

       
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $id= $request->get('id');
        $news = LienKet::findOrFail($id);
        
        //$news = LienKet::select()->where('id' , $id)->where('com' , $com)->get();
        if(!empty($news)){            
           $file_name = $file_name = $request->file('document_file');
            $file_current = 'upload/document/'.$request->file_current;
            if(!empty($file_name)){
                $path_file = 'upload/document';
                $fileName = time().'_'.$file_name->getClientOriginalName();
                $file_name->move($path_file, $fileName);
                $news->document = $fileName;
                if(File::exists($file_current)){
                    File::delete($file_current);
                }
            }
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
                $path_img='upload/hinhanh';
                $img_name2=time().'_'.$img2->getClientOriginalName();
                $img2->move($path_img,$img_name2);
                $news->photo2 = $img_name2;
                if (File::exists($img_current2)) {
                    File::delete($img_current2);
                }
            }    

            $news->name = $request->txtName;
            $news->link = $request->txtLink;
            $news->mota = $request->txtDesc;
            $news->content = $request->txtContent;
            $news->stt = intval($request->stt);
            $news->com = $request->txtCom;
            if($request->status=='on'){
                $news->status = 1;
            }else{
                $news->status = 0;
            }
            $news->user_id  = Auth::user()->id;
            
            $news->save();
            return redirect('backend/lienket/edit?id='.$id.'&type='.$com)->with('status','Cập nhật thành công');
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
        $news = LienKet::findOrFail($id);
        $news->delete();
        File::delete('upload/hinhanh/'.$news->photo);
        return redirect('backend/lienket?type='.$com)->with('status','Xóa thành công');
    }
    public function getDeleteList($id){
        if($_GET['type']=='slider') $trang='slider';
        else if($_GET['type']=='doi-tac') $trang='đối tác';
        else if($_GET['type']=='cam-nhan') $trang='cảm nhận khách hàng';
        else if($_GET['type']=='chuyen-muc') $trang='banner chuyên mục';
        else if($_GET['type']=='chi-nhanh') $trang='chi nhánh';
        else if($_GET['type']=='tieu-chi') $trang='tiêu chí';
        else $trang ='hình ảnh';

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $listid = explode(",",$id);
        foreach($listid as $listid_item){
            $news = LienKet::findOrFail($listid_item);
            $news->delete();
            File::delete('upload/hinhanh/'.$news->photo);
        }
        return redirect('backend/lienket?type='.$com)->with('status','Xóa thành công');
    }
    
}
