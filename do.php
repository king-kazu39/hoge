<?php

	// session_start();

	require_once(dirname(__FILE__)."/dbconnect/dbconnect.php");

	// ここに必要？？
	// TODO:target['id']→user['id']に変更
	// $signin_userid = $_SESSION['nexstage_test']['id'];
	$signin_user_id = 68;


// =========================================ここから左画面のユーザ名とユーザプロフィール画像取===========================================

	$sql = 'SELECT `name`,`img_name` FROM `users` WHERE `id` = ?';
    $data = [$signin_user_id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    // フェッチする
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

// =========================================ここまで左画面のユーザ名とユーザプロフィール画像取得===========================================

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
			$targets[] = $record;
		}

// =============================ここまでが左の目標一覧========================================================


// =========================================ここから目標(target)とタスクの画面表示に必要な値を取得===========================================

	// TODO:`tas`.`target_id`→`tas` . `user_id`に変更
	// $sql = 'SELECT `tas`.*,`tar`.`id` , `tar`.`target` FROM `tasks` AS `tas` LEFT JOIN `targets` AS `tar` ON `tas`.`target_id` = `tar`.`id` ORDER BY `tas`.`created` DESC';
	$sql = 'SELECT `tas`.*,`tar`.`id` , `tar`.`target` ,`u`.`img_name`
			FROM `tasks` AS `tas` 
			LEFT JOIN `targets` AS `tar` 
			ON `tar`.`id` = `tas`.`target_id`
         	LEFT JOIN `users` AS `u`
         	ON `tar` . `user_id` = `u`.`id`
			WHERE `tar`.`user_id` = ?
			ORDER BY `tas`.`created` DESC';

	$data = [$signin_user_id];
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);

	// フィーズ一覧を入れる配列
	$tasks = array();

	// $record = $stmt->fetch(PDO::FETCH_ASSOC);

	// if($record == false){
	// 	break;
	// }

	// レコードがなくなるまで取得処理
	while(true){

	// 一件ずつフェッチ
	$record = $stmt->fetch(PDO::FETCH_ASSOC);

	// echo "レコードをいくつとっているか確認";
	// echo "<pre>";
	// var_dump($tasks);
	// echo "</pre>";

	// レコードがなければ、処理を抜ける
	if($record == false){
		break;
	}

	$tasks[] = $record;

}

	// echo "tasksの中身を表示";
	// echo "<pre>";
	// var_dump($tasks);
	// echo "</pre>";

// ------------------------------ここから目標を振り分け処理---------------------------------

	$results = []; //結果を入れる配列を用意
	for ($i = 0; $i < count($tasks); $i++) { //countで配列tasksを数えて（配列個数-1）回実行するように設定
	   $task = $tasks[$i];    // 変数taskに一個ずつ配列tasksを入れる（$taskは一次配列になる）
	   $target = [];           // 配列targetを用意する
	   $isNotExist = true;    // 判定スイッチを用意
	   $targetIndex = 0;

	   for ($j = 0; $j < count($results); $j++) { //
	     $t = $results[$j];

	     if ($t['target_id'] == $task['target_id']) {
	       $target = $t;
	       $isNotExist = false;
	       $targetIndex = $j;
	       break;
	     }
	   }                                            //2つ目のfor文の終点(})

     // resultsにまだなかった場合
     if ($isNotExist) {
       $target = [
            'target_id' => $task['target_id'],
            'target' => $task['target'],
            'img_name' => $task['img_name'],
            'tasks' => []   // 以下で２次配列にキーを指定して値を追加をする(task（異なるTODO）を管理する配列)
          ];
     }

     $target['tasks'][] = [
      'task_id' => $task['id'],
      'task' => $task['task'],
      'detail' => $task['detail']
    ];

    if ($isNotExist) {          //resultsにまだなかった場合（$isNotExist == trueのとき）
      $results[] = $target;      //ここでresults追加(resultsは２次元配列になる)

    } else {                    // resultに既にターゲットがある場合（$isNotExist == falseのとき）
        $results[$targetIndex] = $target;
    }
}                               // 1つ目のfor文の終点（}）

	// echo "resultsの中身を表示";
	// echo "<pre>";
	// var_dump($results);
	// echo "</pre>";




// ------------------------------ここまで目標を振り分け処理---------------------------------


// =========================================ここまで目標(target)とタスクの画面表示に必要な値を取得===========================================

// ============================================ここからタスクをDBへ登録する処理============================================

	// TODO:$target['id']→$signin_user_idに変更？
	// $target['id'] = '';
	$signin_user_id = '';
	$task = '';
	$detail = '';

	$errors = [];

	if (!empty($_POST)) {
	// 宣言する！ボタンを押すとこのif文が実行されます

	// TODO:target['id']→user['id']に変更
	// $signin_userid = $_SESSION['nexstage_test']['id'];
	$signin_user_id = 68;
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

		$sql = 'INSERT INTO `tasks` SET `target_id` = ?,`$user_id` = ?,`task` = ?, `detail` = ?,  `created` = NOW()';

		// TODO:target['id']→$signin_useridに変更
		// $data = [$target['id'], $task, $detail];
		$data = [$target_id, $signin_user_id, $task, $detail];
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);

		$record =$stmt->fetch(PDO::FETCH_ASSOC);
		$tasks[] = $record;
	}

}

// ============================================ここまでタスクをDBへ登録する処理============================================

	// echo "DBから取得してきたタスクの詳細";
	// echo "<pre>";
	// var_dump($tasks);
	// echo "</pre>";

// ============================================ここからタスクの編集をする処理（UPDATE）============================================













// ============================================ここまでタスクの編集をする処理（UPDATE）============================================

// ============================================ここからタスクの削除をする処理（DELETE）============================================













// ============================================ここまでタスクの削除をする処理（DELETE）============================================









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
								<a href="check.php" title="">
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
							<img src="user_profile_img/<?= $user['img_name'] ?>" width="30" height="30" alt="">
							<a href="my-profile.php" style="width:60px; height:20px; font-size: 20px;" title=""><?php echo $user['name']; ?></a>
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
													<a href="my-profile.php"><img src="user_profile_img/<?= $user['img_name'] ?>" width="100" height="100" class="rounded-circle"></a>
												</div>
											</div><!--username-dt end-->
											<div class="user-specs">
												<h3><?php echo $user['name']; ?></h3>
												<span>@takuzoo</span>
											</div>
										</div><!--user-profile end-->
											<ul class="flw-status">
												<li>
													<a href="search.php">
														<span>目標数</span>
														<?php if($target_rival_count): ?>
															<b><?php echo $target_rival_count['target_count']; ?></b>
														<?php else: ?>
															<b>0</b>
														<?php endif; ?>
													</a>
												</li>
												<li>
													<a href="rivals.php">
														<span>ライバル</span>
														<?php if($target_rival_count): ?>
															<b><?php echo $target_rival_count['rival_count']; ?></b>
														<?php else: ?>
															<b>0</b>
														<?php endif; ?>
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
										

										<div class="posts-section">
										  <?php foreach ($results as $result): ?>
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
														<img src="user_profile_img/<?= $result['img_name'] ?>" width="50" height="50" class="rounded-circle">
													<h3><?php echo $result['target'] ?></h3>
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




		
		<!-- TODO：切り替えができない -->
		<div class="post-popup pst-pj">
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


		<!-- TODO：表示できない -->
		<div class="post-popup job_post">
			<div class="post-project">
				<h3>TODO</h3>
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