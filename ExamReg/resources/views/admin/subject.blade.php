<?php 
    session_start();
?>

@extends('admin.home')
@section('content')

<div class="importSubject" style="margin-bottom:15px; margin-left: 50px;">
    <form action="{{ url('/subject/list') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <h5 style="color:green;"><b>1. Thêm danh sách học phần</b></h5>
        <p><b>Select excel file to upload</b><p>
        <input type="file" name="file" id="file" style="display:block; margin-bottom:10px;">
        <button type="submit" style="display:block; margin-bottom:0px;">Upload File</button>

    </form>
    <a href="{{ url('/sample/Subjects.xlsx') }}" style="margin-top:0px; display: block"> Download Sample </a>
</div>

<div class="importTested" style="margin-bottom:15px; margin-left: 50px;">
    <form action="{{ url('/subject/tested') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <h5 style="color:green;"><b>2. Thêm danh sách học phần sinh viên đủ điều kiện thi</b></h5>
        <p><b>Select excel file to upload</b><p>
        <input type="file" name="file" id="file" style="display:block; margin-bottom:10px;">
        <button type="submit" style="display:block; margin-bottom:0px;">Upload File</button>

    </form>
    <a href="{{ url('/sample/Tested.xlsx') }}" style="margin-top:0px; display: block"> Download Sample </a>
</div>

<div class="importNoTested" style="margin-bottom:15px; margin-left: 50px;">
    <form action="{{ url('/subject/notested') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <h5 style="color:green;"><b>3. Thêm danh sách học phần sinh viên không đủ điều kiện thi</b></h5>
        <p><b>Select excel file to upload</b><p>
        <input type="file" name="file" id="file" style="display:block; margin-bottom:10px;">
        <button type="submit" style="display:block; margin-bottom:0px;">Upload File</button>

    </form>
    <a href="{{ url('/sample/NoTested.xlsx') }}" style="margin-top:0px; display: block"> Download Sample </a>
</div>

<div class="errorImport" style="margin:0 0 20px 50px; clear: both">
    @if (session('errors'))
        @foreach ($errors as $error)
            <li style="color:red;"> {{ $error }}</li>
        @endforeach
    @endif
    @if (session('success'))
        <span style="color: green;"> {{ session('success') }} </span>
    @endif
    @if (session('successTested'))
        <span style="color: green;"> {{ session('successTested') }} </span>
    @endif
    @if (session('successNoTested'))
        <span style="color: green;"> {{ session('successNoTested') }} </span>
    @endif    
</div>


<div class="acceptedSubject" style="margin:0px 30px 0px 30px;">
    <table border="1px" width="100%" id="loadata" class="table-responsive-md" style="font-family: 'times new roman';">
    @if (session('success'))
        <b>Danh sách học phần được thêm vào thành công </b>
        <tr style="background-color: green; color: white;">
            <th style="text-align: center;">Số thứ tự</th>
            <th style="text-align: center;">Mã học phần</th>
            <th style="text-align: center;">Tên học phần</th>
            <th style="text-align: center;">Số tín chỉ</th>
        </tr>
    @endif
    @if(session('datas')) 
        @foreach(session('datas') as $value)
            <tr>
                <td style="text-align: center;">{{ $value[0] }}</td>
                <td style="text-align: center;">{{ $value[1] }}</td>
                <td style="text-align: center;">{{ $value[2] }}</td>
                <td style="text-align: center;">{{ $value[3] }}</td>
            </tr>
        @endforeach 
    @endif
    </table>
</div>

<div class="acceptedTested" style="margin:0px 30px 0px 30px;">
    <table border="1px" width="100%" id="loadata" class="table-responsive-md" style="font-family: 'times new roman';">
    @if (session('successTested'))
        <b>Danh sách học phần sinh viên đủ điều kiện thi </b>
        <tr style="background-color: green; color: white;">
            <th style="text-align: center;">Số thứ tự</th>
            <th style="text-align: center;">Mã kỳ</th>
            <th style="text-align: center;">Mã sinh viên</th>
            <th style="text-align: center;">Mã học phần</th>
        </tr>
    @endif
    @if(session('dataTested')) 
        @foreach(session('dataTested') as $value)
            <tr>
                <td style="text-align: center;">{{ $value[0] }}</td>
                <td style="text-align: center;">{{ $value[1] }}</td>
                <td style="text-align: center;">{{ $value[2] }}</td>
                <td style="text-align: center;">{{ $value[3] }}</td>
            </tr>
        @endforeach 
    @endif
    </table>
</div>

<div class="acceptedNoTested" style="margin:0px 30px 30px 30px;">
    <table border="1px" width="100%" id="loadata" class="table-responsive-md" style="font-family: 'times new roman';">
    @if (session('successNoTested'))
        <b>Danh sách học phần sinh viên không đủ điều kiện thi </b>
        <tr style="background-color: green; color: white;">
            <th style="text-align: center;">Số thứ tự</th>
            <th style="text-align: center;">Mã kỳ</th>
            <th style="text-align: center;">Mã sinh viên</th>
            <th style="text-align: center;">Mã học phần</th>
        </tr>
    @endif
    @if(session('dataNoTested')) 
        @foreach(session('dataNoTested') as $value)
            <tr>
                <td style="text-align: center;">{{ $value[0] }}</td>
                <td style="text-align: center;">{{ $value[1] }}</td>
                <td style="text-align: center;">{{ $value[2] }}</td>
                <td style="text-align: center;">{{ $value[3] }}</td>
            </tr>
        @endforeach 
    @endif
    </table>
</div>

@endsection