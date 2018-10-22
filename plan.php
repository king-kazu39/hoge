
	<?php 

	session_start();

		require_once('dbconnect/dbconnect.php');


		// echo "<pre>";
		// var_dump($_SESSION);
		// echo "</pre>";


		$sigin_user_id = '';
		$target = '';
		$category = '';
		$freq = '';
		$goal = '';



// ================================左の目標一覧============================================================
		// TODOリスト
		$sigin_user_id = $_SESSION['nexstage_test']['id'];
		// $sigin_user_id = 5;


		$sql = "SELECT `t`.*, `u`.`id` , `u`.`img_name` 
				FROM `targets` AS `t` LEFT JOIN `users` AS `u` 
				ON `t`.`user_id` = `u`.`id` WHERE `t`.`user_id` = ? ORDER BY `t`.`created` DESC LIMIT 3";
		$data = [$sigin_user_id];
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);


		$targets = [];

		while (true) {
			// レコードは無くなるまで取得処理
			
			$record = $stmt->fetch(PDO::FETCH_ASSOC);
			// もし取得するものがなくなったら処理を抜ける
			if ($record == false) {
				break;
			}
			// レコードがあれば追加
			$targets[] = $record;
		}

// =============================ここまでが左の目標一覧========================================================

		// echo "<pre>";
		// var_dump($targets);
		// echo "</pre>";





		$errors = [];


		if (!empty($_POST)) {
			// 宣言する！ボタンを押すとこのif文が実行されます


			// $sigin_user_id = $_SESSION['user_id'];
			$sigin_user_id = 5;
			$target = $_POST['target'];
			$category = $_POST['category'];
			$freq = $_POST['freq'];
			$goal = $_POST['goal'];

			
			// もし、入力されていなかったら
			if ($target == '') {
				$errors['target'] = '空';
			}
			if ($category == '') {
				$errors['category'] = '空';
			}
			if ($freq == '') {
				$errors['freq'] = '空';
			}
			if ($goal == '') {
				$errors['goal'] = '空';
			}

			if (empty($errors)) {
				// エラーがなかったら登録処理
				$sql = 'INSERT INTO `targets` SET `user_id` = ?, `target` = ?, `category` = ?, `freq` = ?, `goal` = ?, `created` = NOW(), `updated` = NOW()';

				$data = [$sigin_user_id, $target, $category, $freq, $goal];
				$stmt = $dbh->prepare($sql);
				$stmt->execute($data);

				header('Location: plan.php');
				exit();
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
<link rel="stylesheet" type="text/css" href="css/jquery.range.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
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
									Plan
								</a>
							</li>
							<li>
								<a href="do.php" title="">
									<span><img src="images/ic2.png" alt=""></span>
									Do
								</a>
							</li>
							<li>
								<a href="calender.php" title="">
									<span><img src="images/ic4.png" alt=""></span>
									Check
								</a>
							</li>
							<li>
								<a href="ajust.php" title="">
									<span><img src="images/ic5.png" alt=""></span>
									Ajust
								</a>
							</li>
							<li>
								<a href="setting.php" title="">
									<span><img src="images/icon3.png" alt=""></span>
									設定
								</a>
							</li>
							<li>
								<a href="messages.php" title="" class="not-box-open">
									<span><img src="images/icon6.png" alt=""></span>
									メッセージ
								</a>
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
							<img src="http://via.placeholder.com/30x30" alt="">
							<a href="my-profile.php" title="">井上　侑弥</a>
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

		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
							<div class="col-lg-4 col-md-4 pd-left-none no-pd">
								<div class="user-data full-width">
										<div class="user-profile">
											<div class="username-dt">
												<div class="usr-pic">
													<a href="my-profile.php"><img src="http://via.placeholder.com/100x100" class="rounded-circle"></a>
												</div>
											</div><!--username-dt end-->
											<div class="user-specs">
												<h3>井上　侑弥</h3>
												<span>@takuzoo</span>
											</div>
										</div><!--user-profile end-->
											<ul class="flw-status">
												<li>
													<a href="search.php">
														<span>目標数</span>
														<b>34</b>
													</a>
												</li>
												<li>
													<a href="rivals.php">
														<span>ライバル</span>
														<b>155</b>
													</a>
												</li>
											</ul>




									</div><!--user-data end-->
									<div class="suggestions full-width">
										<div class="sd-title">
											<h3>自分の目標</h3>
											<i class="la la-ellipsis-v"></i>
										</div><!--sd-title end-->
										
									<?php foreach ($targets as $target): ?>
										<div class="suggestions-list">
											<div class="suggestion-usd">
												<img src= "user_profile_img/<?php echo $target['img_name']; ?>" width = "40" >
												<div class="sgt-text">
													<h4><a href="my-profile.php"><?php echo $target['target']; ?></a></h4>
													<span><?php echo $target['goal']; ?></span>
													<span><?php echo $target['category']; ?></span>
												</div>
												
												<!-- <span><i class="la la-plus"></i></span> -->
											</div>
											<!-- <div class="view-more">
												<p>カテゴリ名</p>
												<a href="#" title="">View More</a>
											</div> -->
										</div><!--suggestions-list end-->
									<?php endforeach; ?>

										
									</div><!--suggestions end-->
							</div>
							<div class="col-lg-8">
				<div class="product-feed-tab current" id="feed-dd">
					<div class="posts-section">
						<div class="post-bar">
							<div class="post_topbar">
								<div class="usy-dt">
									<div class="usy-name">
										<h3>達成目標</h3>
									</div>
								</div>
							</div>
											
					<div class="post-project-fields">
					<form action="plan.php" method="POST">
						<div class="row">
							<div class="col-lg-12">
								<input type="text" name="target" placeholder="目標の入力">
								<?php if (isset($errors['target']) && $errors['target'] == '空'): ?>
								<span style="color: red;">目標を入力してください</span>
								<?php endif; ?>
							</div>
							<div class="col-lg-12">
								<div class="inp-field" >
									<select name="category">
										<option value="">カテゴリ</option>
										<option>健康</option>
										<option>お金</option>
										<option>仕事</option>
										<option>家族</option>
										<option>教育</option>
										<option>精神</option>
										<option>楽しみ</option>
									</select>
								</div>
								<?php if (isset($errors['category']) && $errors['category'] == '空'): ?>
								<span style="color: red;">選択してください</span>
								<?php endif; ?>
							</div>
							<div class="col-lg-12">
								<div class="inp-field">

									<select name="freq">
										<option value="">確認頻度</option>
										<option>DAY</option>
										<option>WEEK</option>
										<option>MONTH</option>
										
									</select>
								</div>
								<?php if (isset($errors['freq']) && $errors['freq'] == '空'): ?>
								<span style="color: red;">選択してください</span>
								<?php endif; ?>
							</div>
							<div class="col-lg-6">
								<div class="">
									<!-- <p>目標達成日予定</p> -->
									<input type="date" name="goal">
								</div>
								<?php if (isset($errors['goal']) && $errors['goal'] == '空'): ?>
								<span style="color: red;">達成予定日をしてください</span>
								<?php endif; ?>
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="post">宣言する！</button></li>
									<li><a href="#" title="">考え直す</a></li>
								</ul>
							</div>
						</div>
					</form>
					</div><!--post-project-fields end-->


						</div><!--post-bar end-->
					</div><!--posts-section end-->
				</div><!--product-feed-tab end-->

				<div class="product-feed-tab" id="info-dd">
					<div class="posts-section">
						<div class="post-bar">
							<div class="post_topbar">
								<div class="usy-dt">				
									<img src="http://via.placeholder.com/50x50" alt="">
									<div class="usy-name">
										<h3>ようま</h3>
											<span><img src="images/clock.png" alt="">3分前</span>
									</div>
								</div>
								<div class="ed-opts">
									<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
										<ul class="ed-options">
											<li><a href="#" title="">編集</a></li>
											<li><a href="#" title="">閉じる</a></li>
											<li><a href="#" title="">非表示</a></li>
										</ul>
								</div>
									1		</div>
											<div class="epi-sec">
												<ul class="descp">
													<li><img src="images/icon8.png" alt=""><span>Epic Coder</span></li>
													<li><img src="images/icon9.png" alt=""><span>India</span></li>
												</ul>
												<ul class="bk-links">
													<li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
													<li><a href="#" title=""><i class="la la-envelope"></i></a></li>
												</ul>
											</div>
											<div class="job_descp">
												<h3>沖縄制覇</h3>
												<ul class="job-dt">
													<li><a href="#" title="">2018年10月28日</a></li>
												</ul>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="#" title="">もっと見る</a></p>
												<ul class="skill-tags">
													<li><a href="#" title="">健康</a></li>
													<li><a href="#" title="">お金</a></li>
													<li><a href="#" title="">仕事</a></li>
													<li><a href="#" title="">家族</a></li>
													<li><a href="#" title="">教育</a></li> 	
												</ul>
											</div>
											<div class="job-status-bar">
												<ul class="like-com">
													<li>
														<a href="#"><i class="la la-heart"></i>いいね</a>
														<img src="images/liked-img.png" alt="">
														<span>25</span>
													</li> 
													<li><a href="#" title="" class="com"><img src="images/com.png" alt="">コメント 15</a></li>
												</ul>
												<a><i class="la la-eye"></i>閲覧数 50</a>
											</div>
										</div><!--post-bar end-->
										</div><!--posts-section end-->
									</div><!--product-feed-tab end-->

									<div class="product-feed-tab" id="saved-jobs">
										<div class="posts-section">
											<div class="post-bar">
											<div class="post_topbar">
												<div class="usy-dt">
													<img src="http://via.placeholder.com/50x50" alt="">
													<div class="usy-name">
														<h3>かずやさん</h3>
														<span><img src="images/clock.png" alt="">3分前</span>
													</div>
												</div>
												<div class="ed-opts">
													<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
													<ul class="ed-options">
														<li><a href="#" title="">編集</a></li>
														<li><a href="#" title="">閉じる</a></li>
														<li><a href="#" title="">非表示</a></li>
													</ul>
												</div>
											</div>
											<div class="epi-sec">
												<ul class="descp">
													<li><img src="images/icon8.png" alt=""><span>Epic Coder</span></li>
													<li><img src="images/icon9.png" alt=""><span>India</span></li>
												</ul>
												<ul class="bk-links">
													<li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
													<li><a href="#" title=""><i class="la la-envelope"></i></a></li>
												</ul>
											</div>
											<div class="job_descp">
												<h3>沖縄制覇</h3>
												<ul class="job-dt">
													<li><a href="#" title="">2018年10月28日</a></li>
												</ul>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="#" title="">もっと見る</a></p>
												<ul class="skill-tags">
													<li><a href="#" title="">健康</a></li>
													<li><a href="#" title="">お金</a></li>
													<li><a href="#" title="">仕事</a></li>
													<li><a href="#" title="">家族</a></li>
													<li><a href="#" title="">教育</a></li> 	
												</ul>
											</div>
											<div class="job-status-bar">
												<ul class="like-com">
													<li>
														<a href="#"><i class="la la-heart"></i>いいね</a>
														<img src="images/liked-img.png" alt="">
														<span>25</span>
													</li> 
													<li><a href="#" title="" class="com"><img src="images/com.png" alt="">コメント 15</a></li>
												</ul>
												<a><i class="la la-eye"></i>閲覧数 50</a>
											</div>
										</div><!--post-bar end-->
										</div><!--posts-section end-->
									</div><!--product-feed-tab end-->

									
									<div class="product-feed-tab" id="my-bids">
										<div class="posts-section">
											<div class="post-bar">
											<div class="post_topbar">
												<div class="usy-dt">
													<img src="http://via.placeholder.com/50x50" alt="">
													<div class="usy-name">
														<h3>かずやさん</h3>
														<span><img src="images/clock.png" alt="">3分前</span>
													</div>
												</div>
												<div class="ed-opts">
													<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
													<ul class="ed-options">
														<li><a href="#" title="">編集</a></li>
														<li><a href="#" title="">閉じる</a></li>
														<li><a href="#" title="">非表示</a></li>
													</ul>
												</div>
											</div>
											<div class="epi-sec">
												<ul class="descp">
													<li><img src="images/icon8.png" alt=""><span>Epic Coder</span></li>
													<li><img src="images/icon9.png" alt=""><span>India</span></li>
												</ul>
												<ul class="bk-links">
													<li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
													<li><a href="#" title=""><i class="la la-envelope"></i></a></li>
												</ul>
											</div>
											<div class="job_descp">
												<h3>沖縄制覇</h3>
												<ul class="job-dt">
													<li><a href="#" title="">2018年10月28日</a></li>
												</ul>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="#" title="">もっと見る</a></p>
												<ul class="skill-tags">
													<li><a href="#" title="">健康</a></li>
													<li><a href="#" title="">お金</a></li>
													<li><a href="#" title="">仕事</a></li>
													<li><a href="#" title="">家族</a></li>
													<li><a href="#" title="">教育</a></li> 	
												</ul>
											</div>
											<div class="job-status-bar">
												<ul class="like-com">
													<li>
														<a href="#"><i class="la la-heart"></i>いいね</a>
														<img src="images/liked-img.png" alt="">
														<span>25</span>
													</li> 
													<li><a href="#" title="" class="com"><img src="images/com.png" alt="">コメント 15</a></li>
												</ul>
												<a><i class="la la-eye"></i>閲覧数 50</a>
											</div>
										</div><!--post-bar end-->
										</div><!--posts-section end-->
									</div><!--product-feed-tab end-->

									<div class="product-feed-tab" id="portfolio-dd">
										<div class="portfolio-gallery-sec">
											<h3>Portfolio</h3>
											<div class="gallery_pf">
												<div class="row">
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="http://via.placeholder.com/271x174" alt="">
															<a href="#" title=""><img src="images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="http://via.placeholder.com/170x170" alt="">
															<a href="#" title=""><img src="images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="http://via.placeholder.com/170x170" alt="">
															<a href="#" title=""><img src="images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="http://via.placeholder.com/170x170" alt="">
															<a href="#" title=""><img src="images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="http://via.placeholder.com/170x170" alt="">
															<a href="#" title=""><img src="images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="http://via.placeholder.com/170x170" alt="">
															<a href="#" title=""><img src="images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="http://via.placeholder.com/170x170" alt="">
															<a href="#" title=""><img src="images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="http://via.placeholder.com/170x170" alt="">
															<a href="#" title=""><img src="images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="http://via.placeholder.com/170x170" alt="">
															<a href="#" title=""><img src="images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="http://via.placeholder.com/170x170" alt="">
															<a href="#" title=""><img src="images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
												</div>
											</div><!--gallery_pf end-->
										</div><!--portfolio-gallery-sec end-->
									</div><!--product-feed-tab end-->
									<div class="product-feed-tab" id="payment-dd">
										<div class="billing-method">
											<ul>
												<li>
													<h3>Add Billing Method</h3>
													<a href="#" title=""><i class="fa fa-plus-circle"></i></a>
												</li>
												<li>
													<h3>See Activity</h3>
													<a href="#" title="">View All</a>
												</li>
												<li>
													<h3>Total Money</h3>
													<span>$0.00</span>
												</li>
											</ul>
											<div class="lt-sec">
												<img src="images/lt-icon.png" alt="">
												<h4>All your transactions are saved here</h4>
												<a href="#" title="">Click Here</a>
											</div>
										</div><!--billing-method end-->
										<div class="add-billing-method">
											<h3>Add Billing Method</h3>
											<h4><img src="images/dlr-icon.png" alt=""><span>With workwise payment protection , only pay for work delivered.</span></h4>
											<div class="payment_methods">
												<h4>Credit or Debit Cards</h4>
												<form>
													<div class="row">
														<div class="col-lg-12">
															<div class="cc-head">
																<h5>Card Number</h5>
																<ul>
																	<li><img src="images/cc-icon1.png" alt=""></li>
																	<li><img src="images/cc-icon2.png" alt=""></li>
																	<li><img src="images/cc-icon3.png" alt=""></li>
																	<li><img src="images/cc-icon4.png" alt=""></li>
																</ul>
															</div>
															<div class="inpt-field pd-moree">
																<input type="text" name="cc-number" placeholder="">
																<i class="fa fa-credit-card"></i>
															</div><!--inpt-field end-->
														</div>
														<div class="col-lg-6">
															<div class="cc-head">
																<h5>First Name</h5>
															</div>
															<div class="inpt-field">
																<input type="text" name="f-name" placeholder="">
															</div><!--inpt-field end-->
														</div>
														<div class="col-lg-6">
															<div class="cc-head">
																<h5>Last Name</h5>
															</div>
															<div class="inpt-field">
																<input type="text" name="l-name" placeholder="">
															</div><!--inpt-field end-->
														</div>
														<div class="col-lg-6">
															<div class="cc-head">
																<h5>Expiresons</h5>
															</div>
															<div class="rowwy">
																<div class="row">
																	<div class="col-lg-6 pd-left-none no-pd">
																		<div class="inpt-field">
																			<input type="text" name="f-name" placeholder="">
																		</div><!--inpt-field end-->
																	</div>
																	<div class="col-lg-6 pd-right-none no-pd">
																		<div class="inpt-field">
																			<input type="text" name="f-name" placeholder="">
																		</div><!--inpt-field end-->
																	</div>
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="cc-head">
																<h5>Cvv (Security Code) <i class="fa fa-question-circle"></i></h5>
															</div>
															<div class="inpt-field">
																<input type="text" name="l-name" placeholder="">
															</div><!--inpt-field end-->
														</div>
														<div class="col-lg-12">
															<button type="submit">Continue</button>
														</div>
													</div>
												</form>
												<h4>Add Paypal Account</h4>
											</div>
										</div><!--add-billing-method end-->
									</div><!--product-feed-tab end-->
								</div><!--main-ws-sec end-->
							</div>
						</div>
					</div><!-- main-section-data end-->
				</div> 
			</div>
		</main>

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
		</footer><!--footer end-->

		<div class="overview-box" id="overview-box">
			<div class="overview-edit">
				<h3>Overview</h3>
				<span>5000 character left</span>
				<form>
					<textarea></textarea>
					<button type="submit" class="save">Save</button>
					<button type="submit" class="cancel">Cancel</button>
				</form>
				<a href="#" title="" class
								</div><!--main-ws-sec end-->
							</div>
							
						</div>
					</div><!-- main-section-data end-->
				</div> 
			</div>
		</main>




		<div class="post-popup pst-pj">
			<div class="post-project">
				<h3>Post a project</h3>
				<div class="post-project-fields">
					<form>
						<div class="row">
							<div class="col-lg-12">
								<input type="text" name="title" placeholder="Title">
							</div>
							<div class="col-lg-12">
								<div class="inp-field">
									<select>
										<option>Category</option>
										<option>Category 1</option>
										<option>Category 2</option>
										<option>Category 3</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<input type="text" name="skills" placeholder="Skills">
							</div>
							<div class="col-lg-12">
								<div class="price-sec">
									<div class="price-br">
										<input type="text" name="price1" placeholder="Price">
										<i class="la la-dollar"></i>
									</div>
									<span>To</span>
									<div class="price-br">
										<input type="text" name="price1" placeholder="Price">
										<i class="la la-dollar"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<textarea name="description" placeholder="Description"></textarea>
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="post">Post</button></li>
									<li><a href="#" title="">Cancel</a></li>
								</ul>
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-project-popup end-->

		<div class="post-popup job_post">
			<div class="post-project">
				<h3>Post a job</h3>
				<div class="post-project-fields">
					<form>
						<div class="row">
							<div class="col-lg-12">
								<input type="text" name="title" placeholder="Title">
							</div>
							<div class="col-lg-12">
								<div class="inp-field">
									<select>
										<option>Category</option>
										<option>Category 1</option>
										<option>Category 2</option>
										<option>Category 3</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<input type="text" name="skills" placeholder="Skills">
							</div>
							<div class="col-lg-6">
								<div class="price-br">
									<input type="text" name="price1" placeholder="Price">
									<i class="la la-dollar"></i>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="inp-field">
									<select>
										<option>Full Time</option>
										<option>Half time</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<textarea name="description" placeholder="Description"></textarea>
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="post">Post</button></li>
									<li><a href="#" title="">Cancel</a></li>
								</ul>
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-project-popup end-->


	</div><!--theme-layout end-->



<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.range-min.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>