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

	// $signin_user_id = $_SESSTION['nexstage'];
	// $signin_user_id = 5;

	// サインインしているユーザー情報をDBから読み込む
	// usersとtargets２つのテーブルを結合
	// TODO:サインアップ→サインインした時の表示を直す
	$sql = 'SELECT `t`.*, `u`.`id`, `u`. `name` 
			FROM `targets` AS `t` 
			LEFT JOIN `users` AS `u` 
			ON `t`.`user_id` = `u`. `id` 
			WHERE `t`.`user_id` = ? ';

    // TODO: ID仮打ち→OK
    // $signin_user_id = $_SESSION['nexstage_test']['id'];
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
        // $sigin_user_id = 5;


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



                                    <div class="suggestions full-width">
                                        <div class="sd-title">
                                            <h3>おすすめライバル(最近目標立てた人から同じカテゴリ?)</h3>
                                            <i class="la la-ellipsis-v"></i>
                                        </div><!--sd-title end-->
                                        <div class="suggestions-list">
                                            <div class="suggestion-usd">
                                                <img src="http://via.placeholder.com/35x35" alt="">
                                                <div class="sgt-text">
                                                    <h4><a href="">ジェフ・ベゾス</a></h4>
                                                    <span>(1番の)目標</span>
                                                </div>
                                                <span></span>
                                            </div>
                                            <div class="view-more">
                                                <a href="#" title="">ライバル申請</a>
                                            </div>
                                        </div><!--suggestions-list end-->

                                        <div class="suggestions-list">
                                            <div class="suggestion-usd">
                                                <img src="http://via.placeholder.com/35x35" alt="">
                                                <div class="sgt-text">
                                                    <h4><a href="">マック・ザッカーバーグ</a></h4>
                                                    <span>(1番の)目標</span>
                                                </div>
                                                <span></span>
                                            </div>
                                            <div class="view-more">
                                                <a href="#" title="">ライバル申請</a>
                                            </div>
                                        </div><!--suggestions-list end-->
                                    </div><!--suggestions end-->

                                    <div class="tags-sec full-width">
                                        <ul>
                                            <li><a href="#" title="">Help Center</a></li>
                                            <li><a href="#" title="">About</a></li>
                                            <li><a href="#" title="">Privacy Policy</a></li>
                                            <li><a href="#" title="">Community Guidelines</a></li>
                                            <li><a href="#" title="">Cookies Policy</a></li>
                                            <li><a href="#" title="">Career</a></li>
                                            <li><a href="#" title="">Language</a></li>
                                            <li><a href="#" title="">Copyright Policy</a></li>
                                        </ul>
                                        <div class="cp-sec">
                                            <img src="images/logo2.png" alt="">
                                            <p><img src="images/cp.png" alt="">Copyright 2018</p>
                                        </div>
                                    </div><!--tags-sec end-->

                                </div><!--main-left-sidebar end-->
                            </div>



                            <div class="col-lg-8 col-md-8 no-pd">
                                <div class="main-ws-sec">
                                    <div class="post-topbar">
                                        <div class="user-picy">
                                            <img src="http://via.placeholder.com/100x100" alt="">
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


                                                    <img src="user_profile_img/<?php echo $feed['img_name']; ?>" width = "40">
                                                    <div class="usy-name">
                                                        <h3><a href="another_account.php">

                                                            <?php echo $feed['name']; ?>
                                                        </a></h3>
                                                        <span><img src="images/clock.png" alt="">３時間(dbとつないでcreated_atと現在の時間の差)</span>
                                                    </div>
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
                                                    <!-- <li>
                                                        <a href="#"><i class="la la-heart"></i> Like</a>
                                                        <img src="images/liked-img.png" alt="">
                                                        <span>25</span>
                                                    </li>  -->
                                                    <li><a href="#" title="" class="com"><i class="la la-heart-o"></i> like 15</a></li>
                                                    <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
                                                </ul>
                                                <a><i class="la la-eye"></i>Views 50</a>
                                            </div>
                                        </div><!--post-bar end-->
                                <?php endforeach; ?>
                                        



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
                    <form>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" name="title" placeholder="目標の入力">
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
                            </div>
                            <div class="col-lg-12">
                                <div class="inp-field">
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
                            </div>
                            <div class="col-lg-6">
                                <div class="price-br">
                                    <input type="yy/mm/dd" name="price1" placeholder="いつまでに">
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
                                <textarea name="description" placeholder="やること"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <ul>
                                    <li><button class="active" type="submit" value="post">宣言する！</button></li>
                                    <li><a href="search.php" title="">考え直す</a></li>
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
<script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/scrollbar.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>