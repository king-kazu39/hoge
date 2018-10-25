
<?php 
	session_start();
	require_once('dbconnect/dbconnect.php');
	require_once('function.php');

	$signin_user_id = $_SESSION['nexstage_test']['id'];



// =====================ここからユーザ名とユーザプロフィール画像取得=====================

	$sql = 'SELECT `id`,`name`,`img_name` FROM `users` WHERE `id` = ?';
    $data = [$signin_user_id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    // フェッチする
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

// =====================ここまでユーザ名とユーザプロフィール画像取得=====================

// =========================================ここから目標数とライバル数取得===========================================

	$sql = 'SELECT `target_count`,`rival_count` FROM `activities` WHERE `user_id` = ?';
    $data = [$signin_user_id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    // フェッチする
    $target_rival_count = $stmt->fetch(PDO::FETCH_ASSOC);

// =========================================ここまで目標数とライバル数取===========================================

// ================================左の目標一覧============================================================


		$sql = "SELECT `t`.*, `u`.`id` , `u`.`img_name` 
				FROM `targets` AS `t` LEFT JOIN `users` AS `u` 
				ON `t`.`user_id` = `u`.`id` WHERE `t`.`user_id` = ? ORDER BY `t`.`created` DESC LIMIT 3";
		$data = [$signin_user_id];
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
			$signin_user_targets[] = $record;
		}


// =============================ここまでが左の目標一覧========================================================

	// ============================================検索機能=======================================================
// TODO
	$search_word = "健康";
	if (isset($_GET['search'])){
		$search = $_GET['search'];


		$sql = 'SELECT `t`.*, `u`. `name`,`u`.`img_name` FROM `targets` AS `t` LEFT JOIN `users` AS `u` ON `t`.`user_id` = `u`.`id` WHERE `t`.`target` LIKE "%"?"%" OR `u`.`name` LIKE "%"?"%" ORDER BY `created` DESC ';
		$data = [$search, $search];
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);
		
	}else {
		if (isset($_GET['category_select'])) {

		switch ($_GET['category_select']) {
			case 'health':
				$search_word = '健康';
				break;
			
			case 'money':
				$search_word = 'お金';
				break;

			case 'job':
				$search_word = '仕事';
				break;

			case 'family':
				$search_word = '家族';
				break;

			case 'education':
				$search_word = '教育';
				break;

			case 'heart':
				$search_word = '精神';
				break;

			default:
				$search_word = '楽しみ';
				break;
		}
		}

	    // LEFT JOINで全件取得
	    $sql = 'SELECT `t`.*, `u`.`name`,`u`.`img_name` FROM `targets` AS `t` LEFT JOIN `users` AS `u` ON `t`.`user_id`=`u`.`id` WHERE `t`.`category` = ? ORDER BY `created` DESC ';
	    $data = [$search_word];
	    $stmt = $dbh->prepare($sql);
		$stmt ->execute($data);

	}


// ============================================検索機能=======================================================


// ============================================フィード取得=======================================================

	// targets 入れる配列
	$targets = array();

	// レコードは無くなるまで取得処理
	while (true) {
		$record = $stmt->fetch(PDO::FETCH_ASSOC);

		// もし取得するものがなくなったら処理を抜ける
		if ($record == false) {
			break;
		}

		// その投稿をいいね済みかどうかの確認
        $like_flg_sql = "SELECT * FROM `likes` WHERE `user_id` = ? AND `target_id` = ?";

        $like_flg_data = [$signin_user_id, $record["id"]];

        $like_flg_stmt = $dbh->prepare($like_flg_sql);
        $like_flg_stmt->execute($like_flg_data);

        $is_liked = $like_flg_stmt->fetch(PDO::FETCH_ASSOC);

        // 三項演算子 条件式 ? trueだった場合 : falseだった場合
        $record["is_liked"] = $is_liked ? true : false;

        // 何件いいねされているか確認
        $like_sql = "SELECT COUNT(*) AS `like_cnt` FROM `likes` WHERE `target_id` = ?";

        $like_data = [$record["id"]];

        $like_stmt = $dbh->prepare($like_sql);
        $like_stmt->execute($like_data);

        $like = $like_stmt->fetch(PDO::FETCH_ASSOC);

        $record["like_cnt"] = $like["like_cnt"];



		// =====================コメント一覧=======================
        // feed一件毎のコメント一覧を取得する
        $record['comments'] = get_comments($dbh, $record['id']);
        // コメント数を取得
        $record["comment_cnt"] = count_comments($dbh, $record['id']);
        // =====================コメント一覧=======================


		// レコードがあれば追加
		$targets[] = $record;
	}



// ============================================フィード取得=======================================================

// ===============================================カテゴリ振り分け================================================

$isCategory = isset($_GET['change_category']);
$selectedCategory = isset($_GET['category_select']) ? $_GET['category_select'] : 'health';
$isfiledbycategory = (isset($_GET['category_select']) && $_GET['category_select'] == 'category');
$_SESSTION['change_category'] = $isCategory ? $_GET['change_category'] : '';
if ($isCategory) {
	$sql = 'SELECT `t`.*, `u`.`name`,`u`.`img_name` FROM `targets` AS `t` LEFT JOIN `users` AS `u` ON `f`.`user_id` = `u`.`id` WHERE `t`.`category` = ? LIKE "%"?"%" ORDER BY `created` DESC';
	$data = [$_GET['change_category']];

	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);

	$targets = [];

	while (true) {
		$record = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($record == false) {
			break;
		}
		$targets[] = $record;
	}
}

// ===============================================ENDカテゴリ振り分け================================================

  //目標数の取得(このページのユーザの)
  $sql = 'SELECT `target` FROM `targets` WHERE `user_id` = ?';
  $data = [$signin_user_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $targets_count = array();
  // レコードは無くなるまで取得処理
  while (true) {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    // もし取得するものがなくなったら処理を抜ける
    if ($record == false) {
      break;
    }

    $targets_count[] = $record;
  }




  $sql = 'SELECT * FROM `rivals` WHERE `user_id` = ?';
  $data = [$signin_user_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $rivals = array();
  // レコードは無くなるまで取得処理
  while (true) {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    // もし取得するものがなくなったら処理を抜ける
    if ($record == false) {
      break;
    }

    $rivals[] = $record;
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
								</a>
							</li> -->
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
							<img src="user_profile_img/<?php echo $user['img_name']; ?>" width = '30' height="30" alt="">
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

		<div class="search-sec">
			<div class="container">
				<div class="search-box">
					<form method="GET" action="" role="search">
						<input type="text" name="search" placeholder="キーワード検索">
						<button type="submit">検索</button>
					</form>
				</div><!--search-box end-->
			</div>
		</div><!--search-sec end-->


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
													<a href=<?php echo "profile.php?user_id=".$signin_user_id; ?>><img src="user_profile_img/<?= $user['img_name'] ?>" width="100" height="100" class="rounded-circle"></a>
												</div>
											</div><!--username-dt end-->
											<div class="user-specs">
												<h3 style="font-size: 40px;"><?php echo $user['name']; ?></h3>
											</div>
										</div><!--user-profile end-->
											<ul class="flw-status">
												<li>
                        <a href="search.php">
                          <span>目標数</span>
                          <b><?php echo count($targets_count); ?></b>
                        </a>
                      </li>
                      <li>
                        <a href="rivals.php">
                          <span>ライバル</span>
                          <b><?php echo count($rivals); ?></b>
                        </a>
                      </li>
											</ul>




									</div><!--user-data end-->
									<div class="suggestions full-width">
										<div class="sd-title">
											<h3>自分の目標</h3>
											<i class="la la-ellipsis-v"></i>
										</div><!--sd-title end-->
										
									<?php foreach ($signin_user_targets as $target): ?>
										<div class="suggestions-list">
											<div class="suggestion-usd">
												<img src= "user_profile_img/<?php echo $target['img_name']; ?>" width = "40" height="40">
												<div class="sgt-text">
													<h4><a href=<?php echo "profile.php?user_id=".$target['user_id']; ?>><?php echo $target['target']; ?></a></h4>
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
								<div class="main-ws-sec">
									<div class="posts-section">
										<div class="tab-feed st2">
											<ul>


												<li data-tab="feed-dd" class="<?php if ($selectedCategory == 'health') echo 'active'; ?>">
													<a href="search.php?category_select=health" title="">
														<img src="images/ico1.png" alt="">
														<span>健康</span>
													</a>
												</li>

												<li data-tab="info-dd" class="<?php if ($selectedCategory == 'money') echo 'active'; ?>">
													<a href="search.php?category_select=money" title="">
														<img src="images/ico2.png" alt="">
														<span>お金</span>
													</a>
												</li>
												<li data-tab="saved-jobs" class="<?php if ($selectedCategory == 'job') echo 'active'; ?>">
													<a href="search.php?category_select=job" title="">
														<img src="images/ico3.png" alt="">
														<span>仕事</span>
													</a>
												</li>
												<li data-tab="my-bids" class="<?php if ($selectedCategory == 'family') echo 'active'; ?>">
													<a href="search.php?category_select=family" title="">
														<img src="images/ico4.png" alt="">
														<span>家族</span>
													</a>
												</li>
												<li data-tab="portfolio-dd" class="<?php if ($selectedCategory == 'education') echo 'active'; ?>">
													<a href="search.php?category_select=education" title="">
														<img src="images/ico5.png" alt="">
														<span>教育</span>
													</a>
												</li>
												<li data-tab="payment-dd" class="<?php if ($selectedCategory == 'heart') echo 'active'; ?>">
													<a href="search.php?category_select=heart" title="">
														<img src="images/ico6.png" alt="">
														<span>精神</span>
													</a>
												</li>
												<li data-tab="payment-dd" class="<?php if ($selectedCategory == 'fun') echo 'active'; ?>">
													<a href="search.php?category_select=fun"title="">
														<img src="images/ico7.png" alt="">
														<span>楽しみ</span>
													</a>
												</li>
											</ul>
										</div><!-- tab-feed end-->	
									</div><!--posty end-->
								</div><!--posts-section end-->

								

								<?php foreach ($targets as $target): ?>
									<?php
										$feed = $target;
									?>
									<div class="posts-section">
										
										<div class="post-bar">
											
											<div class="post_topbar">
												<div class="usy-dt"><a href=<?php echo "profile.php?user_id=".$feed['user_id']; ?>>
													<img src="user_profile_img/<?php echo $target['img_name']; ?>" alt="" width = "40" height="40"></a>
													<div class="usy-name">

														<a href=<?php echo "profile.php?user_id=".$target['user_id']; ?>>
														  <?php echo $target['name']; ?>
														</a>

													</div>
												</div>
											</div>

											
											<div class="job_descp">
												<h3>目標：<?php echo $target['target']; ?></h3>
												<ul class="job-dt">
													<li><a href="#" title=""><?php echo $target['category']; ?></a></li>
													<!-- <li><span>$30 / hr</span></li> -->
												</ul>
												<ul class="skill-tags">
													<li>スタート : <?php echo $target['created']; ?></li>
													<li>ゴール :<?php echo $target['goal']; ?></li>
												</ul>
											</div>
											<div class="job-status-bar">
												

<!-- ===========================いいね機能実装===============================================- -->
						<div>
							<?php if ($feed['is_liked']): ?>
									<!-- いいねしている場合 -->
                                    <button class="js-unlike">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                        <span>いいねを取り消す</span>
                                    </button>
                                <?php else: ?>
                                <!-- いいねしていない場合 -->
                                <button class="js-like">
                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    <span>いいね!</span>
                                </button>
                            <?php endif; ?>

                                <span hidden class="user-id"><?php echo $user['id']; ?></span>
                                <span hidden class="target-id"><?php echo $target['id']; ?></span>
                                <span>: </span>
                                <span class="like_count"><?= $target['like_cnt'] ?></span>
                                <!-- <span class="like-count"><?php echo $feed["like_cnt"]; ?></span> -->
						
<!-- ===========================ここまでいいね機能実装===============================================- -->

<!-- ======================コメント機能=========================== -->
						
						<a href="#collapseComment<?= $target["id"] ?>" data-toggle="collapse" aria-expanded="false">
                                    <span>コメント</span>
                                </a>
                                <span class="comment_count">: <?= $target["comment_cnt"] ?></span>

                                <br>
                                <?php include('comment_view.php'); ?>
                    </div>
<!-- ========================================ここまでコメント機能=========================================== -->

											</div>
										</div><!--post-bar end-->
								<?php endforeach; ?>





											<div class="process-comm">
												<div class="spinner">
													<div class="bounce1"></div>
													<div class="bounce2"></div>
													<div class="bounce3"></div>
												</div>
											</div><!--process-comm end-->
										</div><!--posts-section end-->
									</div><!--product-feed-tab end-->




									<div class="product-feed-tab" id="saved-jobs">
										<div class="posts-section">
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="http://via.placeholder.com/50x50" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="#" title="">Edit Post</a></li>
															<li><a href="#" title="">Unsaved</a></li>
															<li><a href="#" title="">Unbid</a></li>
															<li><a href="#" title="">Close</a></li>
															<li><a href="#" title="">Hide</a></li>
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
													<h3>Senior Wordpress Developer</h3>
													<ul class="job-dt">
														<li><a href="#" title="">Full Time</a></li>
														<li><span>$30 / hr</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="#" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="#" title="">HTML</a></li>
														<li><a href="#" title="">PHP</a></li>
														<li><a href="#" title="">CSS</a></li>
														<li><a href="#" title="">Javascript</a></li>
														<li><a href="#" title="">Wordpress</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="#"><i class="la la-heart"></i> Like</a>
															<img src="images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="http://via.placeholder.com/50x50" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="#" title="">Edit Post</a></li>
															<li><a href="#" title="">Unsaved</a></li>
															<li><a href="#" title="">Unbid</a></li>
															<li><a href="#" title="">Close</a></li>
															<li><a href="#" title="">Hide</a></li>
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
													<h3>Senior Wordpress Developer</h3>
													<ul class="job-dt">
														<li><a href="#" title="">Full Time</a></li>
														<li><span>$30 / hr</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="#" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="#" title="">HTML</a></li>
														<li><a href="#" title="">PHP</a></li>
														<li><a href="#" title="">CSS</a></li>
														<li><a href="#" title="">Javascript</a></li>
														<li><a href="#" title="">Wordpress</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="#"><i class="la la-heart"></i> Like</a>
															<img src="images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="http://via.placeholder.com/50x50" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="#" title="">Edit Post</a></li>
															<li><a href="#" title="">Unsaved</a></li>
															<li><a href="#" title="">Unbid</a></li>
															<li><a href="#" title="">Close</a></li>
															<li><a href="#" title="">Hide</a></li>
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
													<h3>Senior Wordpress Developer</h3>
													<ul class="job-dt">
														<li><a href="#" title="">Full Time</a></li>
														<li><span>$30 / hr</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="#" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="#" title="">HTML</a></li>
														<li><a href="#" title="">PHP</a></li>
														<li><a href="#" title="">CSS</a></li>
														<li><a href="#" title="">Javascript</a></li>
														<li><a href="#" title="">Wordpress</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="#"><i class="la la-heart"></i> Like</a>
															<img src="images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
													</ul>
												</div>
											</div><!--post-bar end-->
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="http://via.placeholder.com/50x50" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="#" title="">Edit Post</a></li>
															<li><a href="#" title="">Unsaved</a></li>
															<li><a href="#" title="">Unbid</a></li>
															<li><a href="#" title="">Close</a></li>
															<li><a href="#" title="">Hide</a></li>
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
													<h3>Senior Wordpress Developer</h3>
													<ul class="job-dt">
														<li><a href="#" title="">Full Time</a></li>
														<li><span>$30 / hr</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="#" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="#" title="">HTML</a></li>
														<li><a href="#" title="">PHP</a></li>
														<li><a href="#" title="">CSS</a></li>
														<li><a href="#" title="">Javascript</a></li>
														<li><a href="#" title="">Wordpress</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="#"><i class="la la-heart"></i> Like</a>
															<img src="images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="process-comm">
												<a href="#" title=""><img src="images/process-icon.png" alt=""></a>
											</div><!--process-comm end-->
										</div><!--posts-section end-->
									</div><!--product-feed-tab end-->
									<div class="product-feed-tab" id="my-bids">
										<div class="posts-section">
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="http://via.placeholder.com/50x50" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="#" title="">Edit Post</a></li>
															<li><a href="#" title="">Unsaved</a></li>
															<li><a href="#" title="">Unbid</a></li>
															<li><a href="#" title="">Close</a></li>
															<li><a href="#" title="">Hide</a></li>
														</ul>
													</div>
												</div>
												<div class="epi-sec">
													<ul class="descp">
														<li><img src="images/icon8.png" alt=""><span>Frontend Developer</span></li>
														<li><img src="images/icon9.png" alt=""><span>India</span></li>
													</ul>
													<ul class="bk-links">
														<li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
														<li><a href="#" title=""><i class="la la-envelope"></i></a></li>
														<li><a href="#" title="" class="bid_now">Bid Now</a></li>
													</ul>
												</div>
												<div class="job_descp">
													<h3>Simple Classified Site</h3>
													<ul class="job-dt">
														<li><span>$300 - $350</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="#" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="#" title="">HTML</a></li>
														<li><a href="#" title="">PHP</a></li>
														<li><a href="#" title="">CSS</a></li>
														<li><a href="#" title="">Javascript</a></li>
														<li><a href="#" title="">Wordpress</a></li> 	
														<li><a href="#" title="">Photoshop</a></li> 	
														<li><a href="#" title="">Illustrator</a></li> 	
														<li><a href="#" title="">Corel Draw</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="#"><i class="la la-heart"></i> Like</a>
															<img src="images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="http://via.placeholder.com/50x50" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="#" title="">Edit Post</a></li>
															<li><a href="#" title="">Unsaved</a></li>
															<li><a href="#" title="">Unbid</a></li>
															<li><a href="#" title="">Close</a></li>
															<li><a href="#" title="">Hide</a></li>
														</ul>
													</div>
												</div>
												<div class="epi-sec">
													<ul class="descp">
														<li><img src="images/icon8.png" alt=""><span>Frontend Developer</span></li>
														<li><img src="images/icon9.png" alt=""><span>India</span></li>
													</ul>
													<ul class="bk-links">
														<li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
														<li><a href="#" title=""><i class="la la-envelope"></i></a></li>
														<li><a href="#" title="" class="bid_now">Bid Now</a></li>
													</ul>
												</div>
												<div class="job_descp">
													<h3>Ios Shopping mobile app</h3>
													<ul class="job-dt">
														<li><span>$300 - $350</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="#" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="#" title="">HTML</a></li>
														<li><a href="#" title="">PHP</a></li>
														<li><a href="#" title="">CSS</a></li>
														<li><a href="#" title="">Javascript</a></li>
														<li><a href="#" title="">Wordpress</a></li> 	
														<li><a href="#" title="">Photoshop</a></li> 	
														<li><a href="#" title="">Illustrator</a></li> 	
														<li><a href="#" title="">Corel Draw</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="#"><i class="la la-heart"></i> Like</a>
															<img src="images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="http://via.placeholder.com/50x50" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="#" title="">Edit Post</a></li>
															<li><a href="#" title="">Unsaved</a></li>
															<li><a href="#" title="">Unbid</a></li>
															<li><a href="#" title="">Close</a></li>
															<li><a href="#" title="">Hide</a></li>
														</ul>
													</div>
												</div>
												<div class="epi-sec">
													<ul class="descp">
														<li><img src="images/icon8.png" alt=""><span>Frontend Developer</span></li>
														<li><img src="images/icon9.png" alt=""><span>India</span></li>
													</ul>
													<ul class="bk-links">
														<li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
														<li><a href="#" title=""><i class="la la-envelope"></i></a></li>
														<li><a href="#" title="" class="bid_now">Bid Now</a></li>
													</ul>
												</div>
												<div class="job_descp">
													<h3>Simple Classified Site</h3>
													<ul class="job-dt">
														<li><span>$300 - $350</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="#" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="#" title="">HTML</a></li>
														<li><a href="#" title="">PHP</a></li>
														<li><a href="#" title="">CSS</a></li>
														<li><a href="#" title="">Javascript</a></li>
														<li><a href="#" title="">Wordpress</a></li> 	
														<li><a href="#" title="">Photoshop</a></li> 	
														<li><a href="#" title="">Illustrator</a></li> 	
														<li><a href="#" title="">Corel Draw</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="#"><i class="la la-heart"></i> Like</a>
															<img src="images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="http://via.placeholder.com/50x50" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="#" title="">Edit Post</a></li>
															<li><a href="#" title="">Unsaved</a></li>
															<li><a href="#" title="">Unbid</a></li>
															<li><a href="#" title="">Close</a></li>
															<li><a href="#" title="">Hide</a></li>
														</ul>
													</div>
												</div>
												<div class="epi-sec">
													<ul class="descp">
														<li><img src="images/icon8.png" alt=""><span>Frontend Developer</span></li>
														<li><img src="images/icon9.png" alt=""><span>India</span></li>
													</ul>
													<ul class="bk-links">
														<li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
														<li><a href="#" title=""><i class="la la-envelope"></i></a></li>
														<li><a href="#" title="" class="bid_now">Bid Now</a></li>
													</ul>
												</div>
												<div class="job_descp">
													<h3>Ios Shopping mobile app</h3>
													<ul class="job-dt">
														<li><span>$300 - $350</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="#" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="#" title="">HTML</a></li>
														<li><a href="#" title="">PHP</a></li>
														<li><a href="#" title="">CSS</a></li>
														<li><a href="#" title="">Javascript</a></li>
														<li><a href="#" title="">Wordpress</a></li> 	
														<li><a href="#" title="">Photoshop</a></li> 	
														<li><a href="#" title="">Illustrator</a></li> 	
														<li><a href="#" title="">Corel Draw</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="#"><i class="la la-heart"></i> Like</a>
															<img src="images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="process-comm">
												<a href="#" title=""><img src="images/process-icon.png" alt=""></a>
											</div><!--process-comm end-->
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
<script type="text/javascript" src="js/app.js"></script>

</body>
</html>