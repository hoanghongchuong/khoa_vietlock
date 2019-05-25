@extends('admin.master')
@section('content')
<section class="content-header">
  <h1>
    Quản lý color
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="backend"><i class="fa fa-dashboard"></i> Home</a></li>
    <!-- <li><a href="javascript:">Color</a></li> -->
    <li class="active">Color</li>
  </ol>
</section>

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
                <!-- <th style="width: 20px;"><input type="checkbox" name="chonhet" class="minimal" id="chonhet" /></th> -->
                <th class="text-center with_dieuhuong">Stt</th>
                
                <th>Tên</th>
                <th>Mã màu</th>
               	<th>Màu</th>
                <th class="text-center with_dieuhuong">Sửa</th>
                <th class="text-center with_dieuhuong">Xóa</th>
              </tr>
            </thead>
            <tbody>
              @foreach($colors as $key=>$item)
              <tr>
                <!-- <td><input type="checkbox" name="chon" id="chon" value="" class="chon" /></td> -->
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->code}}</td>                            
                <td><span style="background-color: {{ $item->code }}; width: 40px; height: 40px; display: block;"></span></td>
                <td class="text-center with_dieuhuong">
                  <i class="fa fa-pencil fa-fw"></i><a href="backend/color/edit/{{$item->id}}">Edit</a>
                </td>
                <td class="text-center">
                  <i class="fa fa-trash-o fa-fw"></i><a onClick="if(!confirm('Xác nhận xóa')) return false;" href="{{asset('backend/color/delete/'.$item->id)}}">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div><!-- /.box-body -->
        <div class="box-footer col-md-12">
          <div class="col-md-6">
            <input type="button" onclick="javascript:window.location='backend/color/create'" value="Thêm" class="btn btn-primary" />
            <!-- <button type="button" id="xoahet" class="btn btn-success">Xóa</button> -->
            <input type="button" value="Thoát" onclick="javascript:window.location='backend'" class="btn btn-danger" />

          </div>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
@endsection