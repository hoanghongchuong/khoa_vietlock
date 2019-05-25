<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\NewsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\News;
use App\Images;
use App\NewsCate;
use Input, File;
use Validator;
use Auth;

class NewsController extends Controller
{
    public function getList()
    {  
        if($_GET['type']=='tin-tuc') $trang='tin tức';
        else if($_GET['type']=='dich-vu') $trang='dich vụ';
        else if($_GET['type']=='huong-dan') $trang='hướng dẫn';
        else if($_GET['type']=='ve-chung-toi') $trang='về chúng tôi';
        else if($_GET['type']=='chinh-sach') $trang='chính sách';
        else if($_GET['type']=='khong-gian') $trang='không gian';
        else if($_GET['type']=='tuyen-dung') $trang='tuyển dụng';
        else $trang = "bài viết";
        $data = NewsCate::all();
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $data = News::select()->where('com' , $com)->get();
        return view('admin.news.list', compact('data','trang'));
    }
    public function getAdd()
    {
        if($_GET['type']=='tin-tuc') $trang='tin tức';
        else if($_GET['type']=='dich-vu') $trang='dich vụ';
        else if($_GET['type']=='huong-dan') $trang='hướng dẫn';
        else if($_GET['type']=='ve-chung-toi') $trang='về chúng tôi';
        else if($_GET['type']=='chinh-sach') $trang='chính sách';
        else if($_GET['type']=='khong-gian') $trang='không gian';
        else if($_GET['type']=='tuyển dụng') $trang='tuyển dụng';
        else $trang = "bài viết";

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $data = News::select()->where('com' , $com)->get();
        $parent = NewsCate::select('id','name','parent_id')->where('com' , $com)->get();
        return view('admin.news.add', compact('data','parent','trang'));
    }
    public function postAdd(NewsRequest $request)
    {

        $com= $request->txtCom;
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

        $news = new News;
        
        $news->name = $request->txtName;
        if($request->txtNewsCate>0){
            $news->cate_id = $request->txtNewsCate;
        }else{
            $news->cate_id = 0;
        }

        if($request->txtAlias){
            $news->alias = $request->txtAlias;
        }else{
            $news->alias = changeTitle($request->txtName);
        }
        $news->mota = $request->txtDesc;
        $news->photo = $img_name;
        $news->background = $img_name2;
        $news->title = $request->txtTitle;
        $news->content = $request->txtContent;
        $news->keyword = $request->txtKeyword;
        $news->description = $request->txtDescription;
        $news->com = $com;
        
        $news->stt = intval($request->stt);
        if($request->noibat=='on'){
            $news->noibat = 1;
        }else{
            $news->noibat = 0;
        }

        if($request->home=='on'){
            $news->home = 1;
        }else{
            $news->home = 0;
        }
        if($request->status=='on'){
            $news->status = 1;
        }else{
            $news->status = 0;
        }
        $news->user_id = Auth::user()->id;
        $news->save();
        $news_id = $news->id;
        if ($request->hasFile('detailImg')) {
            foreach ($request->file('detailImg') as $file) {
                $news_img = new Images();
                if (isset($file)) {
                    $news_img->photo = time().'_'.$file->getClientOriginalName();
                    $news_img->news_id = $news_id;
                    $file->move('upload/albumnews/',time().'_'.$file->getClientOriginalName());
                    $news_img->save();
                }
            }
        }
        return redirect('backend/news?type='.$com)->with('status','Thêm mới thành công !');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit(Request $request)
    {
        if($_GET['type']=='tin-tuc') $trang='tin tức';
        else if($_GET['type']=='dich-vu') $trang='dich vụ';
        else if($_GET['type']=='du-an-seo') $trang='Dự án seo';
        else if($_GET['type']=='du-an-marketing') $trang='Dự án marketing';
        else if($_GET['type']=='du-an-content') $trang='Dự án content';
        else if($_GET['type']=='du-an-facebook') $trang='Dự án facebook ads';
        
        else $trang = "bài viết";

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $id= $request->get('id');
        //Tìm article thông qua mã id tương ứng
        $data = News::find($id);
        if(!empty($data)){
            if($request->get('hienthi')>0){
                if($data->status == 1){
                    $data->status = 0; 
                }else{
                    $data->status = 1; 
                }
                $data->update();
                return redirect('backend/news?type='.$com)->with('status','Cập nhật thành công !');
            }
            if($request->get('noibat')>0){
                if($data->noibat == 1){
                    $data->noibat = 0; 
                }else{
                    $data->noibat = 1; 
                }
                $data->update();
                return redirect('backend/news?type='.$com)->with('status','Cập nhật thành công !');
            }
            if($request->get('delete_bg')>0){
                $background='upload/news/'.$request->get('delete_bg');
                File::delete($background);
                $data->background='';
                $data->update();
                return redirect('backend/news?edit&id='.$id.'&type='.$com)->with('status','Xóa backgound thành công !');
            }
            $parent = NewsCate::orderBy('stt', 'asc')->where('com' , $com)->get()->toArray();
            $news = News::select('stt')->orderBy('id','asc')->get()->toArray();
            $news_img = News::find($id)->images;
            return view('admin.news.edit',compact('data','news','id','parent','trang','news_img'));
        }else{
            $data = News::all();
            $parent = NewsCate::orderBy('stt', 'asc')->get()->toArray();
            return redirect('backend/news?type='.$com)->with('status','Dữ liệu không có thực !');
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
            ["txtName" => "required"],
            ["txtName.required" => "Bạn chưa nhập tên bài viết"]
        );
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $id= $request->get('id');
        if($id){
            $news = News::findOrFail($id);

            $img = $request->file('fImages');
            $img_current = 'upload/news/'.$request->img_current;
            if(!empty($img)){
                $path_img='upload/news';
                $img_name=time().'_'.$img->getClientOriginalName();
                $img->move($path_img,$img_name);
                $news->photo = $img_name;
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
                $news->background = $img_name2;
                if (File::exists($img_current2)) {
                    File::delete($img_current2);
                }
            }

            if ($request->hasFile('detailImg')) {
                foreach ($request->file('detailImg') as $file) {
                    $news_img = new Images();
                    if (isset($file)) {
                        $news_img->photo = time().'_'.$file->getClientOriginalName();
                        $news_img->news_id = $id;
                        $file->move('upload/albumnews/',time().'_'.$file->getClientOriginalName());
                        $news_img->save();
                    }
                }
            }

            $news->name = $request->txtName;
            if($request->txtNewsCate>0){
                $news->cate_id = $request->txtNewsCate;
            }else{
                $news->cate_id = 0;
            }
            if($request->txtAlias){
                $news->alias = $request->txtAlias;
            }else{
                $news->alias = changeTitle($request->txtName);
            }
            $news->noibat = $request->hotnews;
            $news->mota = $request->txtDesc;
            $news->title = $request->txtTitle;
            $news->content = $request->txtContent;
            $news->keyword = $request->txtKeyword;
            $news->description = $request->txtDescription;
            $news->com = $request->txtCom;
            $news->stt = intval($request->stt);
            if($request->noibat=='on'){
                $news->noibat = 1;
            }else{
                $news->noibat = 0;
            }
            if($request->home=='on'){
                $news->home = 1;
            }else{
                $news->home = 0;
            }
            if($request->status=='on'){
                $news->status = 1;
            }else{
                $news->status = 0;
            }
            $news->user_id       = Auth::user()->id;

            $news->save();
            return redirect('backend/news/edit?id='.$id.'&type='.$com)->with('status','Cập nhật thành công');
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
        $news = News::findOrFail($id);
        $news->delete();
        File::delete('upload/news/'.$news->photo);
        return redirect('backend/news?type='.$com)->with('status','Xóa thành công');
    }
    public function getDeleteList($id){
        if($_GET['type']=='tin-tuc') $trang='tin tức';
        else if($_GET['type']=='dich-vu') $trang='dich vụ';
        else if($_GET['type']=='huong-dan') $trang='hướng dẫn';
        else if($_GET['type']=='ve-chung-toi') $trang='về chúng tôi';
        else if($_GET['type']=='chinh-sach') $trang='chính sách';
        else if($_GET['type']=='khong-gian') $trang='không gian';
        else if($_GET['type']=='tuyen-dung') $trang='tuyển dụng';
        else $trang = "bài viết";
        
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $listid = explode(",",$id);
        foreach($listid as $listid_item){
            $news = News::findOrFail($listid_item);
            $news->delete();
            File::delete('upload/news/'.$news->photo);
        }
        return redirect('backend/news?type='.$com)->with('status','Xóa thành công');
    }

    public function getDelImg(Request $request,$id){
        if ($request->ajax()) {      
            $idImg = (int)$request->get('idImg');
            $image_detail = Images::find($idImg);
            if (!empty($image_detail)) {
                $img = 'upload/albumnews/'.$image_detail->photo;
                if (File::exists($img)) {
                    File::delete($img);
                }
                $image_detail->delete();
            }
            return 'OK';
        }
    }
    
   
}
