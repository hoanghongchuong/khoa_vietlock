@extends('admin.master')
@section('content')
@section('controller','Giới thiệu')
@section('action','List')
<!-- Content Header (Page header) -->

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
                
                <th>Tên</th>
                <!-- <th>Hình ảnh</th> -->
                <!-- <th class="text-center with_dieuhuong">Hoạt động</th> -->
                <th class="text-center with_dieuhuong">Sửa</th>
                <th class="text-center with_dieuhuong">Xóa</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $k=>$item)
              <tr>
                <!-- <td><input type="checkbox" name="chon" id="chon" value="{{$item->id}}" class="chon" /></td> -->
                <td class="text-center with_dieuhuong">{{$k+1}}</td>
                <td>
                  {{$item->name}}<br>
                  <p><a href="{{url('gioi-thieu/'.$item->alias)}}" target="_blank" title="">{{url('gioi-thieu/'.$item->alias)}}</a></p>
                </td>
                
                <td class="text-center with_dieuhuong">
                  <i class="fa fa-pencil fa-fw"></i><a href="backend/gioithieu/edit/{{$item->id}}">Edit</a>
                </td>
                <td class="text-center">
                  <i class="fa fa-trash-o fa-fw"></i><a onClick="if(!confirm('Xác nhận xóa')) return false;" href="backend/gioithieu/delete/{{$item->id}}">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div><!-- /.box-body -->
        <div class="box-footer col-md-12">
          <div class="row">
            <div class="col-md-6">
              <input type="button" onclick="javascript:window.location='backend/gioithieu/add'" value="Thêm" class="btn btn-primary" />
              <!-- <button type="button" id="xoahet" class="btn btn-success">Xóa</button> -->
              <input type="button" value="Thoát" onclick="javascript:window.location='backend'" class="btn btn-danger" />

            </div>
          </div>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
@endsection()
