<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" type="text/css" href="../css/animate.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/line-awesome.css">
<link rel="stylesheet" type="text/css" href="../css/line-awesome-font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../lib/slick/slick.css">
<link rel="stylesheet" type="text/css" href="../lib/slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/responsive.css">
</head>


<body class="sign-in">
  

  <div class="wrapper">
    

    <div class="sign-in-page">
      <div class="signin-popup">
        <div class="signin-pop">
          <div class="row">


            <div class="col-lg-6">
              <div class="cmp-info">
                <div class="cm-logo">
                  <img src="images/logo4.png">
                  <p>目標をたてよう</p><br>
                  <p>ライバルを探そう</p><br>
                  <p>夢に向かって突き進もう</p>
                </div><!--cm-logo end-->  
                <img src="images/cm-main-img.png" alt="">     
              </div><!--cmp-info end-->
            </div>
            

            <div class="col-lg-6">
              <div class="login-sec">
                <ul class="sign-control">
                  <li data-tab="tab-1" class="current"><a href="{{ route('login') }}">サインイン</a></li>        
                  <li data-tab="tab-2"><a href="{{ route('register') }}">サインアップ</a></li>
                </ul>

                <!-- <ul>
                  <li><a href="{{ route('login') }}">Login</a></li>
                  <li><a href="{{ route('register') }}">Register</a></li>
                </ul>
 -->
                <div class="sign_in_sec current" id="tab-1">
                  <h1>サインイン</h1>
                  
                  <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf

                    <div class="form-group row">
                      <!-- <label for="email" class="col-sm-4 col-form-label text-md-right">メールアドレス</label> -->

                      <div class="col-md-12">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="メールアドレス" required autofocus>

                        @if ($errors->has('email'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <!-- <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label> -->

                      <div class="col-md-12">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="パスワード" required>

                        @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-8 offset-md-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                          <label class="form-check-label" for="remember" style="padding-top: 15px">
                            {{ __('Remember Me') }}
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                          {{ __('Login') }}
                        </button>

                        <a class="btn btn-link" href="{{ route('password.request') }}">
                          {{ __('Forgot Your Password?') }}
                        </a>
                      </div>
                    </div>
                  </form>


                  <div class="login-resources">
                    <h4>SNSアカウントでログインする</h4>
                    <ul>
                      <li><a href="#" title="" class="fb"><i class="fa fa-facebook"></i>Facebookでログイン</a></li>
                      <li><a href="#" title="" class="tw"><i class="fa fa-twitter"></i>Twitterでログイン</a></li>
                    </ul>
                  </div><!--login-resources end-->
                </div><!--sign_in_sec end-->
                <div class="sign_in_sec" id="tab-2">
                  <div class=""><!-- signup-tab -->
                  </div><!--signup-tab end--> 
                  <div class="dff-tab current" id="tab-3">
                    <form>
                      <div class="row">
                        <div class="col-lg-12 no-pdd">
                          <div class="sn-field">
                            <input type="text" name="name" placeholder="名前">
                            <i class="la la-user"></i>
                          </div>
                        </div>
                        <div class="col-lg-12 no-pdd">
                        </div>
                      </div>
                        <div class="col-lg-12 no-pdd">
                          <div class="sn-field">
                            <input type="text" name="mailadress" placeholder="メールアドレス">
                            <i class="la la-envelope"></i>
                          </div>
                        </div>
                        <div class="col-lg-12 no-pdd">
                          <div class="sn-field">
                            <input type="password" name="password" placeholder="パスワード">
                            <i class="la la-lock"></i>
                          </div>
                        </div>
                        <div class="col-lg-12 no-pdd">
                          <div class="sn-field">
                            <input type="password" name="repeat-password" placeholder="再度、パスワードを入力">
                            <i class="la la-lock"></i>
                          </div>
                        </div>
                        <div class="col-lg-12 no-pdd">
                          <div class="checky-sec st2">
                            <div class="fgt-sec">
                              <input type="checkbox" name="cc" id="c2">
                              <label for="c2">
                                <span></span>
                              </label>
                              <small>利用規約に同意する</small>
                            </div><!--fgt-sec end-->
                          </div>
                        </div>
                        <div class="col-lg-12 no-pdd">
                          <button type="submit" value="submit">登録</button>
                        </div>
                    </form>
                  </div><!--dff-tab end-->
                </div>
              </div><!--login-sec end-->
            </div>        
          </div>
        </div>    
      </div><!--signin-pop end-->
    </div><!--signin-popup end-->
      <div class="footy-sec">
        <div class="container">
          <ul>
            <li><a href="#" title="">Help Center</a></li>
            <li><a href="#" title="">Privacy Policy</a></li>
            <li><a href="#" title="">Community Guidelines</a></li>
            <li><a href="#" title="">Cookies Policy</a></li>
            <li><a href="#" title="">Career</a></li>
            <li><a href="#" title="">Forum</a></li>
            <li><a href="#" title="">Language</a></li>
            <li><a href="#" title="">Copyright Policy</a></li>
          </ul>
          <p><img src="images/copy-icon.png" alt="">Copyright 2018</p>
        </div>
      </div><!--footy-sec end-->
    </div><!--sign-in-page end-->


  </div><!--theme-layout end-->



<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>