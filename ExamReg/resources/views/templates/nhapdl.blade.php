@extends('templates.homeadmin')
@section('content')
<h1>Nhập dữ liệu ở đây</h1>
<div id="nhaplieu" class="row" style="margin-left: 10px; font-family: 'times new roman'">
<div class="sinhvien col-md-4">
    
    <form action="{{url('nhapdulieu')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <p>Nhập danh sách sinh viên</p>
    <input type="file" name="file" id="file">
    <br></br>
    <button type="submit">Upload File</button>
    </form>
</div>
<div class="sinhvien col-md-4">
<form action="{{url('nhapdulieu')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <p>Nhập danh sách sinh viên đủ điều kiện</p>
    <input type="file" name="file" id="file">
    <br></br>
    <button type="submit">Upload File</button>
    </form>
</div>
<div class="sinhvien col-md-4">
<form action="{{url('nhapdulieu')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <p>Nhập danh sách sinh viên không đủ điều kiện</p>
    <input type="file" name="file" id="file">
    <br></br>
    <button type="submit">Upload File</button>
    </form>
</div>
@if(session('errors'))
    @foreach($errors as $error)
    <li style="color: red">{{$error}}</li>
    @endforeach
    @endif
    @if(session('success'))
    {{session('success')}}
    @endif
</div>
@endsection