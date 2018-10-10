<?php

    session_start();

    require_once(dirname(__FILE__) . "/dbconnect/dbsign.php");


?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>NexStage</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="shortcut icon" type="images/favicon.ico" href="images/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/animate.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css">
<style type="text/css"> .red{color: red;} </style>
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
                                    <img src="images/cm-logo.png" alt="">
                                    <p>目標をたてよう</p><br>
                                    <p>　ライバルを探そう</p><br>
                                    <p>　　夢に向かって突き進もう</p>
                                </div><!--cm-logo end-->
                                <img src="images/cm-main-img.png" alt="">
                            </div><!--cmp-info end-->
                        </div>

                        <div class="col-lg-6">
                            <div class="login-sec">
                                <ul class="sign-control">
                                    <?php if($from == ''): ?>
                                    <li data-tab="tab-1" class="current"><a href="#" title="">サインイン</a></li>
                                    <li data-tab="tab-2"><a href="#" title="">サインアップ</a></li>
                                    <?php elseif($from == 'signin'): ?>
                                    <li data-tab="tab-1" class="current"><a href="#" title="">サインイン</a></li>
                                    <li data-tab="tab-2"><a href="#" title="">サインアップ</a></li>
                                    <?php elseif($from == 'signup'): ?>
                                    <li data-tab="tab-1"><a href="#" title="">サインイン</a></li>
                                    <li data-tab="tab-2" class="current"><a href="#" title="">サインアップ
                                    <?php endif; ?>
                                </ul>

                            <?php if($from == '' || $from == 'signin'): ?>
                                <div class="sign_in_sec current" id="tab-1">
                            <?php else: ?>
                                <div class="sign_in_sec" id="tab-1">
                            <?php endif; ?>

                                    <h3>サインイン</h3>
                                    <form action="signup_and_in.php" method="POST">
                                        <div class="row">
                                            <div class="col-lg-12 no-pdd">
                                                <div class="sn-field">
                                                    <input type="text" name="signin_email" value="<?= $signin_email ?>" placeholder="メールアドレス">
                                                    <i class="la la-user"></i>
                                                </div><!--sn-field end-->
                                                <?php if(isset($errors['signin']) && $errors['signin'] == 'blank'): ?>
                                                    <span class="red">メールアドレスを正しく入力してください</span>
                                                    <br><br>
                                                <?php endif; ?>

                                            </div>
                                            <div class="col-lg-12 no-pdd">
                                                <div class="sn-field">
                                                    <input type="password" name="signin_password" placeholder="パスワード">
                                                    <i class="la la-lock"></i>
                                                </div>

                                            <?php if(isset($errors['signin']) && $errors['signin'] == 'blank'): ?>
                                                <span class="red">パスワードを正しく入力してください</span>
                                                <br><br>
                                            <?php endif; ?>

                                            </div>


                                            <div class="col-lg-12 no-pdd">
                                                <div class="checky-sec">
                                                    <div class="fgt-sec">
                                                        <input type="checkbox" name="cc" id="c1">
                                                        <label for="c1">
                                                            <span></span>
                                                        </label>
                                                        <small>保存する</small>
                                                    </div><!--fgt-sec end-->
                                                    <a href="#" title="">パスワード忘れた場合はこちらから</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 no-pdd">
                                                <button type="submit" name="from" value="signin">サインイン</a>
                                                </button>
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

                            <!-- signup_field_start -->
                            <?php if($from == '' || $from == 'signin'): ?>
                                <div class="sign_in_sec" id="tab-2">
                            <?php else: ?>
                                <div class="sign_in_sec current" id="tab-2">
                            <?php endif; ?>

                                    <div class=""><!-- signup-tab -->
                                    </div><!--signup-tab end-->
                                    <div class="dff-tab current" id="tab-3">
                                        <form target="_self" method="POST">
                                            <div class="row">
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="text" name="user_name" placeholder="ユーザーネーム">
                                                        <i class="la la-user"></i>
                                                    </div>
                                                </div>
                                                <?php if (isset($errors['user_name'])): ?>
                                                    <span class="red">ユーザ名を入力してください</span>
                                                    <br><br>
                                                <?php endif; ?>
                                            </div>

                                                <?php if (isset($errors['user_id'])): ?>
                                                    <span class="red">user_idを入力してください</span>
                                                    <br><br>
                                                <?php endif; ?>

                                                    <div class="sn-field">
                                                        <input type="text" name="signup_email" placeholder="メールアドレス">
                                                        <i class="la la-envelope"></i>
                                                    </div>

                                                <?php if (isset($errors['signup_email'])): ?>
                                                    <span class="red">メールアドレスを入力してください</span>
                                                    <br><br>
                                                <?php endif; ?>

                                                    <div class="sn-field">
                                                        <input type="password" name="signup_password" placeholder="パスワードは4〜16字以内">
                                                        <i class="la la-lock"></i>
                                                    </div>

                                                <?php if (isset($errors['signup_password']) && $errors['signup_password'] == '空'): ?>
                                                    <span class="red">パスワードを入力してください</span>
                                                    <br><br>
                                                <?php endif; ?>

                                                <?php if (isset($errors['signup_password']) && $errors['signup_password'] == '文字数'): ?>
                                                    <span class="red">パスワードは4〜16字以内で入力してください</span><br><br>
                                                <?php endif ?>

                                                    <div class="sn-field">
                                                        <input type="password" name="repeat_password" placeholder="再度、パスワードを入力">
                                                        <i class="la la-lock"></i>
                                                    </div>

                                                <?php if ($repeat_password != $signup_password): ?>
                                                    <span class="red">同じパスワードを入力してください</span>
                                                <?php endif; ?>

                                                <input type="file" style="border:none;padding-left:0px;">

                                                    <div class="checky-sec st2">
                                                        <div class="fgt-sec">
                                                            <input type="checkbox" name="Kiyaku" id="c2">
                                                            <label for="c2">
                                                                <span></span>
                                                            </label>
                                                            <small>利用規約に同意する</small>
                                                        </div><!--fgt-sec end-->
                                                    </div>

                                                <?php if (empty($_POST['Kiyaku']) && $from == 'signup'): ?>
                                                    <span class="red">規約に同意しチェックしてください</span><br><br>
                                                <?php endif ?>

                                                <div>
                                                    <button type="submit" name="from" value="signup">登録</button>
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