
	<?php

		require_once(dirname(__FILE__)."/dbconnect/dbconnect.php");

			$sql='SELECT tas.*,tar.id , tar.target FROM tasks AS tas LEFT JOIN targets AS tar ON tas.target_id = tar.id ORDER BY tas.created DESC ';
			$stmt = $dbh->prepare($sql);
			$stmt->execute();

			// フィーズ一覧を入れる配列
				$tasks = array();
			// レコードがなくなるまで取得処理
				while(true){
			// 一件ずつフェッチ
					$record = $stmt->fetch(PDO::FETCH_ASSOC);
			// レコードがなければ、処理を抜ける
					if($record == false){
						break;
					}
				$tasks[]= $record;
echo "<pre>";
			var_dump($tasks);
echo "</pre>";
			}

		$target['id'] = '';
		$task = '';
		$detail = '';

		$errors = [];

		if (!empty($_POST)) {
			// 宣言する！ボタンを押すとこのif文が実行されます

			// $user['id'] = $_POST['user_id'];
			$target['id'] = 1;
			$task = $_POST['task'];
			$detail = $_POST['detail'];

			// もし、入力されていなかったら
			if ($task == '') {
				$errors['task'] = '空';
			}
			if ($detail == '') {
				$errors['detail'] = '空';
			}

			if (empty($errors)) {
				// エラーがなかったら登録処理
			$task = $_POST['task'];
				
				$sql = 'INSERT INTO `tasks` SET `target_id` = ?, `task` = ?, `detail` = ?,  `created` = NOW()';			

				$data = [$target['id'], $task, $detail];
				$stmt = $dbh->prepare($sql);
				$stmt->execute($data);

				$record =$stmt->fetch(PDO::FETCH_ASSOC);
				$tasks[] = $record;

			}



}
echo "<pre>";
var_dump($tasks);
echo "</pre>";
		





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
								<a href="timeline.html" title="">
									<span><img src="images/icon1.png" alt=""></span>
									ホーム
								</a>
							</li>
							<li>
								<a href="plan.html" title="">
									<span><img src="images/ic1.png" alt=""></span>
									Plan
								</a>
							</li>
							<li>
								<a href="do.html" title="">
									<span><img src="images/ic2.png" alt=""></span>
									Do
								</a>
							</li>
							<li>
								<a href="check.html" title="">
									<span><img src="images/ic4.png" alt=""></span>
									Check
								</a>
							</li>
							<li>
								<a href="ajust.html" title="">
									<span><img src="images/ic5.png" alt=""></span>
									Ajust
								</a>
							</li>
							<li>
								<a href="setting.html" title="">
									<span><img src="images/icon3.png" alt=""></span>
									設定
								</a>
							</li>
							<li>
								<a href="messages.html" title="" class="not-box-open">
									<span><img src="images/icon6.png" alt=""></span>
									メッセージ
								</a>
							</li>
						</ul>
					</nav><!--nav end-->
					</nav><!--nav end-->

					
					<div class="logo">
						<a href="timeline.html" title=""><img src="images/logo.png" alt=""></a>
					</div><!--logo end-->

					<div class="menu-btn">
						<a href="my-profile.html" title=""><i class="fa fa-bars"></i></a>
					</div><!--menu-btn end-->
					<div class="user-account">
						<div class="user-info">
							<img src="http://via.placeholder.com/30x30" alt="">
							<a href="my-profile.html" title="">井上　侑弥</a>
						</div>
					</div>
					<div class="search-bar">
						<ul class="flw-hr">
							<li><a href="search.html" title="" class="flww"><i class="la la-plus"></i>ライバル探す</a></li>
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
													<a href="my-profile.html"><img src="http://via.placeholder.com/100x100" class="rounded-circle"></a>
												</div>
											</div><!--username-dt end-->
											<div class="user-specs">
												<h3>井上　侑弥</h3>
												<span>@takuzoo</span>
											</div>
										</div><!--user-profile end-->
											<ul class="flw-status">
												<li>
													<a href="search.html">
														<span>目標数</span>
														<b>34</b>
													</a>
												</li>
												<li>
													<a href="rivals.html">
														<span>ライバル</span>
														<b>155</b>
													</a>
												</li>
											</ul>
									</div><!--user-data end-->
									<div class="suggestions full-width">
										<div class="sd-title">
											<h3>自分の目標(登録が新しい順に3つくらい出す?)</h3>
											<i class="la la-ellipsis-v"></i>
										</div><!--sd-title end-->
										<div class="suggestions-list">
											<div class="suggestion-usd">
												<!-- <img src="http://via.placeholder.com/35x35" alt=""> -->
												<div class="sgt-text">
													<h4>アプリ作る(詳細ページに飛ぶ?)</h4>
													<span>9月28日まで</span>
													<span>カテゴリ名</span>
												</div>
												<span>d/w/m</span>
												<!-- <span><i class="la la-plus"></i></span> -->
											</div>
											<!-- <div class="view-more">
												<p>カテゴリ名</p>
												<a href="#" title="">View More</a>
											</div> -->
										</div><!--suggestions-list end-->

										<div class="suggestions-list">
											<div class="suggestion-usd">
												<!-- <img src="http://via.placeholder.com/35x35" alt=""> -->
												<div class="sgt-text">
													<h4>海外旅行に行く(詳細ページに飛ぶ?)</h4>
													<span>3月25日まで</span>
													<span>カテゴリ名</span>
												</div>
												<span>d/w/m</span>
												<!-- <span><i class="la la-plus"></i></span> -->
											</div>
											<!-- <div class="view-more">
												<p>カテゴリ名</p>
												<a href="#" title="">View More</a>
											</div> -->
										</div><!--suggestions-list end-->
									</div><!--suggestions end-->
							</div>
							<div class="col-lg-8">
								<div class="product-feed-tab current" id="feed-dd">
									<div class="posts-section">
										

										<div class="posts-section">
														<?php foreach ($tasks as $task): ?>
											<div class="post-bar">
														<!-- feedsを繰り返し処理で出力する -->
														<!-- foreach(配列名 as 各要素) -->
												<div class="post_topbar">
													<div class="ed-opts">
														<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="#" title="">編集</a></li>
															<li><a href="#" title="">消去</a></li>
															<li><a href="#" title="">非表示</a></li>
														</ul>
													</div>
													<div>
														<div>
														
														<br>
														</div>
													</div>
													<div class="usy-dt">
														<img src="http://via.placeholder.com/50x50" alt="">
													<h3><?php echo $task['target'] ?></h3>
														<div class="job_descp">
															<ul class="skill-tags">
																<div class="skill-tags"></div><!--post-st end-->
																<li><a class="post-jb active" href="#" title="">タスクを書く</a></li>
																<li><a class="post-jb active" href="#" title="">タスクを見る</a></li>
																<div class="usy-time">
																	<span><img src="images/clock.png" alt="">3分前</span>
																</div>
															</ul>
														</div>
													</div>
												</div>												
												<!-- <div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="#"title="" class="com"><i class="la la-heart"></i>いいね</a></li>  -->
															<!-- <span>25</span> -->
														<!-- <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> コメント 15</a></li>
														<li><a href="" title="" class="com">カテゴリー</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div> -->
											</div><!--post-bar end-->
														<?php endforeach; ?>
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
				<h3>実行</h3>
				<div class="post-project-fields">
					<form action="do.php" method="post">
						<div class="row">
							<div class="col-lg-12">
								<input type="text" name="task" placeholder="タスクの入力" >
								<?php if (isset($errors['target']) && $errors['target'] == '空'): ?>
								<span style="color: red;">目標を入力してください</span>
								<?php endif; ?>
							</div>
							
							<div class="col-lg-12">
								<textarea name="detail" placeholder="詳細入力" ></textarea>
								<?php if (isset($errors['detail']) && $errors['detail'] == '空'): ?>
								<span style="color: red;">目標を入力してください</span>
								<?php endif; ?>
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="post">宣言する！</button></li>
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
				<h3>実行タスク</h3>
				<div class="post-project-fields">
					<form action="do.php" method="post">
						<div class="row">
							<div class="col-lg-12">
								<input type="text" name="task" placeholder="タスクの入力" >
								<?php if (isset($errors['target']) && $errors['target'] == '空'): ?>
								<span style="color: red;">目標を入力してください</span>
								<?php endif; ?>
							</div>
							
							<div class="col-lg-12">
								<textarea name="detail" placeholder="詳細入力" ></textarea>
								<?php if (isset($errors['detail']) && $errors['detail'] == '空'): ?>
								<span style="color: red;">目標を入力してください</span>
								<?php endif; ?>
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="post">宣言する！</button></li>
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