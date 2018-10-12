<?php

    session_start();

    require_once(dirname(__FILE__) . "/dbconnect/db_check.php"); //$dbhが使えるようにした

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
										メールアドレス：
										<?php echo htmlspecialchars($signup_email); ?>
										</div><br>

										<div class="col-md-12" style="float: left padding-bottom: 10px">
											パスワード：
											*******<br>
										</div>

										<div>
											<img src="./user_profile_img/<?php echo $_SESSION['nexstage_test']['img_name']; ?>" width="100" height="100">
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