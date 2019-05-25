<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Products;
use App\ProductCate;
use App\NewsCate;
use App\NewsLetter;
use App\Recruitment;
use DB,Cache,Mail, Session;
use Cart;
use App\Campaign;
use App\News;
use App\Bill;
use App\CampaignCard;
use App\District;
use App\ChiNhanh;
class IndexController extends Controller {
	protected $setting = NULL;

	
	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		session_start();
    	$setting = DB::table('setting')->select()->where('id',1)->get()->first();
    	
    	$about = DB::table('about')->where('com','gioi-thieu')->get();
    	Cache::forever('setting', $setting);
        
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$news = DB::table('news')->where('status',1)->where('com','tin-tuc')->take(8)->orderBy('id','desc')->get();
		$productHot = DB::table('products')->where('status',1)->where('noibat',1)->where('com','san-pham')->take(12)->orderBy('id','desc')->get();
		$banners = DB::table('lienket')->where('com','quang-cao')->orderBy('id','desc')->get();
		$categories_home = ProductCate::where('status',1)->where('com','san-pham')->where('parent_id',0)->orderBy('id','desc')->get();
		$categories_hot = ProductCate::where('status',1)->where('noibat',1)->where('com','san-pham')->where('parent_id',0)->orderBy('id','desc')->get();
		$newsCate = NewsCate::where('parent_id',0)->where('com','tin-tuc')->orderBy('id','desc')->get();
		$slogans = DB::table('slogan')->get();
		$partner = DB::table('partner')->get();
		$feedback = DB::table('feedback')->get();
		$setting =DB::table('setting')->select()->where('id',1)->get()->first();
		$about = DB::table('about')->where('com','gioi-thieu')->first();
		$title = $setting->title;
		$keyword = $setting->keyword;
		$description = $setting->description;		
		$com = 'index';
		// End cấu hình SEO
		$img_share = asset('upload/hinhanh/'.$setting->photo);
		return view('templates.index_tpl', compact('com','keyword','description','title','img_share','categories_home','slogans','news','about','productHot','newsCate','partner','news','categories_hot','feedback','banners'));
	}
	public function getProduct(Request $req)
	{
		$cate_pro = ProductCate::where('status',1)->where('parent_id',0)->where('com','san-pham')->orderby('id','desc')->get();		
		$products = DB::table('products')->where('status',1)->where('com','san-pham')->paginate(18);
		$com='san-pham';		
		$title = "Sản phẩm";
		$keyword = "Sản phẩm";
		$description = "Sản phẩm";
		// $img_share = asset('upload/hinhanh/'.$banner_danhmuc->photo);
		
		return view('templates.product_tpl', compact('title','keyword','description','products', 'com','cate_pro','partners'));
	}


	public function getProductList($id, Request $req)
	{		
		
		$cate_pro = ProductCate::where('status',1)->where('parent_id',0)->orderby('id','desc')->get();
		$partners = DB::table('partner')->get();
        $com = 'san-pham';
        $product_cate = ProductCate::select('*')->where('alias', $id)->where('com','san-pham')->first(); 
        // dd($product_cate);       
        if (!empty($product_cate)) {            
        	$cate_parent = DB::table('product_categories')->where('id', $product_cate->parent_id)->first();
        	$cateChilds = DB::table('product_categories')->where('parent_id', $product_cate->id)->get();        	
        	$array_cate[] = $product_cate->id;
        	if($cateChilds){
        		foreach($cateChilds as $cate){
        			$array_cate[] = $cate->id;
        		}
        	}
        	$products = Products::whereIn('cate_id', $array_cate)->orderBy('id','desc')->paginate(18);
            // $products = $product_cate->products;
            if (!empty($product_cate->title)) {
                $title = $product_cate->title;
            } else {
                $title = $product_cate->name;
            }
            $keyword = $product_cate->keyword;
            $description = $product_cate->description;
            $img_share = asset('upload/product/' . $product_cate->photo);
            return view('templates.productlist_tpl', compact('products', 'product_cate', 'keyword', 'description', 'title', 'img_share', 'cate_pro', 'cate_parent', 'com','partners'));
        } else {
            return redirect()->route('getErrorNotFount');
        }
	}

	public function setCookies(Request $req, $id)
	{
		$idCookie = $id;
		$minutes = 1;
		$id_cookie = cookie('id_cookie', $idCookie, $minutes);
		return response()
			->view('templates.product_detail_tpl')
			->withCookie($id_cookie);
	}

	public function getProductDetail($id, Request $req)
	{        
        $cate_pro = DB::table('product_categories')->where('status',1)->orderby('id','asc')->get();
		$product_detail = DB::table('products')->select()->where('status',1)->where('alias',$id)->get()->first();
		if(!empty($product_detail)){
			$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','san-pham')->get()->first();
			// sản phẩm đã xem
			$_SESSION['daxem'][$product_detail->id] = $product_detail->id;
			$ids_session = $_SESSION['daxem'];
			$productDaXem = DB::table('products')->whereIn('id', $ids_session)->where('status', 1)->get();

			$album_hinh = DB::table('images')->select()->where('product_id',$product_detail->id)->orderby('id','asc')->get();		
			$cateProduct = DB::table('product_categories')->select('name','alias')->where('id',$product_detail->cate_id)->first();
			$productSameCate = DB::table('products')->select()->where('status',1)->where('id','<>',$product_detail->id)->where('cate_id',$product_detail->cate_id)->orderby('stt','desc')->take(20)->get();
			// Cấu hình SEO
			if(!empty($product_detail->title)){
				$title = $product_detail->title;
			}else{
				$title = $product_detail->name;
			}
			$keyword = $product_detail->keyword;
			$description = $product_detail->description;
			$img_share = asset('upload/product/'.$product_detail->photo);			
			// End cấu hình SEO
			return view('templates.product_detail_tpl', compact('product_detail','banner_danhmuc','keyword','description','title','img_share','album_hinh','cateProduct','productSameCate','cate_pro', 'productDaXem'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
	}
	public function getAbout()
	{
		$about = DB::table('about')->where('com','gioi-thieu')->first();		
        $com = 'gioi-thieu';		
		 //Cấu hình SEO
		$title = 'Giới thiệu';
		$keyword = 'Giới thiệu';
		$description = 'Giới thiệu';
		// End cấu hình SEO
		return view('templates.about_tpl', compact('about','keyword','description','title','com'));
	}
	public function getCongTrinh()
	{
		$data = DB::table('about')->where('com','cong-trinh')->first();		
        $com = 'cong-trinh';		
		 //Cấu hình SEO
		$title = 'Công trình';
		$keyword = 'Công trình';
		$description = 'Công trình';
		return view('templates.congtrinh', compact('data','keyword','description','title','com'));
	}
	public function service()
	{
		$tintuc = News::where('com','dich-vu')->orderBy('id','desc')->paginate(8);
		$hot_news = News::where('com','dich-vu')->orderBy('id','desc')->take(6)->get();
		$com = 'dich-vu';
		$title = 'Dịch vụ';
		$description = 'Dịch vụ';
		$keyword = 'Dịch vụ';
		return view('templates.service', compact('com','tintuc','title','description','keyword','hot_news'));
	}
	public function serviceList($alias)
	{
		$data = NewsCate::where('alias',$alias)->where('com','dich-vu')->first();
		$tintuc = News::where('cate_id',$data->id)->orderBy('id','desc')->paginate(8);
		$hot_news = News::where('com','dich-vu')->orderBy('id','desc')->take(6)->get();
		$title = $data->title ? $data->title : $data->name;
		$description = $data->description ? $data->description : $data->name;
		$keyword = $data->keyword ? $data->keyword : $data->name;
		return view('templates.service_list', compact('title','description','keyword','com','data','tintuc','hot_news'));
	}
	public function khuyenmai()
	{
		$data = Products::where('spbc','1')->where('com','san-pham')->orderBy('id','desc')->get();
		$com = 'khuyen-mai';
		$title = 'Khuyến mại';
		$description = 'Khuyến mại';
		$keyword = 'Khuyến mại';
		return view('templates.khuyenmai', compact('com','data','title','description','keyword'));
	}
	public function baogia()
	{
		$data = DB::table('about')->where('com','bao-gia')->first();
		$title = 'Báo giá';	
		return view('templates.baogia',compact('data','title'));
	}
	public function search(Request $request)
	{
		$search = $request->txtSearch;
		$com = 'tim-kiem';
		$cate_pro = DB::table('product_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
		// Cấu hình SEO
		$title = "Tìm kiếm: ".$search;
		$keyword = "Tìm kiếm: ".$search;
		$description = "Tìm kiếm: ".$search;
		$img_share = '';		
		$data = DB::table('products')
		->where('com','san-pham')
		->where('name', 'LIKE', '%' . $search . '%')
		->where('status',1)
		->orderBy('id','DESC')->get();
		// dd($data);
		return view('templates.search_tpl', compact('data','keyword','description','title','img_share','search','com','cate_pro'));
	}

	public function getNews()
	{
		$tintuc = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')->orderby('id','desc')->paginate(12);		
		$hot_news = DB::table('news')->where('status',1)->where('com','tin-tuc')->where('noibat',1)->orderby('id','desc')->take(6)->get();
		$com='tin-tuc';
		// Cấu hình SEO
		$title = "Tin tức";
		$keyword = "Tin tức";
		$description = "Tin tức";
		$img_share = '';
		// End cấu hình SEO
		return view('templates.news_tpl', compact('tintuc','keyword','description','title','img_share','com','hot_news'));
	}
	public function getListNews($id)
	{
		//Tìm article thông qua mã id tương ứng
		$tintuc_cate = DB::table('news_categories')->select()->where('status',1)->where('com','tin-tuc')->where('alias',$id)->get()->first();
		$cateNews = NewsCate::where('com','tin-tuc')->get();
		if(!empty($tintuc_cate)){
			$tintuc = DB::table('news')->select()->where('status',1)->where('cate_id',$tintuc_cate->id)->orderBy('id','desc')->paginate(5);
			$tintuc_moinhat_detail = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')->orderby('created_at','desc')->take(6)->get();
			$hot_news = DB::table('news')->where('status',1)->where('com', 'tin-tuc')->where('noibat',1)->orderBy('stt','asc')->take(5)->get();
			$setting = Cache::get('setting');

			if(!empty($tintuc_cate->title)){
				$title = $tintuc_cate->title;
			}else{
				$title = $tintuc_cate->name;
			}			
			$keyword = $tintuc_cate->keyword;
			$description = $tintuc_cate->description;
			$img_share = asset('upload/news/'.$tintuc_cate->photo);

			// End cấu hình SEO
			return view('templates.news_list', compact('tintuc','tintuc_cate','banner_danhmuc','keyword','description','title','img_share','tintuc_moinhat_detail','hot_news', 'cateNews'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
	}
	
	public function getNewsDetail($id)
	{
		$news_detail = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')->where('alias',$id)->get()->first();		
		if(!empty($news_detail)){			
			$cate_pro = DB::table('product_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
			$hot_news = DB::table('news')->where('status',1)->where('com','tin-tuc')->where('noibat',1)->orderby('id','desc')->take(6)->get();	
			$newsSameCate = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')
			->where('id','<>',$news_detail->id)->take(12)->get();		
			$com='tin-tuc';
			$setting = Cache::get('setting');
			// Cấu hình SEO
			if(!empty($news_detail->title)){
				$title = $news_detail->title;
			}else{
				$title = $news_detail->name;
			}
			$keyword = $news_detail->keyword;
			$description = $news_detail->description;
			$img_share = asset('upload/news/'.$news_detail->photo);

			return view('templates.news_detail_tpl', compact('news_detail','com','keyword','description','title','img_share','newsSameCate','hot_news'));
		}else{
			return redirect()->route('getErrorNotFount');
		}		
	}
	public function getCustomer()
	{
		$tintuc = DB::table('news')->select()->where('status',1)->where('com','khach-hang')->orderby('id','desc')->get();		
		$hot_news = DB::table('news')->where('status',1)->where('com','khach-hang')->where('noibat',1)->orderby('id','desc')->take(6)->get();
		$com='khach-hang';
		// Cấu hình SEO
		$title = "Khách hàng dự án";
		$keyword = "Khách hàng dự án";
		$description = "Khách hàng dự án";
		$img_share = '';
		// End cấu hình SEO
		return view('templates.customer', compact('tintuc','keyword','description','title','img_share','com'));
	}
	public function getListBangGia($alias)
	{
		$tintuc_cate = DB::table('news_categories')->select()->where('status',1)->where('com','bang-gia')->where('alias',$alias)->get()->first();
		$cateNews = DB::table('news_categories')->where('com','bang-gia')->get();
		if(!empty($tintuc_cate)){
			$tintuc = DB::table('news')->select()->where('status',1)->where('cate_id',$tintuc_cate->id)->orderBy('id','desc')->paginate(5);
			$tintuc_moinhat_detail = DB::table('news')->select()->where('status',1)->where('com','bang-gia')->orderby('created_at','desc')->take(6)->get();
			$hot_news = DB::table('news')->where('status',1)->where('com', 'bang-gia')->where('noibat',1)->orderBy('stt','asc')->take(5)->get();
			$setting = Cache::get('setting');
			if(!empty($tintuc_cate->title)){
				$title = $tintuc_cate->title;
			}else{
				$title = $tintuc_cate->name;
			}
			$keyword = $tintuc_cate->keyword;
			$description = $tintuc_cate->description;
			$img_share = asset('upload/news/'.$tintuc_cate->photo);
			// End cấu hình SEO
			return view('templates.banggia_list', compact('tintuc','tintuc_cate','banner_danhmuc','keyword','description','title','img_share','tintuc_moinhat_detail','hot_news', 'cateNews'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
	}
	public function getCustomerDetail($alias)
	{
		$news_detail = DB::table('news')->select()->where('status',1)->where('com','khach-hang')->where('alias',$alias)->first();
		
		if(!empty($news_detail)){			
			$cate_pro = DB::table('product_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
			$newsSameCate = DB::table('news')->select()->where('status',1)->where('com','khach-hang')
			->where('id','<>',$news_detail->id)->take(12)->get();			
			$com='bang-gia';
			$setting = Cache::get('setting');
			// Cấu hình SEO
			if(!empty($news_detail->title)){
				$title = $news_detail->title;
			}else{
				$title = $news_detail->name;
			}
			$keyword = $news_detail->keyword;
			$description = $news_detail->description;
			$img_share = asset('upload/news/'.$news_detail->photo);

			return view('templates.customer_detail_tpl', compact('news_detail','com','keyword','description','title','img_share','newsSameCate'));
		}else{
			return redirect()->route('getErrorNotFount');
		}		
	}

	public function postGuidonhang(Request $request)
	{
		$setting = Cache::get('setting');
		$data = [
			'hoten' 		=> $request->get('hoten'), 
			'diachi' 	=> $request->get('diachi'),
			'dienthoai' 	=> $request->get('dienthoai'),
			'email' 	=> $request->get('email'),
			'noidung' 	=> $request->get('noidung')
		];
		Mail::send('templates.guidonhang_tpl', $data, function($msg){
			$msg->from($request->get('email'), $request->get('hoten'));
			$msg->to('emailserver.send@gmail.com', 'Author sendmail')->subject('Liên hệ từ website');
		});

		echo "<script type='text/javascript'>
			alert('Thanks for contacting us !');
			window.location = '".url('/')."' </script>";
	}
	public function postNewsLetter(Request $request)
	{
		$this->validate($request,
            ["txtEmail" => "required"],
            ["txtEmail.required" => "Bạn chưa nhập email"]
        );
        $kiemtra_mail = DB::table('newsletter')->select()->where('status',1)->where('com','newsletter')->where('email',$request->txtEmail)->get()->first();
        if(empty($kiemtra_mail)){
			$data = new NewsLetter();
			$data->name = $request->txtName;
			$data->email = $request->txtEmail;
			$data->phone = $request->txtPhone;
			$data->content = $request->txtContent;
			$data->status = 1;
			$data->com = 'newsletter';
			$data->save();

			echo "<script type='text/javascript'>
				alert('Bạn đã đăng kí nhận tin tức thành công !');
				window.location = '".url('/')."' </script>";
		}else{
			echo "<script type='text/javascript'>
				alert('Email này đã đăng ký !');
				window.location = '".url('/')."' </script>";
		}
	}
	public function getErrorNotFount(){
		$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','san-pham')->get()->first();
		return view('templates.404_tpl',compact('banner_danhmuc'));
	}
	public function getTuyenDung(){
		$com='tuyen-dung';
		$tintuc = DB::table('news')->select()->where('status',1)->where('com','tuyen-dung')->orderby('stt','asc')->paginate(6);
		$hot_news = DB::table('news')->select()->where('status',1)->where('noibat','>',0)->where('com','tuyen-dung')->take(5)->get();

		$title = 'Tuyển dụng';
		$description = 'Tuyển dụng';
		$keyword = 'Tuyển dụng';
		return view('templates.tuyendung', compact('com','tintuc','hot_news','title','description','keyword'));
	}
	public function getNewsTuyenDungDetail($alias)
	{
		$news_detail = DB::table('news')->select()->where('status',1)->where('com','tuyen-dung')->where('alias',$alias)->get()->first();
		if(!empty($news_detail)){
			$hot_news = DB::table('news')->where('status',1)->where('com', 'tuyen-dung')->where('noibat',1)->orderBy('stt','asc')->take(5)->get();
			if(!empty($news_detail->title)){
				$title = $news_detail->title;
			}else{
				$title = $news_detail->name;
			}
			$keyword = $news_detail->keyword;
			$description = $news_detail->description;
			$img_share = asset('upload/news/'.$news_detail->photo);
		}
		return view('templates.detailtuyendung', compact('news_detail', 'hot_news','title','description','keyword', 'img_share'));
	}
	public function postTuyenDung(Request $request){
		$data = new Recruitment;
		$data->name = $request->txtName;
		$data->phone = $request->txtPhone;
		$data->email = $request->txtEmail;
		$data->address = $request->txtAddress;
		$data->save();
		return redirect()->back()->with('mess','Cảm ơn bạn đã gửi yêu cầu. Chúng tôi sẽ liên hệ lại với bạn sớm nhất !');
	}


	public function getCart()
	{
		$product_cart= Cart::content();
		// dd($product_cart);
		$bank = DB::table('bank_account')->get();
		$total = $this->getTotalPrice();
		$province = DB::table('province')->get();
		// $district = DB::table('district')->get();
		$product_noibat = DB::table('products')->select()->where('status',1)->where('noibat','>',0)->orderBy('created_at','desc')->take(8)->get();
		$setting = Cache::get('setting');
		// Cấu hình SEO
		$title = "Giỏ hàng";
		$keyword = "Giỏ hàng";
		$description = "Giỏ hàng";
		$img_share = '';
		// End cấu hình SEO
		return view('templates.giohang_tpl', compact('product_cart','product_noibat','province','keyword','description','title','img_share','total', 'bank'));
	}

	public function addCart(Request $req)
	{
		$data = $req->only('product_id','product_numb');
		$product = DB::table('products')->where('status',1)->where('id',$data['product_id'])->first();
		if (!$product) {
			die('product not found');
		}
		Cart::add(array(
				'id'=>$product->id,
				'name'=>$product->name,
				'qty'=>$data['product_numb'],
				'price'=>$product->price,
				'options'=>array('photo'=>$product->photo)));
		return redirect(route('getCart'));
	}
	public function addCartAjax(Request $req)
    {
        // $data = $req->only('product_id');
        try {
            $product = DB::table('products')->select()->where('status', 1)->where('id', $req->id)->first();
            if (!$product) {
                die('product not found');
            }
            Cart::add(array(
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->price,
                'options' => array('photo' => $product->photo, 'code' => $product->code, 'alias' => $product->alias)
            ));
            echo count(Cart::Content());
        } catch (\Exception $e) {
            return 0;
        }
        // return redirect(route('getCart'));
    }
	public function updateCart(Request $req){
		$data = $req->numb;
		// dd($data);
		if($data>0){
			foreach($data as $key=>$item){
				Cart::update($key, $item);
			}
		}		
		return redirect(route('getCart'));
	}
	public function deleteCart($id){
        Cart::remove($id);
        return redirect('gio-hang');
    }

    public function checkCard(Request $req) {
    	$card = (new CampaignCard)
    		->join('campaigns', 'campaign_cards.campaign_id', '=', 'campaigns.id')
    		->select('campaigns.campaign_value', 'campaigns.campaign_type')
    		->where([
    			'campaign_cards.card_code' => $req->card_code,
    			'campaign_cards.del_flg' => 0,
    			'campaign_cards.is_active' => 0,
    			'campaigns.del_flg' => 0
    		])
    		->where('campaigns.campaign_expired', '>=', date('Y-m-d'))
    		->first();
    	if ($card) {
	    	$total = $this->getTotalPrice();
    		if ($card->campaign_type == 1) {
    			$total = $total - $card->campaign_value;
    		}
    		if ($card->campaign_type == 2) {
    			$total = $total * (100 - $card->campaign_value) / 100;
    		}

    		// return ($total);
    		return number_format($total);
    	}
    	return response()->json(false);
    }

    protected function getTotalPrice() 
    {
    	$cart = Cart::content();
    	$total = 0;
    	foreach ($cart as $key) {
    		$total += $key->price * $key->qty;
    	}
    	return $total;
    }

    public function postOrder(Request $req){
    	$cart = Cart::content();
    	$bill = new Bill;
    	$bill->full_name = $req->full_name;
    	$bill->email = $req->email;
    	$bill->phone = $req->phone;
    	$bill->note = $req->note;
    	$bill->address = $req->address;
    	$bill->payment = (int)($req->payment_method);
    	// $bill->province = $req->province;
    	// $bill->district = $req->district;
    	$total = $this->getTotalPrice();
    	$bill->total = $total;
    	// $order['price'] = $this->getTotalPrice();
    	// if ($req->card_code) {
    	// 	$price = $this->checkCard($req);
	    // 	if (!$price) {
	    // 		return redirect()->back()->with('Mã giảm giá không đúng');
	    // 	}
	    // 	$bill->card_code = $req->card_code;
	    // 	$tongtien = $this->checkCard($req);
	    // 	$bill->total = ((Int)str_replace(',', '', $tongtien)); 	
    	// }
    	$detail = [];
    	foreach ($cart as $key) {
    		$detail[] = [
    			'product_name' => $key->name,
    			'product_numb' => $key->qty,
    			'product_price' => $key->price,
    			'product_img' => $key->options->photo,
    			'product_code' => $key->options->color
    		];
    	}    	    	
    	$bill->detail = json_encode($detail);

    	// dd($bill);
    	if($total > 0){
    		$bill->save();
    	}
    	else{
    		echo "<script type='text/javascript'>
				alert('Giỏ hàng của bạn rỗng!');
				window.location = '".url('/')."' 
			</script>";
    	}    	
    	Cart::destroy();

    	echo "<script type='text/javascript'>
				alert('Cảm ơn bạn đã đặt hàng, chúng tôi sẽ liên hệ với bạn sớm nhất!');
				window.location = '".url('/')."' 
			</script>";
    }

    public function deleteAllCart(){
    	Cart::destroy();
    	return redirect()->back()->with('mess','Đã xóa giỏ hàng');
    }

    public function thanhtoan(){
    	$bank = DB::table('bank_account')->get();
    	$product_cart= Cart::content();
    	// dd($product_cart);
    	$total = $this->getTotalPrice();
		return view('templates.thanhtoan_tpl',compact('bank','product_cart','total'));
	}
    public function loadDistrictByProvince($id){
    	$district = District::where('province_id',$id)->get();
    	// dd($district);
    	foreach($district as $item){
    		echo "<option value='".$item->id."'>".$item->district_name."</option>";
    	}
    }
    
    public function SapXep(Request $request){
    	$result = DB::table('products')
    			->join('product_categories','products.cate_id','=','product_categories.id')
    			->select('products.id', 'products.name as productName','products.alias as productAlias','products.photo as productPhoto','products.price as productPrice');

    	if ($request->cate) {
    		$result = $result->where('products.cate_id', $request->cate);
    	}
    	if ($request->price) {
    		$result = $result->whereBetween('products.price', array(0, $request->price));
    	}

    	$result = $result->orderBy('products.id', $request->sort ? $request->sort : 'asc')->paginate(12);
    	return response()->json([
    		'paginator'  => (String) $result->render(),
    		'data'		 => json_decode(json_encode($result))->data,
    	]);
    }

    public function getProductByCate($alias){
    	$cate_pro = DB::table('product_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
    	$categoryDetail = ProductCate::select('name','alias','id','parent_id')->where('alias', $alias)->first();
    	$products = $categoryDetail->products;

    	return view('templates.cateproduct_tpl', compact('categoryDetail','cate_pro','products'));
    }
    public function filter(Request $requset){
    	$price = explode(' - ', $requset->price_filter);
    	dd($price);
    }


	public function loadmoreProject(Request $req)
	{
		$offset = $req->offset;
		$limit = $req->limit;
		$projects = DB::table('news')->where('com','du-an-google')->where('status',1)->where('noibat',1)->skip($offset)->take($limit)->orderBy('stt','asc')->get();
		// dd($projects);
		return view('templates.loadmore_project', compact('projects'));
	}
	public function store()
	{
		$store = DB::table('chinhanh')->get();
		return view('templates.store', compact('store'));
	}

	public function catalog()
	{
		$catalog = DB::table('lienket')->where('com','catalog')->first();
		
		return view('templates.catalog', compact('catalog'));
	}

	public function newProduct(Request $req)
	{
		$cate_pro = DB::table('product_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
		$colors = DB::table('colors')->get();
        $com = 'san-pham';
        $products = DB::table('products')->where('status',1)->orderBy('id','desc');
    		$limit = $req->view ? $req->view : 6;
    		$sort = $req->sort ? $req->sort : 'asc';
    		
    		$price_from = $req->from ? $req->from : 0;
    		$price_to = $req->to ? $req->to : 100000000;
        	
        	$products = DB::table('products')
        	->where('status', 1)
        	->orderBy('price', $sort);
        	$appends = [];
        	if($req->isMethod('GET')){
        		$products = $products->whereBetween('price', [ $price_from, $price_to])
        		->where('color_id', 'like', '%' . $req->color . '%');
        		$viewx  = $req->view;
        		$sortx  = $req->sort;
        		$colorx	= $req->color;
        		$appends = [
        			'from'  => $price_from,
        			'to'    => $price_to,
        			'color' => $colorx,
        			'view'  => $viewx,
        			'sort'  => $sortx
        		];
        	};

        	$products = $products->paginate($limit);		
		return view('templates.hangmoi', compact('cate_pro', 'colors', 'products', 'price_from', 'price_to', 'viewx', 'sortx', 'colorx', 'appends'));
	}
	public function productSelling(Request $req)
	{
		$cate_pro = DB::table('product_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
		$colors = DB::table('colors')->get();
        $com = 'san-pham';
        $products = DB::table('products')->where('status',1)->orderBy('id','desc');
    		$limit = $req->view ? $req->view : 6;
    		$sort = $req->sort ? $req->sort : 'asc';    		
    		$price_from = $req->from ? $req->from : 0;
    		$price_to = $req->to ? $req->to : 100000000;        	
        	$products = DB::table('products')
        	->where('status', 1)
        	->orderBy('price', $sort);
        	$appends = [];
        	if($req->isMethod('GET')){
        		$products = $products->whereBetween('price', [ $price_from, $price_to])
        		->where('color_id', 'like', '%' . $req->color . '%');
        		$viewx  = $req->view;
        		$sortx  = $req->sort;
        		$colorx	= $req->color;
        		$appends = [
        			'from'  => $price_from,
        			'to'    => $price_to,
        			'color' => $colorx,
        			'view'  => $viewx,
        			'sort'  => $sortx
        		];
        	};
        	$products = $products->paginate($limit);		
		return view('templates.banchay', compact('cate_pro', 'colors', 'products', 'price_from', 'price_to', 'viewx', 'sortx', 'colorx', 'appends'));
	}

	public function getBaiVietDetail($alias)
	{
		$data = DB::table('news')->where('alias',$alias)->first();
		$title = $data->name;
		return view('templates.post', compact('data','title'));
	}
	
}
