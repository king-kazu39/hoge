<<<<<<< HEAD

	<?php 
		require_once('dbconnection/dbconnection.php');

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
			if ($target == '') {
				$errors['target'] = '空';
			}
			if ($task == '') {
				$errors['task'] = '空';
			}
			if ($detail == '') {
				$errors['detail'] = '空';
			}

			if (empty($errors)) {
				// エラーがなかったら登録処理
				$sql = 'INSERT INTO `tasks` SET `target_id` = ?, `task` = ?, `detail` = ?, created` = NOW(), `updated` = NOW()';

				$data = [$target['id'], $task, $detail,];
				$stmt = $dbh->prepare($sql);
				$stmt->execute($data);

				header('Location: do.php');
				exit();
			}

		}




	 ?>
=======
<?php 
	session_start();

	require_once('../dbconnection.php');

	if(!isset($_SESSION['hogehoge']['id'])){
		header('Location: sign-in.html');
	}
	$signin_user_id = $_SESSION['hogehoge']['id'];

	$sql= 'SELECT `id`, `target_id`, `task` `detail` FROM `tasks`
	WHERE `id` = ?';

	$data=[$signin_user_id];
	$stmt=$dbh->prepare($sql);
	$stmt->excute($data);

	$task=$stmt->fetch(PDO::FETCH_ASSOC);

$page = 1;
	$start = 0;
	const CONTENT_PER_PAGE = 5;
	if(isset($_GET['page'])){
		$page = $_GET['page'];
		// -1などのページ数として不正な値を渡された場合の対策
		$page = max($page, 1);

		// 最後のページより大きいページ数を指定された時の対策
		// ヒットしたレコード数を取得するSQL
		$sql_count = "SELECT COUNT(*) AS `cnt` FROM `tasks`";
		$stmt_count= $dbh->prepare($sql_count);
		$stmt_count->execute();

		$record_cnt = $stmt_count->fetch(PDO::FETCH_ASSOC);
		// 取得したページ数を１ページあたりに表示する件数で割って何ページが最後になるか取得
		$last_page = ceil($record_cnt['cnt'] / CONTENT_PER_PAGE);
		// 最後のページより大きい値を渡された場合、適切な値に置き換える
		$page = min($page, $last_page);

		$start = ($page -1) * CONTENT_PER_PAGE;
		
		$sql='SELECT'
	}
 ?>
>>>>>>> master

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
										<div class="post-bar">
											<div class="post_topbar">
												<div class="ed-opts">
													<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
													<ul class="ed-options">
														<li><a href>編集</a></li>
														<li><a href>削除</a></li>
														<li><a href="#" title="">非表示</a></li>
													</ul>
												</div>
												<div class="usy-dt">
													<img src="http://via.placeholder.com/50x50" alt="">
													<h3>実行タスク</h3>
														<div class="job_descp">
															<ul class="skill-tags">
															<div class="skill-tags">
															</div><!--post-st end-->
																<li><a class="post-jb active" href="#" title="">タスクを書く</a></li>
																<li><a class="post-jb active" href="#" title="">タスクを見る</a></li>
															<div class="usy-time">
																<span><img src="images/clock.png" alt="">3分前></span>
															</div>
															</ul>
														</div>
												</div>
											</div>	
																					
											<div class="job-status-bar">
												<ul class="like-com">
													<li>
														<a href="#"title="" class="com"><i class="la la-heart"></i>いいね</a>
															<!-- <span>25</span> -->
													</li> 
													<li><a href="#" title="" class="com"><img src="images/com.png" alt=""> コメント 15</a>
													</li>
													<li><a href="" title="" class="com">カテゴリー</a></li>
												</ul>
													<a><i class="la la-eye"></i>Views 50</a>
											</div>
										</div><!--post-bar end-->

										<div class="posts-section">
											<div class="post-bar">
												<div class="post_topbar">
													<div class="ed-opts">
														<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="#" title="">編集</a></li>
															<li><a href="#" title="">消去</a></li>
															<li><a href="#" title="">非表示</a></li>
														</ul>
													</div>
													<div class="usy-dt">
														<img src="http://via.placeholder.com/50x50" alt="">
													<h3>今日夜までに、寿司食べ放題いく</h3>
														<div class="job_descp">
															<ul class="skill-tags">
																<div class="skill-tags"></div><!--post-st end-->
																<li><a class="post-jb active" href="#" title="">タスクを書く</a></li>
																<li><a class="post-jb active" href="#" title="">タスクを見る</a></li>
																<div class="usy-time">
																	<span><img src="images/clock.png" alt="">3 min ago</span>
																</div>
															</ul>
														</div>
													</div>
												</div>												
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="#"title="" class="com"><i class="la la-heart"></i>いいね</a></li> 
															<!-- <span>25</span> -->
														<li><a href="#" title="" class="com"><img src="images/com.png" alt=""> コメント 15</a></li>
														<li><a href="" title="" class="com">カテゴリー</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
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
				<h3>実行タスク</h3>
				<div class="post-project-fields">
					<form action="do.php" method="post">

						<div class="row">
							
							<div class="col-lg-12">
								<input type="text" name="task" placeholder="タスクの入力" >
<<<<<<< HEAD
								<?php if (isset($errors['task']) && $errors['task'] == '空'): ?>
								<span style="color: red;">タスクを入力してください</span>
								<?php endif; ?>
=======
>>>>>>> master
							</div>
							<div class="col-lg-12">
								<div class="inp-field" name="fequency" >
									<select>
										<option>確認頻度</option>
										<option>月</option>
										<option>火</option>
										<option>水</option>
										<option>木</option>
										<option>金</option>
										<option>土</option>
										<option>日</option>
									</select>
								</div>
<<<<<<< HEAD

							</div>
							
							<div class="col-lg-12">
								<textarea name="detail" placeholder="詳細入力" ><?php if (isset($errors['detail']) && $errors['detail'] == '空'): ?>
								<span style="color: red;">タスクを入力してください</span>
								<?php endif; ?></textarea>
=======
							</div>
							
							<div class="col-lg-12">
								<textarea name="detail" placeholder="詳細入力" ></textarea>
>>>>>>> master
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