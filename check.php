<?php

    session_start();

// ----ここからdbconnect.phpファイルにする-------

    $dsn = 'mysql:dbname=nexstage_test;host=localhost';

    $user ='root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    // SQL文にエラーがあった場合、画面にエラーを出力する設定
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


    // 文字コードの指定
    $dbh->query('SET NAMES utf8');

// ----ここまでdbconnect.phpファイルにする-------



    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    echo '<pre>';
    var_dump($_SESSION['nexstage_test']);
    echo '</pre>';

    $check = '';

    // echo $_SESSION['nexstage_test']['user_name'];

    if (!isset($_SESSION['nexstage_test'])) {
        // sign_inへ強制遷移させる
        header('Location: sign_in_logic.php');
    }

    $user_name = $_SESSION['nexstage_test']['user_name'];
    $user_id = $_SESSION['nexstage_test']['user_id'];
    $email = $_SESSION['nexstage_test']['email'];
    $user_password = $_SESSION['nexstage_test']['user_password'];

    if (!empty($_POST)) {
        echo "<br>" . "<br>";
        echo "通過";

        $hash_password = password_hash($user_password, PASSWORD_DEFAULT);


// ----ここからdbinsert.phpファイルにする-------

        // img_nameありSQL文
        // $sql = 'INSERT INTO `users` SET `user_name` = ?, `user_id` = id, `email` = ?, `password` = ?, `img_name` = ?, `created` = NOW()';

        // $data = [$user_name, $user_id, $email, $password, $img_name];

        // img_nameなしSQL文
        $sql = 'INSERT INTO `users` SET `user_name` = ?, `user_id` = ?, `email` = ?, `password` = ?, `created` = NOW()';

        $data = [$user_name, $user_id, $email, $hash_password];

        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        // DB切断
        $dbh = null;

// ----ここからdbinsert.phpファイルにする-------

        // 登録完了ページへ遷移
        header('Location: thanks.php');

        if ($check == 'back') {
        	header('Location: signup_and_in.php');
        }

    }


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

							<div class="sign_in_sec current">
								<div class="row">
									<div class="col-lg-12 no-pdd">

										<br>
										<br>
										<br>
										<br>

										<h3>登録内容確認</h3>
										<div class="col-md-12" style="float: left padding-bottom: 10px">
											ユーザー名：
											<?php echo htmlspecialchars($user_name); ?>
										</div><br>

										<div class="col-md-12" style="float: left padding-bottom: 10px">
											user_id：
											<?php echo htmlspecialchars($user_id); ?>
										</div><br>

										<div class="col-md-12" style="float: left padding-bottom: 10px">
										メールアドレス：
										<?php echo htmlspecialchars($email); ?>
										</div><br>

										<div class="col-md-12" style="float: left padding-bottom: 10px">
											パスワード：
											*******
										</div>

										<form action="check.php" method="POST">
											<button type="submit" name="check" value="back" style="margin-right:10px">戻る
											<button type="submit" name="check" value="register">登録
										</form>

									</div>
								</div>
							</div>



<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>