<?php 
    //session_start();
?>
<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="css/homeadmin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"> </head>
    <script src="../resources/js/jquery-3.4.1.min.js"></script>

    <link rel = "stylesheet" href="css/exam.css">

</head>

<body>

    <body>
        <div class="d-flex" id="wrapper">
            <div class="border-right" id="sidebar-wrapper">
                <div class="logo" style="background-image: url(image/bg.png);">

                </div>
                <div class="list-group list-group-flush">
                    <a href="" class="list-group-item list-group-item-action" style="background-color: #f4f4f4;font-family: 'Times New Roman';color:black"><i class="fa fa-home"></i>&nbsp;&nbsp; Trang chủ</a>
                    <a href="student" class="list-group-item list-group-item-action" style="background-color: #f4f4f4;font-family: 'Times New Roman';color:black"><i class="fa fa-file"></i>&nbsp;&nbsp; Sinh viên</a>
                    <a href="subject" class="list-group-item list-group-item-action" style="background-color: #f4f4f4;font-family: 'Times New Roman';color:black"><i class="fa fa-file"></i>&nbsp;&nbsp; Học phần</a>
                    <button  id='exams' class="list-group-item list-group-item-action" style="background-color: #f4f4f4;font-family: 'Times New Roman';color:black"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp; Kỳ thi</button>
                    <div id='exam' class='none'>
                        @if (isset($_SESSION['semesters']))
                            @foreach ($_SESSION['semesters'] as $semester)
                            <a href="exam/{{$semester->maky}}" id='exams' class="list-group-item list-group-item-action" style="background-color: #c1e1d1;font-family: 'Times New Roman';color:black; font-size: 17px;"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;&nbsp; {{ $semester->maky }}</a>
                            @endforeach
                        @endif
                        <a href="exam" id='exams' class="list-group-item list-group-item-action" style="background-color: #c1e1d1;font-family: 'Times New Roman';color:black; font-size: 17px; padding : 10px 0 10px 20px;"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; New Exam</a>

                    </div>

                    <a href="testlist" class="list-group-item list-group-item-action" style="background-color: #f4f4f4;font-family: 'Times New Roman';color:black"><i class="fa fa-print"></i>&nbsp;&nbsp; Xuất Lịch thi</a>

                    <hr>

                </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">

                <nav class="navbar navbar-expand-lg navbar-light border-bottom">

                    <h1 class="" id="menu-toggle" style="line-height: 40px;"><strong style="font-size: 40;">EXAMREG</strong><br>
                        <p style="font-size: 25px;margin-bottom: -0.5rem;">Trang đăng kí lịch thi Trường đại học ABC</p>
                    </h1>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                 <span class="navbar-toggler-icon"></span>
                     </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-family: 'Times New Roman';">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <button class="btn nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid grey; background-color: green;color:white; margin-right:20px;"> <?php echo $_SESSION['login']; ?><span></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="margin-right:20px;">
                                    <a class="dropdown-item" href="#">See Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="maincontent" style="padding:0px 10px;">
                    <section id="content">
                        @yield('content')
                    </section>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/homeadmin.js"></script>
    </body>
    