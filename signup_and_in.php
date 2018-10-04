<?php
// -------------------------------------------------
// --------sign_check.phpの開始----------------------
// -------------------------------------------------

    session_start();

    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    // バリデーションを出すために$errorsという配列を用意した
    $errors = array();

    // ラジオボタンチェックの有無とサインイン＆サインアップページのバリデーションで戻ってきた時の値チェックで使用する
    $from = '';

    // フォームの値保持でechoの内容を出力させないために空文字を入れ初期化した
    $user_name = '';
    $user_id = '';
    $email = '';
    $user_password = '';
    $repeat_password = '';

// --------signin_checkの開始----------------------

    if (!empty($_POST) && $_POST['from'] == 'signin') {
        $email = $_POST['email'];
        $user_password = $_POST['user_password'];

        // バリデーション（emailとpasswordの空チェック）
        if ($email != '' && $user_password != '') {

// --------dbusercheck.phpの開始----------------------

            $sql = 'SELECT * FROM `users` WHERE `email` = ?';
            $data = [$email];
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);

            echo '<pre>';
            var_dump($stmt);
            echo '</pre>';

            $record = $stmt->fetch(PDO::FETCH_ASSOC);

            echo '<pre>';
            var_dump($record);
            echo '</pre>';

// --------dbusercheck.phpの終了----------------------

            // 登録されたメールアドレスかチェックする
            if ($record == false) {
                $errors['signin'] = 'failed';
            }

            // $passwordは、ユーザーが入力したパスワード
            // $record['password']は、データベースから取ってきたパスワード

            // passwordが一致するかチェック
            if (password_verify($user_password, $record['password'])) {
                // 認証成功
                // サインインするユーザーのidをセッションに保存
                $_SESSION['nexstage_test']['id'] = $record['id'];
                header('Location: timeline.php');
            } else {
                // 認証失敗
                $errors['signin'] = 'failed';
            }

            // データが1件読み込めれば存在するユーザーということでOK
            // データが0件なら、メールアドレスとパスワードの組み合わせが間違っているということでNG

        } else {
            // エラーを出す
            $errors['signin'] = 'blank';
        }
    }

// --------signin_checkの終了----------------------

// --------signup_checkの開始----------------------

    // 確認ボタンを押すと実行される処理
    // 未入力で確認ボタンを押した時も実行されるので注意
    if (!empty($_POST) && $_POST['from'] = 'signup') {
        // POST送信されてきた値を全て用意した変数に代入する
        $user_name = $_POST['user_name'];
        $user_id = $_POST['user_id'];
        $email = $_POST['email'];
        $user_password = $_POST['user_password'];
        $repeat_password = $_POST['repeat_password'];
        // $Kiyaku = $_POST['Kiyaku'];
        $from = $_POST['from'];

        if ($user_name == '') {
            $errors['user_name'] = '空';
        }

        if ($user_id == '') {
            $errors['user_id'] = '空';
        }

        if ($email == '') {
            $errors['email'] = '空';
        }

        $count = strlen($user_password);
        if ($user_password == '') {
            // パスワードの未入力チェック
            $errors['user_password'] = '空';
        } elseif ($count < 4 || 16 < $count) {
            // パスワードの文字数チェック
            $errors['user_password'] = '文字数';
        }

        if (empty($errors)) {
            $_SESSION['nexstage_test'] = $_POST;
            header('Location: check.php');
        }

    }

// --------signup_checkの終了----------------------

    echo '<pre>';
    var_dump($errors);
    echo '</pre>';

    echo '<pre>';
    var_dump($_SESSION['nexstage_test']);
    echo '</pre>';

// -------------------------------------------------
// --------sign_check.phpの終了----------------------
// -------------------------------------------------

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
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-12 no-pdd">
                                                <div class="sn-field">
                                                    <input type="text" name="username" placeholder="ユーザーネーム">
                                                    <i class="la la-user"></i>
                                                </div><!--sn-field end-->
                                            </div>
                                            <div class="col-lg-12 no-pdd">
                                                <div class="sn-field">
                                                    <input type="password" name="user_password" placeholder="パスワード">
                                                    <i class="la la-lock"></i>
                                                </div>
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
                                                <button type="submit" name="from" value="signin"><a href="timeline.html">サインイン</a>
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
                                                <div class="col-lg-12 no-pdd">
                                                </div>
                                            </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="text" name="user_id" placeholder="user_id">
                                                        <i class="la la-user"></i>
                                                    </div>
                                                </div>

                                                <?php if (isset($errors['user_id'])): ?>
                                                    <span class="red">user_idを入力してください</span>
                                                    <br><br>
                                                <?php endif; ?>

                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="text" name="email" placeholder="メールアドレス">
                                                        <i class="la la-envelope"></i>
                                                    </div>
                                                </div>

                                                <?php if (isset($errors['email'])): ?>
                                                    <span class="red">メールアドレスを入力してください</span>
                                                    <br><br>
                                                <?php endif; ?>

                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="password" name="user_password" placeholder="パスワードは4〜16字以内">
                                                        <i class="la la-lock"></i>
                                                    </div>
                                                </div>

                                                <?php if (isset($errors['user_password']) && $errors['user_password'] == '空'): ?>
                                                    <span class="red">パスワードを入力してください</span>
                                                    <br><br>
                                                <?php endif; ?>

                                                <?php if (isset($errors['user_password']) && $errors['user_password'] == '文字数'): ?>
                                                    <span class="red">パスワードは4〜16字以内で入力してください</span><br><br>
                                                <?php endif ?>

                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="password" name="repeat_password" placeholder="再度、パスワードを入力">
                                                        <i class="la la-lock"></i>
                                                    </div>
                                                </div>

                                                <?php if ($repeat_password != $user_password): ?>
                                                    <span class="red">同じパスワードを入力してください</span>
                                                <?php endif; ?>

                                                <div class="col-lg-12 no-pdd">
                                                    <div class="checky-sec st2">
                                                        <div class="fgt-sec">
                                                            <input type="checkbox" name="Kiyaku" id="c2">
                                                            <label for="c2">
                                                                <span></span>
                                                            </label>
                                                            <small>利用規約に同意する</small>
                                                        </div><!--fgt-sec end-->
                                                    </div>
                                                </div>
                                                <?php if (empty($_POST['Kiyaku']) && $from == 'signup'): ?>
                                                    <span class="red">規約に同意しチェックしてください</span><br><br>
                                                <?php endif ?>

                                                <div class="col-lg-12 no-pdd">
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