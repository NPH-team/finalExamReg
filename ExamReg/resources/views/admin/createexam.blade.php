<?php 
    //session_start();
?>

@extends('admin.home')
@section('content')

<div class='examData' style="margin-left: 50px;">
    <form id="tests" action="{{ url('/exam') }}"  method="POST" enctype="multipart/form-data"> 
        {{ csrf_field() }}
        <h5 style='color:green;'><b>Nhập tên mã kỳ</b></h5>
        <input type="text" id="maky" name="maky" placeholder='mã kỳ' value='new'>
        
        <br><br>
        <input type='submit' value='Create'>
        <br><br>
        
        @if (session('errors'))
            
            <li style="color:red;"> {{ session('errors') }}</li>

        @endif
        
        

        <?php /*
        @if (session('errors'))
            @foreach ($errors as $error)
                <li style="color:red;"> {{ $error }}</li>
            @endforeach
        @endif

        */
        if (isset($_SESSION['errors'])) dd($_SESSION['errors']);
        ?>
   <form>

@endsection