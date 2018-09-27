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
          <div class="logo">
            <a href="{{route('home')}}"><img src="images/logo3.png"></a>
          </div><!--logo end-->

          <div class="forum-bar">
            <!-- <h2>Forum</h2> -->
            <ul>
              <li><a href="{{ route('home') }}" title="">ホーム</a></li>
              <li><a href="{{ route('index') }}" title="">ライバルを探す</a></li>
              @guest
              @else
                  <li><a href="{{ route('create') }}" >目標を決める</a></li>
              @endguest
            </ul>
          </div><!--search-bar end-->

          @guest
            <div class="login_register">
              <ul>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
              </ul>
            </div><!--login_register end-->

          @else
            <div class="user-account">
              <div class="user-info">
                <img src="{{ Auth::user()->img_name }}" height="30px" width="30px">
                <a href="#" title="">{{Auth::user()->name}}</a>
                <i class="la la-sort-down"></i>
              </div>
              <div class="user-account-settingss">
                  <h3 class="tc"><a href="">myaccount</a></h3>
                  <h3 class="tc"><a href="{{ route('setting') }}">Setting</a></h3>
                  <h3 class="tc"><a href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">{{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </h3>
              </div><!--user-account-settingss end-->
            </div>
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

