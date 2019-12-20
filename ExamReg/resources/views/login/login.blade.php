<?php 
    //session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/login.css">
    <script src="../resources/js/jquery-3.4.1.min.js"></script>
    <title>login</title>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center no-gutters">
            <div class="bg-white" style="height: 600px;margin-top: 27px">
                <div class="header row">
                    <div class="mt-0 logo" style="background-image: url(image/background.png);">
                        <div class="logo1" style="background-image: url(image/logofinal.png);"></div>
                    </div>
                    <div class="name line">
                        <h1>ExamReg</h1>
                        <p>Exam Registration - Trang đăng kí lịch thi Trường đại học ABC</p>
                    </div>
                </div>
                <div class="login" style="margin: 10px 80px">
                    <form action="" class="form" id="formLogin">
                        <div class="box">
                            <div class="box-header bg-success">
                                <span class="text-white">
                                    Đăng nhập hệ thống
                                </span>
                            </div>
                            <div class="box-content">
                                <div class="form-group">
                                    <div class="with-icon-over-input">
                                        <label class="control-label" for="LoginName">Tên truy cập</label>
                                        <input class="form-control" placeholder="Tên truy cập" type="text" value="" id="LoginName"/>
                                        <span><i class="icon-user text-muted"></i></span>
                                    </div>
                                    <div id="checkLoginName" style="color:orange;"></div>
                                </div>
                                <div class="form-group">
                                    <div class="with-icon-over-input">
                                        <label class="control-label" for="Password">Mật khẩu</label>
                                        <input class="form-control" placeholder="Mật khẩu" type="password" id="Password"/>
                                        <span><i class="icon-lock text-muted"></i></span>
                                    </div>
                                    <div id="checkPassword" style="color:orange;"></div>
                                </div>
                                <div id="response" style="color:red;"></div>

                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a target="_blank" href="">Quên mật khẩu?</a>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-success float-right"><i class="icon-signin"></i> Đăng
                                                nhập</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/access/checkLoginData.js"></script>

    <script> 
    $(document).ready(function(){
        $("#formLogin").submit(function(){
            console.log("submit");
            if (checkLoginData() == true) {
                var username = $('#LoginName').val(); 
                var password = $('#Password').val();
                var _token = $('input[name="_token"]').val();

                console.log(username);
                console.log(password);
                $.ajax({
                    url:"{{route('checkLogin')}}",
                    method:"POST", 
                    data:{username:username, password: password, _token:_token},
                    success:function(data){ 
                        result = JSON.parse(data).result;
                        console.log(result);
                        if (result == 'correct') {
                            console.log("why?")    ;
                            window.location=""; //dieu phoi toi homepage ~ index
                        }
                        else $('#response').html(result);
                    }
                });
            }
            return false;
        });
    });
    </script>
</body>

</html>