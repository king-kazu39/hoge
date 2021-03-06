<?php

	session_start();

	require_once('dbconnect/dbconnect.php');

	// TODOリスト
	$signin_user_id = $_SESSION['nexstage_test']['id'];

// =========================================ここから左画面のユーザ名とユーザプロフィール画像取===========================================


	$sql = 'SELECT `name`,`img_name` FROM `users` WHERE `id` = ?';
    $data = [$signin_user_id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    // フェッチする
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


// =========================================ここまで左画面のユーザ名とユーザプロフィール画像取得===========================================

    // session_start();
    // // セッションの情報を破棄する
    // // $_SESSIOM変数の破棄
    // $_SESSION = [];
    // // サーバー内の$_SESSIONをクリア
    // session_destroy();
    // // サインアウト後の遷移
    // header("Location: signup_and_in.php");
    // exit();


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
								<a href="timeline.php" title="">
									<span><img src="images/icon1.png" alt=""></span>
									ホーム
								</a>
							</li>
							<li>
								<a href="plan.php" title="">
									<span><img src="images/ic1.png" alt=""></span>
									プラン
								</a>
							</li>
							<li>
								<a href="do.php" title="">
									<span><img src="images/ic2.png" alt=""></span>
									タスク
								</a>
							</li>
							<li>
								<a href="calender.php" title="">
									<span><img src="images/ic4.png" alt=""></span>
									チェック
								</a>
							</li>
							<!-- <li>
								<a href="ajust.php" title="">
									<span><img src="images/ic5.png" alt=""></span>
									Ajust
								</a>
							</li> -->
							<li>
								<a href="setting.php" title="">
									<span><img src="images/icon3.png" alt=""></span>
									設定
								</a>
							</li>
							<!-- <li>
								<a href="messages.php" title="" class="not-box-open">
									<span><img src="images/icon6.png" alt=""></span>
									メッセージ
								</a> -->
							</li>
						</ul>
					</nav><!--nav end-->
					</nav><!--nav end-->
					
					<div class="logo">
						<a href="timeline.php" title=""><img src="images/logo.png" alt=""></a>
					</div><!--logo end-->

					<div class="menu-btn">
						<a href="my-profile.php" title=""><i class="fa fa-bars"></i></a>
					</div><!--menu-btn end-->
					<div class="user-account">
						<div class="user-info">
							<img src="user_profile_img/<?= $user['img_name'] ?>" width="30" height="30" alt="">
							<a style="height:20px; font-size: 20px;" href=<?php echo "profile.php?user_id=".$signin_user_id; ?>><?php echo $user['name']; ?></a>
						</div>
					</div>
					<div class="search-bar">
						<ul class="flw-hr">
							<li><a href="search.php" title="" class="flww"><i class="la la-plus"></i>ライバル探す</a></li>
						</ul>
					</div><!--search-bar end-->
				</div><!--header-data end-->
			</div>
		</header><!--header end-->


		<section class="profile-account-setting">
			<div class="container">
				<div class="account-tabs-setting">
					<div class="row">
						<div class="col-lg-3">
							<div class="acc-leftbar">
								<div class="nav nav-tabs" id="nav-tab" role="tablist">
								    <a class="nav-item nav-link active" id="nav-acc-tab" data-toggle="tab" href="#nav-acc" role="tab" aria-controls="nav-acc" aria-selected="true"><i class="la la-cogs"></i>アカウント</a>
								    <a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false"><i class="fa fa-lock"></i>パスワードの変更</a>
								    <a class="nav-item nav-link" id="nav-notification-tab" data-toggle="tab" href="#nav-notification" role="tab" aria-controls="nav-notification" aria-selected="false"><i class="fa fa-flash"></i>通知</a>
								    <a class="nav-item nav-link" id="nav-requests-tab" data-toggle="tab" href="#nav-requests" role="tab" aria-controls="nav-requests" aria-selected="false"><i class="fa fa-group"></i>ライバル申請</a>
								    <a class="nav-item nav-link" id="nav-deactivate-tab" data-toggle="tab" href="#nav-deactivate" role="tab" aria-controls="nav-deactivate" aria-selected="false"><i class="fa fa-random"></i>アカウントの削除</a>
								  </div>
							</div><!--acc-leftbar end-->
						</div>
						<div class="col-lg-9">
							<div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active" id="nav-acc" role="tabpanel" aria-labelledby="nav-acc-tab">
									<div class="acc-setting">
										<h3>アカウント設定</h3>
										<form>
											<div class="notbar">
												<h4>通知音</h4>
												<p><br></p>
												<div class="toggle-btn">
													<a href="#" title=""><img src="images/up-btn.png" alt=""></a>
												</div>
											</div><!--notbar end-->
											<div class="notbar">
												<h4>メールの通知</h4>
												<p><br></p>
												<div class="toggle-btn">
													<a href="#" title=""><img src="images/up-btn.png" alt=""></a>
												</div>
											</div><!--notbar end-->
											<div class="notbar">
												<h4>メッセージの通知</h4>
												<p><br></p>
												<div class="toggle-btn">
													<a href="#" title=""><img src="images/up-btn.png" alt=""></a>
												</div>
											</div><!--notbar end-->
											<div class="save-stngs">
												<ul>
													<li><button type="submit">変更を保存</button></li>
													<li><button type="submit"><a href="signout.php">	ログアウト</a></button></li>
												</ul>
											</div><!--save-stngs end-->

										</form>
									</div><!--acc-setting end-->
								</div>
							  	<div class="tab-pane fade" id="nav-status" role="tabpanel" aria-labelledby="nav-status-tab">
							  	</div>
							  	<div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
							  		<div class="acc-setting">
										<h3>パスワードの変更</h3>
										<form>
											<div class="cp-field">
												<h5>現在のパスワード</h5>
												<div class="cpp-fiel">
													<input type="text" name="old-password" placeholder="現在のパスワード">
													<i class="fa fa-lock"></i>
												</div>
											</div>
											<div class="cp-field">
												<h5>新しいパスワード</h5>
												<div class="cpp-fiel">
													<input type="text" name="new-password" placeholder="新しいパスワード">
													<i class="fa fa-lock"></i>
												</div>
											</div>
											<div class="cp-field">
												<h5>再度、パスワードの入力</h5>
												<div class="cpp-fiel">
													<input type="text" name="repeat-password" placeholder="再度、パスワードの入力">
													<i class="fa fa-lock"></i>
												</div>
											</div>
											<div class="cp-field">
												<h5><a href="#" title="">パスワードを忘れた場合</a></h5>
											</div>
											<div class="save-stngs pd2">
												<ul>
													<li><button type="submit">設定を保存</button></li>
												</ul>
											</div><!--save-stngs end-->
										</form>
									</div><!--acc-setting end-->
							  	</div>
							  	<div class="tab-pane fade" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">
							  		<div class="acc-setting">
							  			<h3>通知</h3>
							  			<div class="notifications-list">
							  				<div class="notfication-details">
								  				<div class="noty-user-img">
								  					<img src="http://via.placeholder.com/35x35" alt="">
								  				</div>
								  				<div class="notification-info">
								  					<h3><a href="#" title="">たくぞーさん　</a> たくぞーさんがあなたの目標にいいねをしました</h3>
								  					<span>2分前</span>
								  				</div><!--notification-info -->
							  				</div><!--notfication-details end-->
							  				<div class="notfication-details">
								  				<div class="noty-user-img">
								  					<img src="http://via.placeholder.com/35x35" alt="">
								  				</div>
								  				<div class="notification-info">
								  					<h3><a href="#" title="">たくぞーさん　</a>たくぞーさんがあなたの目標にいいねをしました</h3>
								  					<span>2分前</span>
								  				</div><!--notification-info -->
							  				</div><!--notfication-details end-->
							  				<div class="notfication-details">
								  				<div class="noty-user-img">
								  					<img src="http://via.placeholder.com/35x35" alt="">
								  				</div>
								  				<div class="notification-info">
								  					<h3><a href="#" title="">たくぞーさん　</a>たくぞーさんがあなたの目標にいいねをしました</h3>
								  					<span>2分前</span>
								  				</div><!--notification-info -->
							  				</div><!--notfication-details end-->
							  				<div class="notfication-details">
								  				<div class="noty-user-img">
								  					<img src="http://via.placeholder.com/35x35" alt="">
								  				</div>
								  				<div class="notification-info">
								  					<h3><a href="#" title="">たくぞーさん　</a>たくぞーさんがあなたの目標にいいねをしました</h3>
								  					<span>2分前</span>
								  				</div><!--notification-info -->
							  				</div><!--notfication-details end-->
							  				<div class="notfication-details">
								  				<div class="noty-user-img">
								  					<img src="http://via.placeholder.com/35x35" alt="">
								  				</div>
								  				<div class="notification-info">
								  					<h3><a href="#" title="">たくぞーさん　</a>たくぞーさんがあなたの目標にいいねをしました</h3>
								  					<span>2分前</span>
								  				</div><!--notification-info -->
							  				</div><!--notfication-details end-->
							  				<div class="notfication-details">
								  				<div class="noty-user-img">
								  					<img src="http://via.placeholder.com/35x35" alt="">
								  				</div>
								  				<div class="notification-info">
								  					<h3><a href="#" title="">たくぞーさん　</a> たくぞーさんがあなたの目標にいいねをしました</h3>
								  					<span>2分前</span>
								  				</div><!--notification-info -->
							  				</div><!--notfication-details end-->
							  				<div class="notfication-details">
								  				<div class="noty-user-img">
								  					<img src="http://via.placeholder.com/35x35" alt="">
								  				</div>
								  				<div class="notification-info">
								  					<h3><a href="#" title="">たくぞーさん　</a>たくぞーさんがあなたの目標にいいねをしました</h3>
								  					<span>2分前</span>
								  				</div><!--notification-info -->
							  				</div><!--notfication-details end-->
							  				<div class="notfication-details">
								  				<div class="noty-user-img">
								  					<img src="http://via.placeholder.com/35x35" alt="">
								  				</div>
								  				<div class="notification-info">
								  					<h3><a href="#" title="">たくぞーさん　</a>たくぞーさんがあなたの目標にいいねをしました</h3>
								  					<span>2分前</span>
								  				</div><!--notification-info -->
							  				</div><!--notfication-details end-->
							  			</div><!--notifications-list end-->
							  		</div><!--acc-setting end-->
							  	</div>
							  	<div class="tab-pane fade" id="nav-requests" role="tabpanel" aria-labelledby="nav-requests-tab">
							  		<div class="acc-setting">
							  			<h3>ライバル申請</h3>
							  			<div class="requests-list">
							  				<div class="request-details">
							  					<div class="noty-user-img">
							  						<img src="http://via.placeholder.com/35x35" alt="">
							  					</div>
							  					<div class="request-info">
							  						<h3>ようま</h3>
							  						<span>スケートボーダー</span>
							  					</div>
							  					<div class="accept-feat">
							  						<ul>
							  							<li><button type="submit" class="accept-req">承認</button></li>
							  							<li><button type="submit" class="close-req"><i class="la la-close"></i></button></li>
							  						</ul>
							  					</div><!--accept-feat end-->
							  				</div><!--request-detailse end-->
							  				<div class="request-details">
							  					<div class="noty-user-img">
							  						<img src="http://via.placeholder.com/35x35" alt="">
							  					</div>
							  					<div class="request-info">
							  						<h3>ようま</h3>
							  						<span>スケートボーダー</span>
							  					</div>
							  					<div class="accept-feat">
							  						<ul>
							  							<li><button type="submit" class="accept-req">承認</button></li>
							  							<li><button type="submit" class="close-req"><i class="la la-close"></i></button></li>
							  						</ul>
							  					</div><!--accept-feat end-->
							  				</div><!--request-detailse end-->
							  				<div class="request-details">
							  					<div class="noty-user-img">
							  						<img src="http://via.placeholder.com/35x35" alt="">
							  					</div>
							  					<div class="request-info">
							  						<h3>ようま</h3>
							  						<span>スケートボーダー</span>
							  					</div>
							  					<div class="accept-feat">
							  						<ul>
							  							<li><button type="submit" class="accept-req">承認</button></li>
							  							<li><button type="submit" class="close-req"><i class="la la-close"></i></button></li>
							  						</ul>
							  					</div><!--accept-feat end-->
							  				</div><!--request-detailse end-->
							  				<div class="request-details">
							  					<div class="noty-user-img">
							  						<img src="http://via.placeholder.com/35x35" alt="">
							  					</div>
							  					<div class="request-info">
							  						<h3>ようま</h3>
							  						<span>スケートボーダー</span>
							  					</div>
							  					<div class="accept-feat">
							  						<ul>
							  							<li><button type="submit" class="accept-req">承認</button></li>
							  							<li><button type="submit" class="close-req"><i class="la la-close"></i></button></li>
							  						</ul>
							  					</div><!--accept-feat end-->
							  				</div><!--request-detailse end-->
							  				<div class="request-details">
							  					<div class="noty-user-img">
							  						<img src="http://via.placeholder.com/35x35" alt="">
							  					</div>
							  					<div class="request-info">
							  						<h3>ようま</h3>
							  						<span>スケートボーダー</span>
							  					</div>
							  					<div class="accept-feat">
							  						<ul>
							  							<li><button type="submit" class="accept-req">承認</button></li>
							  							<li><button type="submit" class="close-req"><i class="la la-close"></i></button></li>
							  						</ul>
							  					</div><!--accept-feat end-->
							  				</div><!--request-detailse end-->
							  				<div class="request-details">
							  					<div class="noty-user-img">
							  						<img src="http://via.placeholder.com/35x35" alt="">
							  					</div>
							  					<div class="request-info">
							  						<h3>ようま</h3>
							  						<span>スケートボーダー</span>
							  					</div>
							  					<div class="accept-feat">
							  						<ul>
							  							<li><button type="submit" class="accept-req">承認</button></li>
							  							<li><button type="submit" class="close-req"><i class="la la-close"></i></button></li>
							  						</ul>
							  					</div><!--accept-feat end-->
							  				</div><!--request-detailse end-->
							  			</div><!--requests-list end-->
							  		</div><!--acc-setting end-->
							  	</div>
							  	<div class="tab-pane fade" id="nav-deactivate" role="tabpanel" aria-labelledby="nav-deactivate-tab">
							  		<div class="acc-setting">
										<h3>アカウントの削除</h3>
										<form>
											<div class="cp-field">
												<h5>メールアドレス</h5>
												<div class="cpp-fiel">
													<input type="text" name="email" placeholder="メールアドレス">
													<i class="fa fa-envelope"></i>
												</div>
											</div>
											<div class="cp-field">
												<h5>パスワード</h5>
												<div class="cpp-fiel">
													<input type="password" name="password" placeholder="パスワード">
													<i class="fa fa-lock"></i>
												</div>
											</div>
											<div class="cp-field">
												<h5>削除理由</h5>
												<textarea></textarea>
											</div>
											<div class="cp-field">
												<div class="fgt-sec">
													<input type="checkbox" name="cc" id="c4">
													<label for="c4">
														<span></span>
													</label>
													<small>広告を受け取らない</small>
												</div>
											</div>
											<div class="save-stngs pd3">
												<ul>
													<li><button type="submit">設定を保存</button></li>
												</ul>
											</div><!--save-stngs end-->
										</form>
									</div><!--acc-setting end-->
							  	</div>
							</div>
						</div>
					</div>
				</div><!--account-tabs-setting end-->
			</div>
		</section>



		<footer>
			<div class="footy-sec mn no-margin">
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
					<p><img src="images/copy-icon2.png" alt="">Copyright 2018</p>
					<img class="fl-rgt" src="images/logo2.png" alt="">
				</div>
			</div>
		</footer>

	</div><!--theme-layout end-->



<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>


</body>
</html>