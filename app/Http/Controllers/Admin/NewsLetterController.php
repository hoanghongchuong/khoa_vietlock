<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\NewsLetter;
use Input, File,DB,Mail;
use Validator,Auth,Request;

class NewsLetterController extends Controller
{
    public function getList()
    {  
        if($_GET['type']=='newsletter') $trang='newsletter';
        else if($_GET['type']=='doi-tac') $trang='đối tác';
        else if($_GET['type']=='cam-nhan') $trang='cảm nhận khách hàng';
        else if($_GET['type']=='chuyen-muc') $trang='banner chuyên mục';
        else $trang ='hình ảnh';
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $data = NewsLetter::select()->where('com' , $com)->orderBy('created_at' , 'desc')->get();
        return view('admin.newsletter.list', compact('data','trang'));
    }
    public function getAdd()
    {
        if($_GET['type']=='newsletter') $trang='newsletter';
        else if($_GET['type']=='doi-tac') $trang='đối tác';
        else if($_GET['type']=='cam-nhan') $trang='cảm nhận khách hàng';
        else if($_GET['type']=='chuyen-muc') $trang='banner chuyên mục';
        else $trang ='hình ảnh';

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $data = NewsLetter::select()->where('com' , $com)->get();
        return view('admin.newsletter.add', compact('data','trang'));
    }
    public function postAdd(Request $request)
    {
        $this->validate($request,
            ["txtEmail" => "required"],
            ["txtEmail.required" => "Bạn chưa nhập địa chỉ email"]
        );
        $com= Request::input('txtCom');
        $img = Request::file('fImages');
        $path_img='upload/hinhanh';
        $img_name='';
        if(!empty($img)){
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
        }

        $news = new Newsletter;
        $news->email = Request::input('txtEmail');
        $news->name = Request::input('txtName');
        $news->mota = Request::input('txtDesc');
        $news->link = Request::input('txtLink');
        $news->photo = $img_name;

        $news->com = $com;
        $news->stt = intval(Request::input('stt'));
        if(Request::input('status') =='on'){
            $news->status = 1;
        }else{
            $news->status = 0;
        }
        $news->user_id       = Auth::user()->id;
        $news->save();
        return redirect('backend/newsletter?type='.$com)->with('status','Thêm mới thành công !');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit(Request $request)
    {
        if($_GET['type']=='newsletter') $trang='newsletter';
        else if($_GET['type']=='doi-tac') $trang='đối tác';
        else if($_GET['type']=='cam-nhan') $trang='cảm nhận khách hàng';
        else if($_GET['type']=='chuyen-muc') $trang='banner chuyên mục';
        else $trang ='hình ảnh';

        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $id= Request::get('id');
        //Tìm article thông qua mã id tương ứng
        $data = NewsLetter::find($id);
        if(!empty($data)){
            if(Request::get('hienthi')>0){
                if($data->status == 1){
                    $data->status = 0; 
                }else{
                    $data->status = 1; 
                }
                $data->update();
                return redirect('backend/newsletter?type='.$com)->with('status','Cập nhật thành công !');
            }
            if(Request::get('noibat')>0){
                if($data->noibat == 1){
                    $data->noibat = 0; 
                }else{
                    $data->noibat = 1; 
                }
                $data->update();
                return redirect('backend/newsletter?type='.$com)->with('status','Cập nhật thành công !');
            }
            $news = NewsLetter::select('stt')->orderBy('id','asc')->get()->toArray();
            // Gọi view edit.blade.php hiển thị bải viết
            return view('admin.newsletter.edit',compact('data','news','id','trang'));
        }else{
            return redirect('backend/newsletter?type='.$com)->with('status','Dữ liệu không có thực !');
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
            ["txtEmail" => "required"],
            ["txtEmail.required" => "Bạn chưa nhập địa chỉ email"]
        );
        if(!empty($_GET['type'])){
            $com=$_GET['type'];
        }else{
            $com='';
        }
        $id= Request::get('id');
        $news = NewsLetter::findOrFail($id);
        //$news = NewsLetter::select()->where('id' , $id)->where('com' , $com)->get();
        if(!empty($news)){
            

            $img = Request::file('fImages');
            $img_current = 'upload/hinhanh/'.Request::input('img_current');
            if(!empty($img)){
                $path_img='upload/hinhanh';
                $img_name=time().'_'.$img->getClientOriginalName();
                $img->move($path_img,$img_name);
                $news->photo = $img_name;
                if (File::exists($img_current)) {
                    File::delete($img_current);
                }
            }
            $news->name = Request::input('txtName');
            $news->email = Request::input('txtEmail');
            $news->link = Request::input('txtLink');
            $news->mota = Request::input('txtDesc');
            $news->com = Request::input('txtCom');
            if(Request::input('status')=='on'){
                $news->status = 1;
            }else{
                $news->status = 0;
            }
            $news->user_id       = Auth::user()->id;

            $news->save();
            return redirect('backend/newsletter?type='.$com)->with('status','Cập nhật thành công');
        }else{
            return redirect()->back()->with('status','Dữ liệu không có thực');
        }
    }
    public function postNewsLetter(Request $request)
    {
        $setting = DB::table('setting')->select()->where('id',1)->get()->first();
        if(!empty(Request::input('txtCom'))){
            $com=Request::input('txtCom');
        }else{
            $com='';
        }
        $data = [
            'title'     => Request::input('txtTitle'),          
            'content'  => Request::input('txtContent'),
        ];
        
        Mail::send('admin.newsletter.content', $data, function($msg){
            $msg->from('emailserver.send@gmail.com', 'Newsletter');

            if (!empty(Request::input('inpFile'))) {
                foreach(Request::input('inpFile') as $file) {
                    if (isset($file)) {
                        $fname = time().$file->getClientOriginalName();
                        $file->move('resources/upload/hinhanh/',$fname);

                        foreach (Request::input('chon') as $listid) {
                            if (isset($listid)) {
                                $member = DB::table('newsletter')->select()->where('id', $listid)->get();
                                foreach ($member as $value) {
                                    $msg->to($value->email)->subject('Thông tin gửi thử website');
                                }
                            }
                        }

                        $msg->attach('resources/upload/hinhanh/'.$fname, ['as' => $fname]);
                    }
                }
            }else{
                foreach (Request::input('chon') as $lid) {
                    if (isset($lid)) {
                        $mem = DB::table('newsletter')->select()->where('id', $lid)->get();
                        foreach ($mem as $val) {
                            $msg->to($val->email)->subject('Thông tin gửi thử website');
                        }
                    }
                }
            }
        });
        return redirect('backend/newsletter?type='.$com)->with('status','Gửi thư thành công');
        
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
        $news = NewsLetter::findOrFail($id);
        $news->delete();
        File::delete('upload/hinhanh/'.$news->photo);
        return redirect('backend/newsletter?type='.$com)->with('status','Xóa thành công');
    }
    public function getDeleteList($id){
        if($_GET['type']=='newsletter') $trang='newsletter';
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
            $news = NewsLetter::findOrFail($listid_item);
            $news->delete();
            File::delete('upload/hinhanh/'.$news->photo);
        }
        return redirect('backend/newsletter?type='.$com)->with('status','Xóa thành công');
    }
    
}
