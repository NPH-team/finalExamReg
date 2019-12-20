<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="css/home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
</head>

<body>

    <body>
        <div class="d-flex" id="wrapper">
            <div class="border-right" id="sidebar-wrapper">
                <div class="logo" style="background-image: url(image/bg.png);">

                </div>
                <div class="list-group list-group-flush">
                    <a href="home" class="list-group-item list-group-item-action" style="background-color: #f4f4f4;font-family: 'Times New Roman';"><i class="fa fa-home"></i>     Trang chủ</a>

                    <a href="schedule" class="list-group-item list-group-item-action" style="background-color: #f4f4f4;font-family: 'Times New Roman';"><i class="fa fa-print"></i>     Đăng kí lịch thi</a>

                    <a href="inlich" class="list-group-item list-group-item-action" style="background-color: #f4f4f4;font-family: 'Times New Roman';"><i class="fa fa-print"></i>     In lịch thi</a>
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
                                <button class="btn nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid grey; background-color: green;color:white">Chào mừng:<span></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">See Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Logout</a>
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
        <script type="text/javascript" src="js/home.js"></script>
    </body>
    