<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// test api zalo

Route::get('/', ['as'=>'index', 'uses'=>'IndexController@index']);
Route::get('gioi-thieu',['as'=>'getAbout', 'uses'=>'IndexController@getAbout']);
Route::get('cong-trinh',['as'=>'getCongTrinh', 'uses'=>'IndexController@getCongTrinh']);
Route::post('cartajax/add', ['as' => 'addProductToCartAjax', 'uses' => 'IndexController@addCartAjax']);

Route::get('lien-he',['as'=>'getContact', 'uses'=>'ContactController@getContact']);
Route::post('lien-he',['as'=>'postContact', 'uses'=>'ContactController@postContact']);

// Ajax load more project
Route::get('loadmore/project','IndexController@loadmoreProject')->name('loadmoreProject');

Route::get('tim-kiem',['as'=>'search', 'uses'=>'IndexController@search']);
Route::post('newsletter',['as'=>'postNewsletter', 'uses'=>'IndexController@postNewsletter']);
Route::get('san-pham',['as'=>'getProduct', 'uses'=>'IndexController@getProduct']);
Route::get('san-pham/{alias}.html','IndexController@getProductDetail')->name('detailProduct');
Route::get('san-pham/{id}',['as'=>'getProductList', 'uses'=>'IndexController@getProductList']);

Route::get('khuyen-mai','IndexController@khuyenmai');
Route::get('dich-vu','IndexController@service');
Route::get('dich-vu/{alias}.html','IndexController@serviceDetail');
Route::get('dich-vu/{alias}','IndexController@serviceList');

Route::get('product/filter', 'IndexController@productFilder')->name('product.filter');

Route::get('thanh-toan',['as'=>'thanhtoan', 'uses' => 'IndexController@thanhtoan']);
// Route::get('danh-muc/{alias}',['as'=>'getProductChild', 'uses'=>'IndexController@getProductChild']);

Route::get('filter','IndexController@filter')->name('filter');
Route::get('ajax/province/{id}',['as'=>'loadDistrictByProvince', 'uses'=>'IndexController@loadDistrictByProvince']);
Route::get('sap-xep','IndexController@SapXep')->name('sapxep');

// dang ky, dang nhap
Route::get('signup','SignupController@signup');
Route::post('signup', 'SignupController@postSignup')->name('postSignup');
Route::get('login','LoginController@getLogin')->name('getLogin');
Route::post('login','LoginController@postLogin')->name('postLogin');
Route::get('logout','LoginController@logout');
// gio hang
Route::get('gio-hang',['as'=>'getCart', 'uses'=>'IndexController@getCart']);
Route::post('cart/add', ['as' => 'addProductToCart', 'uses' => 'IndexController@addCart']);


Route::post('cart/update',['as' => 'updateCart', 'uses' => 'IndexController@updateCart']);
// Route::get('updatecart/{id}/{qty}',['as'=>'updatecart','uses'=>'IndexController@updatecart']);
Route::get('xoa-gio-hang/{id}','IndexController@deleteCart');
Route::post('gui-don-hang', ['as' =>'postOrder', 'uses'=> 'IndexController@postOrder']);
Route::get('xoa-all','IndexController@deleteAllCart')->name('deleteCart');
Route::post('card/check',['as'=>'checkCard', 'uses'=>'IndexController@checkCard']);

Route::get('tin-tuc',['as'=>'getListNews', 'uses'=>'IndexController@getNews']);
Route::get('tin-tuc/{alias}.html',['as'=>'getNewsDetail', 'uses'=>'IndexController@getNewsDetail']);
Route::get('tin-tuc/{alias}',['as'=>'getListNews', 'uses'=>'IndexController@getListNews']);

Route::get('error/404.html',['as'=>'getErrorNotFount', 'uses'=>'IndexController@getErrorNotFount']);
Route::get('bao-gia','IndexController@baogia');

Route::get('backend/login',['as'=>'admin.auth.getLogin', 'uses'=>'AdminAuth\AuthController@getLogin']);
Route::post('backend/postlogin',['as'=>'admin.auth.postLogin', 'uses'=>'AdminAuth\AuthController@postLogin']);

Route::group(['middleware' =>'authen', 'prefix' => 'backend'], function(){
	Route::get('/',['as'=>'admin.index', 'uses'=>'Admin\IndexController@getIndex']);
	Route::get('register',['as'=>'getRegister', 'uses'=>'AdminAuth\AuthController@getRegister']);
	Route::post('postregister',['as'=>'postRegister', 'uses'=>'AdminAuth\AuthController@postRegister']);
	Route::get('logout', ['as' => 'admin.auth.logout', 'uses' => 'AdminAuth\AuthController@logout']);
	Route::get('setting',['as'=>'admin.setting.index','uses'=>'Admin\SettingController@index']);
	Route::post('setting/update',['as'=>'admin.setting.update','uses'=>'Admin\SettingController@update']);
	
	Route::post('contact/access',['as'=>'admin.contact.access','uses'=>'Admin\ContactController@xuly']);
	Route::post('recruitment/access',['as'=>'admin.recruitment.access','uses'=>'Admin\RecruitmentController@accessRe']);

	Route::group(['prefix' => 'users'], function(){
		Route::get('info',['as'=>'admin.users.getAdmin','uses'=>'Admin\UsersController@getAdmin']);
		Route::post('updateinfo',['as'=>'admin.users.updateinfo','uses'=>'Admin\UsersController@updateinfo']);
	});

	// Chương trình khuyến mại, giảm giá
	Route::group(['prefix' => 'campaign'], function(){
		Route::get('/', ['as' => 'campaignIndex', 'uses' => 'Admin\CampaignController@index']);
		Route::any('/create/{id?}', ['as' => 'campaignCreate', 'uses' => 'Admin\CampaignController@create']);
		Route::get('/delete/{id}', ['as' => 'campaignDelete', 'uses' => 'Admin\CampaignController@delete']);
	});
	Route::group(['prefix' => 'campaign/card'], function(){
		Route::get('/', ['as' => 'campaignCardIndex', 'uses' => 'Admin\CampaignController@getCard']);
		Route::get('delete_list/{id}',['as'=>'deleteListCode','uses'=>'Admin\CampaignController@getDeleteList']);
	});


	Route::group(['prefix' => 'productcate'], function(){
		Route::get('/',['as'=>'admin.productcate.index','uses'=>'Admin\ProductCateController@getDanhSach']);
		Route::get('add',['as'=>'admin.productcate.getAdd','uses'=>'Admin\ProductCateController@getAdd']);
		Route::post('postAdd',['as'=>'admin.productcate.postAdd','uses'=>'Admin\ProductCateController@postAdd']);

		Route::get('edit',['as'=>'admin.productcate.getEdit','uses'=>'Admin\ProductCateController@getEdit']);

		Route::post('edit',['as'=>'admin.productcate.update','uses'=>'Admin\ProductCateController@update']);

		Route::get('{id}/delete',['as'=>'admin.productcate.getDelete','uses'=>'Admin\ProductCateController@getDelete']);
		Route::get('{id}/delete_list',['as'=>'admin.productcate.getDeleteList','uses'=>'Admin\ProductCateController@getDeleteList']);
	});
	Route::group(['prefix' => 'product'], function(){
		Route::get('/',['as'=>'admin.product.index','uses'=>'Admin\ProductController@getList']);
		Route::get('add',['as'=>'admin.product.getAdd','uses'=>'Admin\ProductController@getAdd']);
		Route::post('postAdd',['as'=>'admin.product.postAdd','uses'=>'Admin\ProductController@postAdd']);
		Route::get('delimg/{id}',['as'=>'admin.product.getDelImg','uses'=>'Admin\ProductController@getDelImg']);

		Route::get('edit',['as'=>'admin.product.getEdit','uses'=>'Admin\ProductController@getEdit']);
		Route::post('edit',['as'=>'admin.product.update','uses'=>'Admin\ProductController@update']);

		Route::get('{id}/delete',['as'=>'admin.product.getDelete','uses'=>'Admin\ProductController@getDelete']);
		
		Route::get('{id}/deleteList',['as'=>'admin.product.getDeleteList','uses'=>'Admin\ProductController@getDeleteList']);
		Route::get('{id}/addAlbum',['as'=>'admin.product.addAlbum','uses'=>'Admin\ProductController@addAlbum']);		
	});

	Route::group(['prefix' => 'color'], function(){
		Route::get('/', 'Admin\ColorController@index')->name('admin.color.index');
		Route::get('create', 'Admin\ColorController@getCreate')->name('admin.color.getCreate');
		Route::post('create', 'Admin\ColorController@postCreate')->name('admin.color.postCreate');
		Route::get('edit/{id}','Admin\ColorController@getEdit')->name('admin.color.getEdit');
		Route::post('edit/{id}','Admin\ColorController@postEdit')->name('admin.color.postEdit');
		Route::get('delete/{id}', 'Admin\ColorController@delete')->name('admin.color.delete');
	});
	
	Route::group(['prefix' => 'orders'], function(){
		Route::get('/',['as'=>'admin.bill.index','uses'=>'Admin\BillController@getList']);
		// Route::get('add',['as'=>'admin.obill.getAdd','uses'=>'Admin\BillController@getAdd']);
		// Route::post('postAdd',['as'=>'admin.obill.postAdd','uses'=>'Admin\OBillController@postAdd']);
		
		Route::get('edit/{id}',['as'=>'admin.bill.getEdit','uses'=>'Admin\BillController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.bill.update','uses'=>'Admin\BillController@update']);

		Route::get('delete/{id}',['as'=>'admin.bill.getDelete','uses'=>'Admin\BillController@getDelete']);
		// Route::get('{id}/delete_list',['as'=>'admin.obill.getDeleteList','uses'=>'Admin\OBillController@getDeleteList']);
	});

	Route::group(['prefix' => 'newscate'], function(){
		Route::get('/',['as'=>'admin.newscate.index','uses'=>'Admin\NewsCateController@getDanhSach']);
		Route::get('add',['as'=>'admin.newscate.getAdd','uses'=>'Admin\NewsCateController@getAdd']);
		Route::post('postAdd',['as'=>'admin.newscate.postAdd','uses'=>'Admin\NewsCateController@postAdd']);

		Route::get('edit',['as'=>'admin.newscate.getEdit','uses'=>'Admin\NewsCateController@getEdit']);

		Route::post('edit',['as'=>'admin.newscate.update','uses'=>'Admin\NewsCateController@update']);

		Route::get('{id}/delete',['as'=>'admin.newscate.getDelete','uses'=>'Admin\NewsCateController@getDelete']);
		Route::get('{id}/delete_list',['as'=>'admin.newscate.getDeleteList','uses'=>'Admin\NewsCateController@getDeleteList']);
	});
	
	Route::group(['prefix'=>'position'], function(){
		Route::get('/',['as'=>'admin.position.index','uses'=>'Admin\PositionController@getList']);
		Route::get('add',['as'=>'admin.position.getAdd','uses'=>'Admin\PositionController@getAdd']);
		Route::post('add',['as'=>'admin.position.postAdd','uses'=>'Admin\PositionController@postAdd']);

		Route::get('edit/{id}',['as'=>'admin.position.getEdit','uses'=>'Admin\PositionController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.position.update','uses'=>'Admin\PositionController@update']);

		Route::get('delete/{id}',['as'=>'admin.position.getDelete','uses'=>'Admin\PositionController@getDelete']);
		
		Route::get('deleteList/{id}',['as'=>'admin.position.getDeleteList','uses'=>'Admin\PositionController@getDeleteList']);

	});

	Route::group(['prefix'=>'banner'], function(){
		Route::get('/',['as'=>'admin.banner.index','uses'=>'Admin\BannerController@getList']);
		Route::get('add',['as'=>'admin.banner.getAdd','uses'=>'Admin\BannerController@getAdd']);
		Route::post('add',['as'=>'admin.banner.postAdd','uses'=>'Admin\BannerController@postAdd']);

		Route::get('edit/{id}',['as'=>'admin.banner.getEdit','uses'=>'Admin\BannerController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.banner.update','uses'=>'Admin\BannerController@update']);

		Route::get('delete/{id}',['as'=>'admin.banner.getDelete','uses'=>'Admin\BannerController@getDelete']);
		
		Route::get('deleteList/{id}',['as'=>'admin.banner.getDeleteList','uses'=>'Admin\BannerController@getDeleteList']);

	});
	Route::group(['prefix' => 'news'], function(){
		Route::get('/',['as'=>'admin.news.index','uses'=>'Admin\NewsController@getList']);
		Route::get('add',['as'=>'admin.news.getAdd','uses'=>'Admin\NewsController@getAdd']);
		Route::post('postAdd',['as'=>'admin.news.postAdd','uses'=>'Admin\NewsController@postAdd']);
		Route::get('edit',['as'=>'admin.news.getEdit','uses'=>'Admin\NewsController@getEdit']);
		Route::post('edit',['as'=>'admin.news.update','uses'=>'Admin\NewsController@update']);

		Route::get('{id}/delete',['as'=>'admin.news.getDelete','uses'=>'Admin\NewsController@getDelete']);
		Route::get('delimg/{id}',['as'=>'admin.news.getDelImg','uses'=>'Admin\NewsController@getDelImg']);
		Route::get('{id}/deleteList',['as'=>'admin.news.getDeleteList','uses'=>'Admin\NewsController@getDeleteList']);

	});
	Route::group(['prefix'=>'feedback'], function(){
		Route::get('/',['as'=>'admin.feedback.index','uses'=>'Admin\FeedbackController@index']);
		Route::get('add',['as'=>'admin.feedback.create','uses'=>'Admin\FeedbackController@getCreate']);
		Route::post('add',['as'=>'admin.feedback.postCreate','uses'=>'Admin\FeedbackController@postCreate']);
		Route::get('edit/{id}',['as'=>'admin.feedback.edit', 'uses'=>'Admin\FeedbackController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.feedback.postEdit', 'uses'=>'Admin\FeedbackController@postEdit']);
		Route::get('delete/{id}',['as'=>'admin.feedback.delete', 'uses' => 'Admin\FeedbackController@delete']);
	});
	Route::group(['prefix' => 'about'], function(){
		Route::get('/','Admin\AboutController@getList')->name('admin.about.getList');
		Route::get('add','Admin\AboutController@getAdd')->name('admin.about.getAdd');
		Route::post('postAdd',['as'=>'admin.about.postAdd','uses'=>'Admin\AboutController@postAdd']);

		Route::get('edit',['as'=>'admin.about.getEdit','uses'=>'Admin\AboutController@getEdit']);
		Route::post('edit',['as'=>'admin.about.update','uses'=>'Admin\AboutController@update']);

		Route::get('{id}/delete',['as'=>'admin.about.getDelete','uses'=>'Admin\AboutController@getDelete']);
	});
	
	Route::group(['prefix' => 'lienket'], function(){
		Route::get('/',['as'=>'admin.lienket.index','uses'=>'Admin\LienKetController@getList']);
		Route::get('add',['as'=>'admin.lienket.getAdd','uses'=>'Admin\LienKetController@getAdd']);
		Route::post('postAdd',['as'=>'admin.lienket.postAdd','uses'=>'Admin\LienKetController@postAdd']);

		Route::get('edit',['as'=>'admin.lienket.getEdit','uses'=>'Admin\LienKetController@getEdit']);
		Route::post('edit',['as'=>'admin.lienket.update','uses'=>'Admin\LienKetController@update']);
		Route::get('{id}/delete',['as'=>'admin.lienket.getDelete','uses'=>'Admin\LienKetController@getDelete']);		
		Route::get('{id}/deleteList',['as'=>'admin.lienket.getDeleteList','uses'=>'Admin\LienKetController@getDeleteList']);
	});
	Route::group(['prefix' => 'contact'], function(){
		Route::get('/','Admin\ContactController@getContact')->name('admin.contact.index');
		Route::get('delete/{id}','Admin\ContactController@deleteContact')->name('delete.contact');
	});
	Route::group(['prefix' => 'recruitment'], function(){
		Route::get('/',['as'=>'admin.recruitment.index', 'uses'=>'Admin\RecruitmentController@getRecruitment']);
		Route::get('delete/{id}',['as' => 'admin.delete.recruitment', 'uses'=>'Admin\RecruitmentController@deleteRecruitment']);
	});

	Route::group(['prefix' => 'newsletter'], function(){
		Route::get('/',['as'=>'admin.newsletter.index','uses'=>'Admin\NewsLetterController@getList']);
		Route::get('add',['as'=>'admin.newsletter.getAdd','uses'=>'Admin\NewsLetterController@getAdd']);
		Route::post('postAdd',['as'=>'admin.newsletter.postAdd','uses'=>'Admin\NewsLetterController@postAdd']);
		Route::post('sendmail',['as'=>'admin.newsletter.postNewsLetter','uses'=>'Admin\NewsLetterController@postNewsLetter']);


		Route::get('edit',['as'=>'admin.newsletter.getEdit','uses'=>'Admin\NewsLetterController@getEdit']);
		Route::post('edit',['as'=>'admin.newsletter.update','uses'=>'Admin\NewsLetterController@update']);

		Route::get('{id}/delete',['as'=>'admin.newsletter.getDelete','uses'=>'Admin\NewsLetterController@getDelete']);
		
		Route::get('{id}/deleteList',['as'=>'admin.newsletter.getDeleteList','uses'=>'Admin\NewsLetterController@getDeleteList']);
	});
	Route::group(['prefix' => 'slider'], function(){
		Route::get('/',['as'=>'admin.slider.index','uses'=>'Admin\SliderController@getList']);
		Route::get('add',['as'=>'admin.slider.getAdd','uses'=>'Admin\SliderController@getAdd']);
		Route::post('postAdd',['as'=>'admin.slider.postAdd','uses'=>'Admin\SliderController@postAdd']);
		Route::get('edit',['as'=>'admin.slider.getEdit','uses'=>'Admin\SliderController@getEdit']);
		Route::post('edit',['as'=>'admin.slider.update','uses'=>'Admin\SliderController@update']);
		Route::get('{id}/delete',['as'=>'admin.slider.getDelete','uses'=>'Admin\SliderController@getDelete']);
		Route::get('{id}/deleteList',['as'=>'admin.slider.getDeleteList','uses'=>'Admin\SliderController@getDeleteList']);
	});
	Route::group(['prefix' => 'province'], function(){
		Route::get('/',['as'=>'admin.province.index', 'uses' => 'Admin\ProvinceController@index']);
		Route::get('add',['as'=>'admin.province.getCreate', 'uses' => 'Admin\ProvinceController@getCreate']);
		Route::post('add',['as'=>'admin.province.postCreate', 'uses' => 'Admin\ProvinceController@postCreate']);
		Route::get('edit/{id}',['as'=>'admin.province.getEdit', 'uses' => 'Admin\ProvinceController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.province.postEdit', 'uses' => 'Admin\ProvinceController@postEdit']);
		Route::get('delete/{id}',['as'=>'admin.province.delete', 'uses' => 'Admin\ProvinceController@delete']);
	});
	Route::group(['prefix' => 'district'], function(){
		Route::get('/',['as'=>'admin.district.index', 'uses' => 'Admin\DistrictController@index']);
		Route::get('add',['as'=>'admin.district.getCreate', 'uses' => 'Admin\DistrictController@getCreate']);
		Route::post('add',['as'=>'admin.district.postCreate', 'uses' => 'Admin\DistrictController@postCreate']);
		Route::get('edit/{id}',['as'=>'admin.district.getEdit', 'uses' => 'Admin\DistrictController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.district.postEdit', 'uses' => 'Admin\DistrictController@postEdit']);
		Route::get('delete/{id}',['as'=>'admin.district.delete', 'uses' => 'Admin\DistrictController@delete']);
	});

	Route::group(['prefix'=>'chinhanh'], function(){
		Route::get('/',['as'=>'admin.chinhanh.index','uses'=>'Admin\ChiNhanhController@index']);
		Route::get('create',['as'=>'admin.chinhanh.create','uses'=>'Admin\ChiNhanhController@getCreate']);
		Route::post('create',['as'=>'admin.chinhanh.postCreate','uses'=>'Admin\ChiNhanhController@postCreate']);
		Route::get('edit/{id}',['as'=>'admin.chinhanh.edit', 'uses'=>'Admin\ChiNhanhController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.chinhanh.postEdit', 'uses'=>'Admin\ChiNhanhController@postEdit']);
		Route::get('delete/{id}',['as'=>'admin.chinhanh.delete', 'uses' => 'Admin\ChiNhanhController@delete']);
	});

	Route::group(['prefix'=>'bankaccount'], function(){
		Route::get('/',['as'=>'admin.bank.index', 'uses'=>'Admin\BankAccountController@index']);

		Route::get('create',['as'=>'admin.bank.getCreate', 'uses'=>'Admin\BankAccountController@getCreate']);
		Route::post('create',['as'=>'admin.bank.postCreate', 'uses'=>'Admin\BankAccountController@postCreate']);

		Route::get('edit/{id}',['as'=>'admin.bank.getEdit', 'uses'=>'Admin\BankAccountController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.bank.postEdit', 'uses'=>'Admin\BankAccountController@postEdit']);

		Route::get('delete/{id}',['as'=>'admin.bank.delete','uses'=>'Admin\BankAccountController@delete']);
	});
	Route::group(['prefix'=>'video'], function(){
		Route::get('/',['as'=>'admin.video.index', 'uses'=>'Admin\VideoController@index']);

		Route::get('create',['as'=>'admin.video.getCreate', 'uses'=>'Admin\VideoController@getCreate']);
		Route::post('create',['as'=>'admin.video.postCreate', 'uses'=>'Admin\VideoController@postCreate']);

		Route::get('edit/{id}',['as'=>'admin.video.getEdit', 'uses'=>'Admin\VideoController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.video.postEdit', 'uses'=>'Admin\VideoController@postEdit']);

		Route::get('delete/{id}',['as'=>'admin.video.delete','uses'=>'Admin\VideoController@delete']);
	});
	Route::group(['prefix'=>'partner'], function(){
		Route::get('/',['as'=>'admin.partner.index','uses'=>'Admin\PartnerController@getList']);
		Route::get('add',['as'=>'admin.partner.getAdd','uses'=>'Admin\PartnerController@getAdd']);
		Route::post('add',['as'=>'admin.partner.postAdd','uses'=>'Admin\PartnerController@postAdd']);

		Route::get('edit/{id}',['as'=>'admin.partner.getEdit','uses'=>'Admin\PartnerController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.partner.update','uses'=>'Admin\PartnerController@update']);

		Route::get('delete/{id}',['as'=>'admin.partner.getDelete','uses'=>'Admin\PartnerController@getDelete']);
		
		// Route::get('deleteList/{id}',['as'=>'admin.partner.getDeleteList','uses'=>'Admin\PartnerController@getDeleteList']);

	});
	Route::group(['prefix'=>'slogan'], function(){
		Route::get('/',['as'=>'admin.slogan.index','uses'=>'Admin\SloganController@index']);
		Route::get('create',['as'=>'admin.slogan.create','uses'=>'Admin\SloganController@getCreate']);
		Route::post('create',['as'=>'admin.slogan.postCreate','uses'=>'Admin\SloganController@postCreate']);
		Route::get('edit/{id}',['as'=>'admin.slogan.edit', 'uses'=>'Admin\SloganController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.slogan.postEdit', 'uses'=>'Admin\SloganController@postEdit']);
		Route::get('delete/{id}',['as'=>'admin.slogan.delete', 'uses' => 'Admin\SloganController@delete']);
	});
	
	
	Route::post('uploadImg', ['as'=>'admin.uploadImg' ,'uses'=>'Admin/UploadController@uploadImg']);
	Route::post('dropzone/store', ['as'=>'dropzone.store','uses'=>'Admin/ProductController@dropzoneStore']);

});
