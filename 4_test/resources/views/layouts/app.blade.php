<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>チームようま</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <link rel="stylesheet" type="text/css" href="css/animate.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/line-awesome.css">
  <link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
  <link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
  <link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/responsive.css">

</head>
<body>
  <div class="wrapper">
      
    <header>
      <div class="container">
        <div class="header-data">
          <nav>
            <ul>
              <li>
                <a href="{{route('home')}}" title="">
                  <span><img src="images/icon1.png" alt=""></span>
                  ホーム
                </a>
              </li>
              <li>
                <a href="{{route('create')}}" title="">
                  <span><img src="images/icon2.png" alt=""></span>
                  プラン
                </a>
                <!-- <ul>
                  <li><a href="#" title="">Plan</a></li>
                  <li><a href="#" title="">Do</a></li>
                  <li><a href="#" title="">Check</a></li>
                  <li><a href="#" title="">Ajust</a></li>
                </ul> -->
              </li>
              <li>
                <a href="{{ route('setting') }}" title="">
                  <span><img src="images/icon3.png" alt=""></span>
                  設定
                </a>
              </li>
              <li>
                <a href="" title="" class="not-box-open">
                  <span><img src="images/icon6.png" alt=""></span>
                  メッセージ
                </a>
              </li>
            </ul>
          </nav><!--nav end-->
          
          <div class="logo">
            <a href="{{route('home')}}" title=""><img src="images/logo3.png" alt=""></a>
          </div><!--logo end-->

          <div class="menu-btn">
            <a href="" title=""><i class="fa fa-bars"></i></a>
          </div><!--menu-btn end-->

          @guest
          @else
            <div class="user-account">
              <div class="user-info">
                <img src="{{ Auth::user()->img_name }}" height="30px" width="30px">
                <a href="{{route('show', Auth::user()->id)}}" >{{ Auth::user()->name }}</a>
              </div>
            </div>

            <div class="search-bar">
              <ul class="flw-hr">
                <li><a href="{{ route('index') }}" title="" class="flww"><i class="la la-plus"></i>ライバル探す</a></li>
              </ul>
            </div><!--search-bar end-->
          @endguest  
        </div><!--header-data end-->
      </div>
    </header><!--header end-->

    @yield('content')
      
  </div>

  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/popper.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>
  <script type="text/javascript" src="lib/slick/slick.min.js"></script>
  <script type="text/javascript" src="js/scrollbar.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>
</html>

