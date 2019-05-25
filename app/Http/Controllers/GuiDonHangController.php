<?php 
namespace App\Http\Controllers;

use DB,Cache,Mail, Request;

class GuiDonHangController extends Controller {
	protected $setting = NULL;

	public function __construct()
	{
		
    	$setting = DB::table('setting')->select()->where('id',1)->get()->first();
        Cache::forever('setting', $setting);
	}
    public function postGuidonhang(Request $request)
	{

		
		$data = [
			'hoten' 	=> Request::input('hoten'), 
			'diachi' 	=> Request::input('diachi'),
			'dienthoai' => Request::input('dienthoai'),
			'email' 	=> Request::input('email'),
			'noidung' 	=> Request::input('noidung'),
			'tensanpham' 	=> Request::input('tensanpham')
		];

		Mail::send('templates.guidonhang_tpl', $data, function($msg){
			$setting = Cache::get('setting');
			$msg->from(Request::input('email'), Request::input('hoten'));
			$msg->to($setting->email, 'Author sendmail')->subject('Thư gửi đơn hàng từ website');
		});
		echo "<script type='text/javascript'>
			alert('Đơn hàng của bạn đã gửi thành công. Chúng tôi sẽ phản hồi sớm nhất !');
			window.location = '".url('/')."' </script>";
	}

}
