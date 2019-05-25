<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quản trị website</title>
    <base href="{{ asset('admin') }}" >
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ url('public/admin_assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('public/admin_assets/plugins/datatables/dataTables.bootstrap.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('public/admin_assets/dist/css/styles.css') }}">
    <link rel="stylesheet" href="{{ url('public/admin_assets/dist/css/slimselect.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/admin_assets/plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{ url('public/admin_assets/dist/css/AdminLTE.min.css') }}">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ url('public/admin_assets/dist/css/skins/_all-skins.min.css') }}">
    <script type="text/javascript">
      function homeUrl(){
          return '{!! url('/') !!}'
      }
    </script>
    <!-- jQuery 2.1.4 -->
    <script src="{{ url('public/admin_assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
   <script src="{{ url('public/admin_assets/plugins/iCheck/icheck.min.js')}}"></script>
    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
    <script src="{{ asset('public/admin_assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{!! asset('public/admin_assets/plugins/tinymce/tinymce.min.js') !!}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!--<script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>-->

    <script src="{{ url('public/admin_assets/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ url('public/admin_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('public/admin_assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- Morris.js charts -->
    <!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ url('public/admin_assets/plugins/morris/morris.min.js') }}"></script>

    <script src="{{ url('public/admin_assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <script src="{{ url('public/admin_assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ url('public/admin_assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <script src="{{ url('public/admin_assets/plugins/knob/jquery.knob.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{ url('public/admin_assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ url('public/admin_assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    
    
    -->
    <script src="{{ url('public/admin_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ url('public/admin_assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ url('public/admin_assets/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('public/admin_assets/dist/js/app.min.js') }}"></script>

    <link href="{{ url('public/admin_assets/plugins/multiupload/assets/css/style.css') }}" rel="stylesheet" />

    <script src="{{ url('public/admin_assets/plugins/multiupload/assets/js/jquery.knob.js') }}"></script>

    <script src="{{ url('public/admin_assets/plugins/multiupload/assets/js/jquery.ui.widget.js') }}"></script>
    <script src="{{ url('public/admin_assets/plugins/multiupload/assets/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ url('public/admin_assets/plugins/multiupload/assets/js/jquery.fileupload.js') }}"></script>

    <script src="{{ url('public/admin_assets/plugins/multiupload/assets/js/script.js') }}"></script>
    <!-- <link rel="stylesheet" href="{{ asset('public/admin_assets/dropzone/dropzone.css') }}">
    <script src="{{ asset('public/admin_assets/dropzone/dropzone.min.js') }}"></script>
    
    <script type="text/javascript">
       Dropzone.options.myDropzone= {
           url: '{{ url('admin/uploadImg') }}',
           headers: {
               'X-CSRF-TOKEN': '{!! csrf_token() !!}'
           },
           autoProcessQueue: true,
           uploadMultiple: true,
           parallelUploads: 5,
           maxFiles: 10,
           maxFilesize: 5,
           acceptedFiles: ".jpeg,.jpg,.png,.gif",
           dictFileTooBig: 'Image is bigger than 5MB',
           addRemoveLinks: true,
           removedfile: function(file) {
           var name = file.name;    
           name =name.replace(/\s+/g, '-').toLowerCase();    /*only spaces*/
            $.ajax({
                type: 'POST',
                url: '{{ url('admin/deleteImg') }}',
                headers: {
                     'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                 },
                data: "id="+name,
                dataType: 'html',
                success: function(data) {
                    $("#msg").html(data);
                }
            });
          var _ref;
          if (file.previewElement) {
            if ((_ref = file.previewElement) != null) {
              _ref.parentNode.removeChild(file.previewElement);
            }
          }
          return this._updateMaxFilesReachedClass();
        },
        previewsContainer: null,
        hiddenInputContainer: "body",
       }
    </script>
    <style>
        .dropzone {
            border: 2px dashed #0087F7;
            border-radius: 5px;
            background: white;
        }
    </style> -->

    <!--<script src="{{ url('public/admin_assets/dist/js/pages/dashboard.js') }}"></script>-->
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('public/admin_assets/dist/js/demo.js') }}"></script>
    <script src="{{ url('public/admin_assets/dist/js/myscript.js') }}"></script>
    <script src="{{ url('public/admin_assets/dist/js/slimselect.min.js') }}"></script>
    
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      
      @include('admin.header')

      <!-- Left side column. contains the logo and sidebar -->
      @include('admin.menu')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        @yield('content')
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
      @include('admin.footer')
      <!-- Control Sidebar -->
      <?php /* @include('admin.controlsidebar') */ ?>
    </div><!-- ./wrapper -->
  </body>
</html>
