<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ url('public/admin_assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('public/admin_assets/dist/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('public/admin_assets/plugins/iCheck/square/blue.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <div class="page-icon animated bounceInDown">
             <i class="glyphicon glyphicon-user"></i>
        </div>
        <a href=""><b>Administrator</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <form action="{!! route('admin.auth.postLogin') !!}" name="frmLogin" method="post">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
          <div class="form-group has-feedback @if ($errors->first('username')!='') has-error @endif">
            <input type="text" name="username" class="form-control" placeholder="User name">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->first('username')!='')
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('username'); !!}</label>
            @endif
          </div>
          <div class="form-group has-feedback @if ($errors->first('password')!='') has-error @endif">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->first('password')!='')
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('password'); !!}</label>
            @endif
            @if (Session::has('flash_error'))
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ Session::get('flash_error') }}</label>
            @endif
          </div>
          <div class="row">
            <div class="col-xs-6">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
            <!-- <div class="col-xs-6">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div> -->
            
          </div>
        </form>

        <!--<div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div>-->
<!-- 
        <a href="#">I forgot my password</a><br>
        <a href="register" class="text-center">Register a new membership</a> -->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ url('public/admin_assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ url('public/admin_assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ url('public/admin_assets/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
