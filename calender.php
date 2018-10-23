<?php 
session_start();
	require_once('dbconnect/dbconnect.php');

	// if (!isset($_SESSION['naxstage']['id'])) {
	// 	header('Location:signup_and_in.php');
	// }


	// TODO: ID仮打ち→OK
	$signin_user_id = $_SESSION['nexstage_test']['id'];
	// $signin_user_id = 68;



// =====================ここからユーザ名とユーザプロフィール画像取得=====================

	$sql = 'SELECT `name`,`img_name` FROM `users` WHERE `id` = ?';
    $data = [$signin_user_id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    // フェッチする
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

// =====================ここまでユーザ名とユーザプロフィール画像取得=====================

// =====================ここから目標数とライバル数取得=====================


    $sql = 'SELECT `target_count`,`rival_count` FROM `activities` WHERE `user_id` = ?';
    $data = [$signin_user_id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    // フェッチする
    $target_rival_count = $stmt->fetch(PDO::FETCH_ASSOC);



// =====================ここまで目標数とライバル数取得=====================

// =====================ここから自分の目標宣言取得=====================

    // サインインしているユーザー情報をDBから読み込む
    // usersとtargets２つのテーブルを結合
    // TODO:サインアップ→サインインした時の表示を直す
    $sql = 'SELECT `t`.*, `u`.`id`, `u`. `name`, `u`.`img_name` 
            FROM `targets` AS `t` 
            LEFT JOIN `users` AS `u` 
            ON `t`.`user_id` = `u`. `id` 
            -- WHERE `t`.`user_id` = ? ';

    $data = [];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);


    // targets 入れる配列
    $feeds = array();

    // レコードは無くなるまで取得処理
    while (true) {
        $record = $stmt->fetch(PDO::FETCH_ASSOC);



        // もし取得するものがなくなったら処理を抜ける
        if ($record == false) {
            break;
        }

        // レコードがあれば追加
        $feeds[] = $record;
    }

// =====================ここまで自分の目標宣言取得=====================

// ================================左の目標一覧============================================================
        // TODOリスト
        // $sigin_user_id = $_SESSION['nexstage']['id'];
        $sigin_user_id = 5;


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

// =============================ここまでが左の目標一覧=============================
// =============================ここから訳わかめ=============================

// // サインインしているユーザー情報をDBから読み込む
//     // usersとtargets２つのテーブルを結合
//     // TODO:サインアップ→サインインした時の表示を直す
//     $sql = 'SELECT `t`.*, `u`.`id`, `u`. `name`, `u`.`img_name` 
//             FROM `targets` AS `t` 
//             LEFT JOIN `users` AS `u` 
//             ON `t`.`user_id` = `u`. `id` 
//             -- WHERE `t`.`user_id` = ? ';

//     $data = [];
//     $stmt = $dbh->prepare($sql);
//     $res =$stmt->execute($data);

// 	// 結果を返す
// 	// JavaScriptで使えるようにjsonエンコードして返す
// 	echo json_encode($res);

// =============================ここから訳わかめ=============================



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
					
					<div class="logo">
						<a href="timeline.php" title=""><img src="images/logo.png" alt=""></a>
					</div><!--logo end-->

					<div class="menu-btn">
						<a href="my-profile.php" title=""><i class="fa fa-bars"></i></a>
					</div><!--menu-btn end-->
					<div class="user-account">
						<div class="user-info">
							<img src="http://via.placeholder.com/30x30" alt="">
							<a href="my-profile.php" title=""><?php echo $user['name']; ?></a>
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
												<a href="my-profile.php"><img src="user_profile_img/<?php $user['img_name'] ?>" width="100" height="100" class="rounded-circle"></a>
											</div>
										</div><!--username-dt end-->
										<div class="user-specs">
											<h3><?php echo $user['name']; ?></h3>
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
                                                <img src="user_profile_img/<?php echo $target['img_name']; ?>" width = "40">
                                                <div class="sgt-text">
                                                    <h4><a href="my-profile.php"><?php echo $target['target']; ?></a></h4>
                                                    <span><?php echo $target['goal']; ?></span>
                                                    <span><?php echo $target['category']; ?></span>
                                                </div>

                                                <!-- <span><i class="la la-plus"></i></span> -->
                                            </div>

                                        </div><!--suggestions-list end-->
                                    <?php endforeach; ?>
								</div><!--suggestions-list end-->
							</div>
							
							<link href='fullcalendar.min.css' rel='stylesheet' />
							<link href='fullcalendar.print.min.css' rel='stylesheet' media='print' />

							<style>

							  body {
							    margin: 40px 10px;
							    padding: 0;
							    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
							    font-size: 14px;
							  }

							  #calendar {
							    max-width: 900px;
							    margin: 0 auto;
							  }

							</style>

							 <div class='col-md-8'id='calendar'></div>
						</div><!--main-ws-sec end-->
					</div>
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

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/popper.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.range-min.js"></script>
		<script type="text/javascript" src="lib/slick/slick.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script src='moment.min.js'></script>
		<script src='jquery.min2.js'></script>
		<script src='fullcalendar.min.js'></script>
		<script src='ja.js'></script>
		<script>

$(document).ready(function() {
	$.ajax({
		// 取得するPHPを作成してそこの戻り値を受け取るようにする
		url: 'hoge.php',      //送信先
		type: 'GET',         //送信メソッド
		datatype: 'json',      //データのタイプ
		data:{                //送信するデータ
			// 'target_id': target_id,
			// 'user_id': user_id,
			// 'target': target,
			// 'goal': goal,
			// 'created': created,
		}
	})
	.done(function(data) {
		console.log(data);
		var calendar = $('#calendar').fullCalendar({
			// 受け取った値(data)を上手くeventsに入れていく
			events: JSON.parse(data)
		});
	})
	.fail(function(data) {

	})
// var calendar = $('#calendar').fullCalendar({
//     events: {
        
//         type: 'POST', // Send post data
//         error: function() {
//             alert('There was an error while fetching events.');
//         }
//     }
// });
});
</script>
	</div>
</body>
</html>