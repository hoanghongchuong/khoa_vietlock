@extends('admin.master')
@section('content')
@section('controller','Quản lý '.$trang)
@section('action','List')
<!-- Content Header (Page header) -->
<script type="text/javascript">
  $(document).ready(function() {
    $("#chonhet").click(function(){
      var status=this.checked;
      $("input[name='chon']").each(function(){this.checked=status;})
    });
    
    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
        })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = homeUrl()+"/backend/newsletter/"+listid+"/deleteList?type={{@$_GET[type]}}";
    });
    $("#send").click(function(){
      var listid="";
      $("input[name='chon[]']").each(function(){
        if (this.checked) listid = listid+","+this.value;
          })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn email nào"); return false;}
      hoi= confirm("Xác nhận muốn gửi thư đi?");
      if (hoi==true){ 
        document.frm.listid.value=listid; 
        document.frm.submit();
      }
    });

  });
</script>
<section class="content-header">
  <h1>
    @yield('controller')
    <small>@yield('action')</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="backend"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:">@yield('controller')</a></li>
    <li class="active">@yield('action')</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<form action="{{ route('admin.newsletter.postNewsLetter') }}" method="POST" name="frm" id="sendLetterForm" enctype="multipart/form-data">
  <input type="hidden" name="_token" value="{!! csrf_token() !!}">
  <input type="hidden" name="txtCom" value="{!! $_GET['type'] !!}">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        @include('admin.messages_error')
        <!--<div class="box-header">
          <h3 class="box-title">Data Table With Full Features</h3>
        </div>-->
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <!-- <th style="width: 20px;"><input type="checkbox" name="chonhet" class="minimal" id="chonhet" /></th> -->
                <th class="text-center with_dieuhuong">Stt</th>
                <!-- <th>Tên bài viết</th> -->
                <th>Email khách hàng</th>
                <th>Ngày gửi</th>
                <th class="text-center with_dieuhuong">Hoạt động</th>
                <th class="text-center with_dieuhuong">Sửa</th>
                <th class="text-center with_dieuhuong">Xóa</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $k=>$item)
              <tr>
                <!-- <td><input type="checkbox" name="chon[]" id="chon" value="{{$item->id}}" class="chon" /></td> -->
                <td class="text-center with_dieuhuong">{{$k+1}}</td>
                <!-- <td>{{$item->name}}</td> -->
                <td>{{$item->email}}</td>
                <td><?=date('d/m/Y',strtotime($item->created_at))?></td>
                <!-- <td><img src="{{ asset('upload/hinhanh/'.$item->photo) }}" onerror="this.src='{{ asset('public/admin_assets/images/no-image.jpg') }}';" class="img_product"  alt="NO PHOTO" /></td> -->
                <td class="text-center with_dieuhuong">
                  <div class="form-group"> 
                    @if($item->status>0)
                      <a href="backend/newsletter/edit?id={{$item->id}}&hienthi={{ time() }}&type={{ @$_GET['type'] }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Hiển thị</a>
                    @else
                      <a href="backend/newsletter/edit?id={{$item->id}}&hienthi={{ time() }}&type={{ @$_GET['type'] }}" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i> Hiển thị</a>
                    @endif
                  </div>
                  <!-- <div class="form-group"> 
                    @if($item->noibat>0)
                      <a href="admin/newsletter/edit?id={{$item->id}}&noibat={{ time() }}&type={{ @$_GET['type'] }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Nổi bật</a>
                    @else
                      <a href="admin/newsletter/edit?id={{$item->id}}&noibat={{ time() }}&type={{ @$_GET['type'] }}" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i> Nổi bật</a>
                    @endif
                  </div> -->
                </td>
                <td class="text-center with_dieuhuong">
                  <i class="fa fa-pencil fa-fw"></i><a href="backend/newsletter/edit?id={{$item->id}}&type={{ @$_GET['type'] }}">Edit</a>
                </td>
                <td class="text-center">
                  <i class="fa fa-trash-o fa-fw"></i><a onClick="if(!confirm('Xác nhận xóa')) return false;" href="backend/newsletter/{{$item->id}}/delete?type={{ @$_GET['type'] }}">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div><!-- /.box-body -->
        <div class="box-footer col-md-12">
          <div class="row">
            <div class="col-md-6">
              <input type="button" onclick="javascript:window.location='backend/newsletter/add?type={{ @$_GET[type] }}'" value="Thêm" class="btn btn-primary" />
              <!-- <button type="button" id="xoahet" class="btn btn-success">Xóa</button> -->
              <input type="button" value="Thoát" onclick="javascript:window.location='backend'" class="btn btn-danger" />

            </div>
          </div>
        </div>
        <div class="clearfix"></div>
       <!--  <div class="main_guimail">
          <div class="col-md-6 col-xs-12">
              <div class="form-group">
                  <label>Tiêu đề</label>
                  <input type="text" class="form-control" name="txtTitle" placeholder="Nhập tiêu đề thư">
              </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-12 col-xs-12">
              <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Nội dung</h3>
                        <div class="pull-right box-tools">
                          <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                          <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <div class="box-body pad">
                  <textarea name="txtContent" id="txtContent" cols="50" rows="5"></textarea>
                </div>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-success" id="addFile">Thêm tệp đính kèm</button> <br> <br>
                  <div id="insertBtnFile"></div>
              </div>
              <hr/>
              <div class="form-group">
                <button type="submit" class="btn btn-primary" id="send">Gửi email</button>
              </div>
          </div>
          <div class="clearfix"></div>
        </div>   -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</form>
</section><!-- /.content -->
@endsection()
