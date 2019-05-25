@extends('admin.master')
@section('content')
@section('controller','Danh mục '.$trang)
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
      if (hoi==true) document.location = homeUrl()+"/backend/newscate/"+listid+"/delete_list?type={{@$_GET[type]}}";
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
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        @if (session('status'))
        <div class="box-header">
            <h3 class="box-title alert_thongbao text-green">{{ session('status') }}</h3>
        </div>
        @endif
        <!--<div class="box-header">
          <h3 class="box-title">Data Table With Full Features</h3>
        </div>-->
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style="width: 20px;"><input type="checkbox" name="chonhet" class="minimal" id="chonhet" /></th>
                <th class="text-center with_dieuhuong">Stt</th>
               
                <!-- <th>Danh mục cha</th> -->
              
                <th>Tên danh mục</th>
                <!-- <th class="text-center with_dieuhuong">Hiển thị</th> -->
                <th class="text-center with_dieuhuong">Sửa</th>
                <th class="text-center with_dieuhuong">Xóa</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $k=>$item)
              <tr>
                <td><input type="checkbox" name="chon" id="chon" value="{{$item->id}}" class="chon" /></td>
                <td class="text-center with_dieuhuong">{{$k+1}}</td>
                
                <!-- <td>
                  <?php  $parent = DB::table('news_categories')->where('id', $item->parent_id)->where('com', @$_GET['type'])->first();
                  ?>
                  @if(!empty($parent))
                    {{ $parent->name }}
                  @else
                    {{ 'None' }}
                  @endif
                </td>
                -->
                <td>{{$item->name}}<br>
                
               </td>
                <!-- <td class="text-center with_dieuhuong">
                  @if($item->status>0)
                    <a href="backend/newscate/edit?id={{$item->id}}&hienthi={{ time() }}&type={{ @$_GET['type'] }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Bật</a>
                  @else
                    <a href="backend/newscate/edit?id={{$item->id}}&hienthi={{ time() }}&type={{ @$_GET['type'] }}" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i> Tắt</a>
                  @endif
                </td> -->
                <td class="text-center with_dieuhuong">
                  <i class="fa fa-pencil fa-fw"></i><a href="backend/newscate/edit?id={{$item->id}}&type={{ @$_GET['type'] }}">Edit</a>
                </td>
                <td class="text-center">
                  <i class="fa fa-trash-o fa-fw"></i><a onClick="if(!confirm('Xác nhận xóa')) return false;" href="backend/newscate/{{$item->id}}/delete?type={{ @$_GET['type'] }}">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div><!-- /.box-body -->
        <div class="box-footer col-md-12">
          <div class="col-md-6">
            <input type="button" onclick="javascript:window.location='backend/newscate/add?type={{ @$_GET[type] }}'" value="Thêm" class="btn btn-primary" />
            <button type="button" id="xoahet" class="btn btn-success">Xóa</button>
            <input type="button" value="Thoát" onclick="javascript:window.location='admin'" class="btn btn-danger" />

          </div>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
@endsection()
