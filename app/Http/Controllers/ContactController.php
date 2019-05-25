<?php 
namespace App\Http\Controllers;
use App\Contact;
use Illuminate\Http\Request;
use DB,Cache,Mail;
class ContactController extends Controller {
	protected $setting = NULL;

	public function __construct()
	{
		
    	$setting = DB::table('setting')->select()->where('id',1)->get()->first();
        Cache::forever('setting', $setting);
	}

	public function getContact()
    {
        // Cấu hình SEO
		$title = "Liên hệ";
		$keyword = "Liên hệ";
		$description = "Liên hệ";
		$img_share = '';
		$com='lien-he';
		$chinhanhs = DB::table('chinhanh')->select()->get();
		$about_lienhe = DB::table('about')->select()->where('com','lien-he')->get()->first();
		$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','lien-he')->get()->first();
		$province = DB::table('province')->get();
        return view('templates.contact_tpl', compact('banner_danhmuc','province','about_lienhe','keyword','description','title','img_share','com','chinhanhs'));
    }

    /**
     * post contact action
     * @param  Request $request
     * @return redirect
     */
    public function postContact(Request $request)
	{
		$data = new Contact();
		$data->name = $request->name;
		$data->phone = $request->phone;
		$data->address = $request->address;
		$data->email = $request->email;
		$data->content = $request->content;
		$data->product = $request->product;
		// $data->website = $request->website;
		// $data->province_id = $request->province;
		$data->save();		
		echo "<script type='text/javascript'>
			alert('Cảm ơn bạn đã gửi yêu cầu. Chúng tôi sẽ liên hệ lại với bạn sớm nhất !');
			window.location = '".url('/')."' </script>";
	}

}
