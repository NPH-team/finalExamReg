<?php 
    session_start();
?>

@extends('admin.home')
@section('content')

<div class="importExcel" style="margin-left: 50px;">
    <form action="{{ url('/student') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <h5 style="color:green;"><b>Thêm danh sách và cấp tài khoản cho sinh viên</b></h5>
        <p><b>Select excel file to upload</b><p>
        <input type="file" name="file" id="file" style="display:block; margin-bottom:10px;">
        <button type="submit" style="display:block; margin-bottom:0px;">Upload File</button>

        <div class="errorImport" style="margin-left:25px;">
        @if (session('errors'))
            @foreach ($errors as $error)
                <li style="color:red;"> {{ $error }}</li>
            @endforeach
        @endif
        @if (session('success'))
            <span style="color: green;"> {{ session('success') }} </span>
        @endif
        
        </div>
    </form>
    <a href="{{ url('/sample/Students.xlsx') }}" style="margin-top:5px; display: block"> Download Sample </a>
</div>




<div class="acceptedData" style="margin:20px 30px 30px 20px;">
    <table border="1px" width="100%" id="loadata" class="table-responsive-md" style="font-family: 'times new roman';">
    @if (session('success'))
        <tr style="background-color: green; color: white;">
            <th style="text-align: center;">Số thứ tự</th>
            <th style="text-align: center;">Mã sv</th>
            <th style="text-align: center;">Tên</th>
            <th style="text-align: center;">Ngày sinh</th>
            <th style="text-align: center;">Lớp</th>
            <th style="text-align: center;">Giới tính</th>
            <th style="text-align: center;">Quê quán</th>
            <th style="text-align: center;">Username</th>
            <th style="text-align: center;">Password</th>
        </tr>
    @endif
    @if(session('datas'))   
        @foreach(session('datas') as $value)
            <tr>
                <td style="text-align: center;">{{ $value[0] }}</td>
                <td style="text-align: center;">{{$value[1]}}</td>
                <td style="text-align: center;">{{$value[2]}}</td>
                <td style="text-align: center;" class="ngay">{{$value[3]}}</td>
                <td style="text-align: center;">{{$value[4]}}</td>
                <td style="text-align: center;">{{$value[5]}}</td>
                <td style="text-align: center;">{{$value[6]}}</td>
                <td style="text-align: center;">{{$value[7]}}</td>
                <td style="text-align: center;">{{$value[8]}}</td>
            </tr>
        @endforeach 
    @endif
    </table>
    
</div>





@endsection