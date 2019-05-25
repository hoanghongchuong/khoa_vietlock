@extends('index')
@section('content')
<section class="vk-content">
    <div class="vk-page vk-page--signup">

        <div class="container">

            <nav class="vk-breadcrumb">
                <ul class="vk-list vk-list-inline vk-list-breadcrumb">
                    <li><a href="index.html">Trang chủ</a></li>

                    <li class="active">Đăng ký</li>
                </ul>
            </nav>
            <!--./vk-breadcrumb-->
            <div class="row justify-content-center text-center">
                <div class="col-lg-4">
                    <h1 class="vk-signin__heading text-uppercase mb-5">Đăng ký tài khoản</h1>
                     @if(count($errors) > 0)
				        @foreach($errors ->all() as $error)
				        <p class="login-box-msg">
				          {!! $error !!}
				        </p>
				        @endforeach
				        @endif
					<form action="{{ route('postSignup') }}" method="post">
						{{ csrf_field() }}
	                    <div class="vk-signin__form">
	                        <div class="form-group">
	                            <div class="input-group">
	                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
	                                <input type="text" class="form-control" name="username" required="required" placeholder="Tài khoản hoặc SĐT">
	                            </div>
	                        </div> <!--./form-group-->
							<div class="form-group">
	                            <div class="input-group">
	                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
	                                <input type="email" class="form-control" name="email" required="required" placeholder="Email">
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <div class="input-group">
	                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
	                                <input type="text" class="form-control" name="name" required="required" placeholder="Họ và tên đầy đủ">
	                            </div>
	                        </div> <!--./form-group-->

	                        <div class="form-group">
	                            <div class="input-group">
	                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
	                                <input type="password" class="form-control" required="required" name="password" placeholder="Mật khẩu">
	                            </div>
	                        </div> <!--./form-group-->

	                        <div class="form-group">
	                            <div class="input-group">
	                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
	                                <input type="password" class="form-control" name="repassword" required="required" placeholder="Nhập lại mật khẩu">
	                            </div>
	                        </div> <!--./form-group-->

	                        <div class="form-group">
	                            <label class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input">
	                                <span class="custom-control-indicator"></span>
	                                <span class="custom-control-description">Tôi đồng ý những quy định quy chế của hệ thống</span>
	                            </label>
	                        </div> <!--./form-group-->

	                        <div class="vk-button">
	                            <button class="vk-btn btn-block text-uppercase" type="submit">Đăng ký</button>
	                            <p></p>
	                            <p class="vk-button__hint"><a href="signin.html" title="">Bạn đã có tài khoản? Đăng nhập ngay</a></p>
	                        </div>
	                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div><!--./vk-page-->

</section>
@endsection