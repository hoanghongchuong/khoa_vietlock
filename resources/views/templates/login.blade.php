@extends('index')
@section('content')
<section class="vk-content">
    <div class="vk-page vk-page--signup">

        <div class="container">

            <nav class="vk-breadcrumb">
                <ul class="vk-list vk-list-inline vk-list-breadcrumb">
                    <li><a href="index.html">Trang chủ</a></li>

                    <li class="active">Đăng nhập</li>
                </ul>
            </nav>
            <!--./vk-breadcrumb-->
            <div class="row justify-content-center text-center">
                <div class="col-lg-4">
                    <h1 class="vk-signin__heading text-uppercase mb-5">Đăng nhập</h1>
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors ->all() as $error)
                          {!! $error !!}
                        @endforeach
                    </div>
                    @endif
                    @if(session('mess'))
                        <div class="alert-success alert">
                            {{session('mess')}}
                        </div>
                    @endif
                    <form action="{{route('postLogin')}}" method="post">
                        {{csrf_field()}}
                        <div class="vk-signin__form">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" name="email" placeholder="Email">
                                </div>
                            </div> <!--./form-group-->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                                </div>
                            </div> <!--./form-group-->
                            <div class="vk-button">
                                <button class="vk-btn btn-block text-uppercase">Đăng nhập</button>
                                <p></p>
                                <p class="vk-button__hint">
                                    <a href="signup.html" title="">Đăng ký</a>
                                    <a href="#" title="">Quên mật khẩu?</a>
                                </p>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div><!--./vk-page-->

</section>
@endsection