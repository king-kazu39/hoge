<?php
	session_start();
	require_once('dbconnect/dbconnect.php');
    require_once('function.php');

	// if (!isset($_SESSION['naxstage_test']['id'])) {
	// 	header('Location:signup_and_in.php');
	// }

    



	
	$signin_user_id = $_SESSION['nexstage_test']['id'];



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
	$sql = 'SELECT `t`.*, `u`.`id`, `u`. `name` 
			FROM `targets` AS `t` 
			LEFT JOIN `users` AS `u` 
			ON `t`.`user_id` = `u`. `id` 
			WHERE `t`.`user_id` = ? ';






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

// ===================ページ数遷移機能=========================

        $page = 1;
        $start = 0;

        // 定数定義
        const CONSTANT_PER_PAGE = 10;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            // -1など不正な値の入力の対策
            $page = max($page, 1);

            // ヒットしたレコードを取得するSQL
            $sql_count = "SELECT COUNT(*) AS `cnt` FROM `targets`";
            $stmt_count = $dbh->prepare($sql_count);
            $stmt_count->execute();
            $record_cnt = $stmt_count->fetch(PDO::FETCH_ASSOC); 

            // 取得したページ数を割って最終ページが何ページになるのかを取得
            $last_page = ceil($record_cnt['cnt'] / CONSTANT_PER_PAGE);

            // 最後のページより大きい値を渡された場合に、適切な値に置き換える
            $page = min($page, $last_page);
            $start = ($page -1) * CONSTANT_PER_PAGE;
        }


// ===================ここまでページ数遷移機能===================



// =====================ここから自分の目標宣言取得=====================

    // サインインしているユーザー情報をDBから読み込む
    // usersとtargets２つのテーブルを結合
    // TODO:サインアップ→サインインした時の表示を直す
    $sql = 'SELECT `t`.*, `u`.`id` AS `feed_id`, `u`. `name`, `u`.`img_name` 
            FROM `targets` AS `t` 
            LEFT JOIN `users` AS `u` 
            ON `t`.`user_id` = `u`. `id` ORDER BY `t`. `created` DESC LIMIT ' . CONSTANT_PER_PAGE . ' OFFSET ' . $start;

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

// ===========================================コメント一覧============================================
        // feed一件毎のコメント一覧を取得する
        $record['comments'] = get_comments($dbh, $record['id']);
        // コメント数を取得
        $record["comment_cnt"] = count_comments($dbh, $record['id']);
// =================ここまでコメント一覧==================================================================

        // レコードがあれば追加
        $feeds[] = $record;
    }

// =====================ここまで自分の目標宣言取得========================================================

// ================================左の目標一覧===========================================================

        $sigin_user_id = $_SESSION['nexstage_test']['id'];



        $sql = "SELECT `t`.*, `u`.`id` AS `user_id` , `u`.`img_name` 
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
// ================================ここまで左の目標一覧============================================================



        $errors = [];


        if (!empty($_POST)) {
            // 宣言する！ボタンを押すとこのif文が実行されます


            // $signin_user_id = $_SESSION['nexstage_test']['id'];
            $signin_user_id = 5;
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

                $data = [$signin_user_id, $target, $category, $freq, $goal];
                $stmt = $dbh->prepare($sql);
                $stmt->execute($data);

                $feedd = $stmt->fetch(PDO::FETCH_ASSOC);
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
                            <img src="user_profile_img/<?php echo $user['img_name']; ?>" width = '30' height="30" alt="">
                            <a href="my-profile.php" style="width:80px; height:20px; font-size: 20px; float:left; title=""><?php echo $user['name']; ?></a>
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
                                <div class="main-left-sidebar no-margin">
                                    <div class="user-data full-width">
                                        <div class="user-profile">
                                            <div class="username-dt">
                                                <div class="usr-pic">
                                                    <a href="my-profile.php"><img src="user_profile_img/<?= $user['img_name'] ?>" width="100" height="100" class="rounded-circle"></a>
                                                </div>
                                            </div><!--username-dt end-->
                                            <div class="user-specs">
                                                <!-- TODO：文字サイズ -->
                                                <h3 style="font-size: 40px"><?php echo $user['name']; ?></h3>
                                                
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

                                    </div><!--suggestions end-->



                                    


                                </div><!--main-left-sidebar end-->
                            </div>



                            <div class="col-lg-8 col-md-8 no-pd">
                                <div class="main-ws-sec">
                                    <div class="post-topbar">
                                        <div class="user-picy">
                                            <img src="user_profile_img/<?php echo $user['img_name']; ?>" alt="">
                                        </div>
                                        <div class="post-st">
                                            <ul>
                                                <li><a class="post-jb active" href="＃" title="">目標を書く</a></li>
                                            </ul>
                                        </div><!--post-st end-->
                                    </div><!--post-topbar end-->
                                
                                    
                                <?php foreach ($feeds as $feed): ?>
                                    <div class="posts-section">
                                        
                                        <div class="post-bar">
                                            
                                            <div class="post_topbar">
                                                <div class="usy-dt">

                                                <img src="user_profile_img/<?php echo $feed['img_name']; ?>" width = "40" height="40">
                                                <a href="another_account.html" style="font-size: 35px">
                                                  <?php echo $feed['name']; ?>
                                                </a>
                                                </div>
                                                <br><br><br>
                                                    <div class="usy-name">

                                                        <span><img src="images/clock.png" alt="">時間表示</span>
                                                    </div>
                                            </div>

                                            
                                            <div class="job_descp">
                                                <h3><?php echo $feed['target']; ?></h3>
                                                <ul class="job-dt">
                                                    <li><a href="#" title=""><?php echo $feed['category']; ?></a></li>
                                                    <!-- <li><span>$30 / hr</span></li> -->
                                                </ul>
                                                <ul class="skill-tags">
                                                    <li>スタート : <?php echo $feed['created']; ?></li>
                                                    <li>ゴール :<?php echo $feed['goal']; ?></li>
                                                </ul>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
<!-- ===========================いいね機能実装===============================================- -->
                                                    <div>
                                                        <span hidden ><?= $target["id"] ?></span>

                                                        <!-- いいねしていない場合 -->
                                                        <button class="js-like">
                                                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                            <span>いいね!</span>
                                                        </button>
                                                        <span hidden class="user-id"><?php echo $user['id']; ?></span>
                                                        <span hidden class="target-id"><?php echo $feed['id']; ?></span>
                                                        <span>: </span>
                                                        <span class="like_count">10</span>
<!-- ===========================ここまでいいね機能実装===============================================- -->
<!-- ======================コメント機能============================================================== -->
						
						<a href="#collapseComment<?= $feed["id"] ?>" data-toggle="collapse" aria-expanded="false">
                                    <span>コメント</span>
                                </a>
                                <span class="comment_count">: <?= $feed["comment_cnt"] ?></span>

                                <br>
                                <?php include('comment_view.php'); ?>
                    </div>
<!-- ========================================ここまでコメント機能=========================================== -->
                                                </ul>
                                            </div>
                                        </div><!--post-bar end-->
                                <?php endforeach; ?>

<!--================= ページ数切り替え処理 ============================-->
    <!-- 最初のページでNewer押させねぇ！！！ -->
    <?php if ($page == 1): ?>
        <!-- 最初のページだったら -->
        <a>Newer</a>
        <?php else: ?>
            <a href="?page=<?php echo $page -1 ?>">Newer</a>
    <?php endif; ?>

    <!-- 最後のページでOlderは押させねぇ！！！ -->
    <?php if ($page == $last_page): ?>
        <a>Older</a>
        <?php else: ?>
        <!-- それ以外の時 -->
        <a href="timeline.php?page=<?php echo $page +1; ?>">Older</a>
    <?php endif; ?>

<!--================= ここまでページ数切り替え処理 =====================-->



                                        <!-- <div class="process-comm">
                                            <div class="spinner">
                                                <div class="bounce1"></div>
                                                <div class="bounce2"></div>
                                                <div class="bounce3"></div>
                                            </div>
                                        </div>--><!--process-comm end--> 
                                    </div><!--posts-section end-->
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


        <div class="post-popup job_post">
            <div class="post-project">
                <h3>目標達成</h3>
                <div class="post-project-fields">
                    <form action="timeline.php" method="POST">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" name="title" placeholder="目標入力">
                                <?php if (isset($errors['target']) && $errors['target'] == '空'): ?>
                                <span style="color: red;">目標を入力してください</span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-12">
                                <div class="inp-field">
                                    <select>
                                        <option>カテゴリ</option>
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
                                    <select>
                                        <option>確認頻度</option>
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
                                <div class="price-br">
                                    <input type="date" name="goal">
                                </div>
                                <?php if (isset($errors['goal']) && $errors['goal'] == '空'): ?>
                                <span style="color: red;">達成予定日をしてください</span>
                                <?php endif; ?>
                            </div>
                                <ul>
                                    <li><button class="active" type="submit" value="post">宣言する！</button></li>
                                    <li><a href="timeline.php" title="">考え直す</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div><!--post-project-fields end-->
                <!-- <a href="timeline.php" title=""><i class="la la-times-circle-o"></i></a> -->
            </div><!--post-project end-->
        </div><!--post-project-popup end-->
    </div><!--theme-layout end-->


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/scrollbar.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>