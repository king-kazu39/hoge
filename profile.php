<?php 
  
  session_start();
  require_once('dbconnect/dbconnect.php');

  //ユーザのログインの確認
  // if (!isset($_SESSION['naxstage']['id'])) {
  //  header('Location:sign-in.php');
  // }
  $signin_user_id = $_SESSION['nexstage_test']['id'];
  // $signin_user_id = 1;

  // =====================ここからsigninユーザ情報取得=====================

  $sql = 'SELECT * FROM `users` WHERE `id` = ?';
  $data = [$signin_user_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

  // =====================ここまでsigninユーザ情報取得=====================

  // =====================ここからそれぞれのユーザ情報取得=====================

  if(!isset($_GET['user_id'])){
    header('Location:timeline.php');
  }
  $user_id = $_GET['user_id'];

  $sql = 'SELECT * FROM `users` WHERE `id` = ?';
  $data = [$user_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // =====================ここまでそれぞれのユーザ情報取得=====================

  //達成ボタンを押したとき、targetsのdoneを変更する。
  //taskを取得する前にこのsql文必要
  if(isset($_GET['done'])){
    $sql = 'UPDATE `targets` SET `done` = ? WHERE `id` = ?';

    $data = [1, $_GET['target_id']];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
  }

  //targetの取得
  $sql = 'SELECT * FROM `targets` WHERE `user_id` = ?';
  $data = [$user_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $targets = array();
  // レコードは無くなるまで取得処理
  while (true) {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);




    // もし取得するものがなくなったら処理を抜ける
    if ($record == false) {
      break;
    }

    $targets[] = $record;
  }

  // echo "<pre>";
  // var_dump($targets);
  // echo "</pre>";

  //taskの取得
  //targetsとtaskの順番はこの順にしないといけない
  $sql = 'SELECT `targets`.*, `tasks`.*
      FROM `tasks`
      LEFT JOIN `targets`
      ON `tasks`.`target_id` = `targets`.`id`
      WHERE `targets`.`user_id` = ?
      ORDER BY `tasks`.`target_id` ASC ';

  $data = [$user_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $tasks = array();
  // レコードは無くなるまで取得処理
  while (true) {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    // もし取得するものがなくなったら処理を抜ける
    if ($record == false) {
      break;
    }

    $tasks[] = $record;
  }

  // echo "<pre>";
  // var_dump($tasks);
  // echo "</pre>";

  //ライバル追加(another用)
  //if(isset($_POST['rival'])){
  if(isset($_GET['rival-add'])){
    //リダイレクト対策
    $sql = 'SELECT * FROM `rivals` WHERE  `user_id` = ? and `rival_id` =  ?';
    $data = [$signin_user_id, $user_id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    if($record == false){
      $sql = 'INSERT INTO `rivals`(`user_id`, `rival_id`) VALUES (?, ?)';
      $data = [$signin_user_id, $user_id];
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
    }
  }
  //ライバル削除
  if(isset($_GET['rival-del'])){
    $sql = 'DELETE FROM `rivals` WHERE `user_id` = ? and `rival_id` =  ?';
    $data = [$signin_user_id, $user_id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
  }


$user_id = $_GET['user_id'];

  $sql = 'SELECT * FROM `users` WHERE `id` = ?';
  $data = [$user_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $user = $stmt->fetch(PDO::FETCH_ASSOC);



  //ライバル取得(signinユーザの)
  //ライバル申請ボタン用に必要
  $sql = 'SELECT * FROM `rivals` WHERE `user_id` = ?';
  $data = [$signin_user_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $signin_rivals = array();
  // レコードは無くなるまで取得処理
  while (true) {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    // もし取得するものがなくなったら処理を抜ける
    if ($record == false) {
      break;
    }

    $signin_rivals[] = $record;
  }

  //ライバルの取得(このページのユーザの)
  $sql = 'SELECT * FROM `rivals` WHERE `user_id` = ?';
  $data = [$user_id];
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
<link rel="stylesheet" type="text/css" href="css/flatpickr.min.css">
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
          
          <div class="logo">
            <a href="timeline.php" title=""><img src="images/logo.png" alt=""></a>
          </div><!--logo end-->

          <div class="menu-btn">
            <a href="my-profile.php" title=""><i class="fa fa-bars"></i></a>
          </div><!--menu-btn end-->
          <div class="user-account">
            <div class="user-info">
              <img src="user_profile_img/<?= $user['img_name'] ?>" width="30" height="30" alt="">
              <!-- 遷移先を変更 -->
              <a style="height:20px; font-size: 20px;" href=<?php echo "profile.php?user_id=".$signin_user_id; ?>><?php echo $signin_user['name'] ?></a>
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

              <!-- サイドバー -->
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
                        <h3><?php echo $user['name'] ?></h3>
                        
                      </div>
                    </div><!--user-profile end-->

                    <ul class="flw-status">
                      <li>
                        <a href="search.php">
                          <span>目標数</span>
                          <b><?php echo count($targets); ?></b>
                        </a>
                      </li>
                      <li>
                        <a href="rivals.php">
                          <span>ライバル</span>
                          <b><?php echo count($rivals); ?></b>
                        </a>
                      </li>
                    </ul>
                    
                    <!-- ライバル申請ボタン等 -->
                    <?php if($signin_user_id != $user_id): ?>
                      <!-- 既にライバルかどうかの確認 -->
                      <?php 
                        $whether_rival = 0;
                        // 0のままならライバルではない
                        foreach($signin_rivals as $rival){
                          if($rival['rival_id'] == $user_id){
                            $whether_rival = 1;
                            break;
                          }
                        }
                      ?>
                      
                      <!-- <form action="profile.php" method="POST"> -->
                      <form action="profile.php" method="get">
                        <input type="hidden" name="user_id" value=<?php echo $user_id ?>>
                        <?php if($whether_rival == 0): ?>
                          <button class="active" type="submit" name="rival-add" value="" style="    background-color: orange;color: #fff;font-size: 16px;border: 1px solid #e5e5e5;padding: 10px 25px;font-weight: 600;cursor: pointer;">ライバル申請</button>
                        <?php else: ?>
                          <button class="active" type="submit" name="rival-del" value="" style="    background-color: orange;color: #fff;font-size: 16px;border: 1px solid #e5e5e5;padding: 10px 25px;font-weight: 600;cursor: pointer;">ライバルをやめる</button>
                        <?php endif; ?>
                      </form>
                    <?php endif; ?>  
                    <br>
                  </div><!--user-data end-->

                  <ul class="social_links">
                    <h5>SNSを連携する</h5>
                    <li><a href="#" title=""><i class="la la-globe"></i> www.example.com</a></li>
                    <li><a href="#" title=""><i class="fa fa-facebook-square"></i> Http://www.facebook.com/john...</a></li>
                    <li><a href="#" title=""><i class="fa fa-twitter"></i> Http://www.Twitter.com/john...</a>
                  </ul>
                </div><!--main-left-sidebar end-->
              </div>

              

              <div class="col-lg-8">
                <div class="main-ws-sec">

                <div class="user-tab-sec">
                    <div class="tab-feed st2">
                      <ul>
                        <li data-tab="feed-dd" class="active">
                          <img src="images/ic_day.png" alt="">
                          <span>DAY</span>
                        </li>
                        <li data-tab="info-dd">
                          <img src="images/ic_week.png" alt="">
                          <span>WEEK</span>
                        </li>
                        <li data-tab="saved-jobs">
                          <img src="images/ic_month.png" alt="">
                          <span>MONTH</span>
                        </li>
                        <li data-tab="my-bids">
                          <img src="images/ic15.png" alt="">
                          <span>DONE</span>
                        </li>
                        <li data-tab="portfolio-dd">
                          <img src="images/ic_done.png" alt="">
                          <span>LIST</span>
                        </li>
                      </ul>
                    </div><!-- tab-feed end-->
              </div><!--user-tab-sec end-->

                  <!-- goal日程を過ぎたtargetに対して達成にするか、goal日程を伸ばすか選ばせる -->
                  <?php if($signin_user_id == $user_id): ?>
                    <?php foreach($targets as $target) : ?>
                      <!-- goal日程が過ぎたtargetの取得 -->
                      <!-- dbのfrequencyの綴り間違えてる -->
                      <?php if(strtotime($target['goal']) <  strtotime(date("Y/m/d")) and $target['done'] == 0): ?>
                        <div class="posts-section">
                          <div class="post-bar">

                            <div class="job_descp">
                              <h3 style="color:orange">達成予定日を過ぎました。</h3>
                              <p>目標 : <?php echo $target['target'] ?></p>
                              <p>達成予定日 <?php echo substr($target['goal'],0,10) ?></p>
                              <ul class="job-dt">
                                <li>
                                  <!-- 達成の時はdoneを1に更新させる -->
                                  <form action="profile.php" method="get">
                                    <input type="hidden" name="target_id" value=<?php echo $target['id'] ?>>
                                    <input type="hidden" name="user_id" value=<?php echo $user_id ?>>
                                    <input type="submit" value="達成" name="done" style="color: #fff;font-size:16px; background-color: orange; border: 1px solid #e5e5e5;padding: 10px 25px; font-weight: 600; ">
                                  </form>
                                </li>
                                <li>
                                  <!-- 延長の時はtargetのgoalを更新する -->
                                  <form action="goal-updata.php" method="post" >
                                    <input type="hidden" name="target_id" value=<?php echo $target['id'] ?>>
                                    <input type="submit" value="延長" style="color: #fff;font-size:16px; background-color: orange; border: 1px solid #e5e5e5;padding: 10px 25px; font-weight: 600; ">
                                  </form>
                                </li>
                              </ul>
                            </div>
                          </div><!--post-bar end-->
                        </div>
                      <?php endif ; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>  



                  <div class="product-feed-tab current" id="feed-dd">
                    <div class="posts-section">
                      <?php foreach($tasks as $task) : ?>
                        <!-- 達成済みかどうかの確認 -->
                        <?php if($task['done'] == 0) : ?>
                          <!-- dbのカラム名間違ってるわ -->
                          <!-- このfequencyカラムの値は適当に。(ここではdayが1) -->
                          <?php if($task['frequency'] == 1) : ?>
                            <div class="post-bar">
                              <div class="post_topbar">
                                <div class="usy-dt">
                                  <img src="http://via.placeholder.com/50x50" alt="">
                                  <div class="usy-name">
                                    <h3 style="width:auto"><?php echo $user['name']; ?></h3>
                                    <span><img src="images/clock.png" alt="">達成予定日 <?php echo substr($task['goal'],0,10) ?></span>
                                  </div>
                                </div>
                                <?php if($user_id == $signin_user_id): ?>
                                  <div class="ed-opts">
                                    <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                    <ul class="ed-options">
                                      <!-- タスクの編集 -->
                                      <li>
                                        <form action="task-updata.php" method="post" >
                                          <input type="hidden" name="task_id" value=<?php echo $task['id'] ?>>
                                          <input type="submit" value="編集" style="color: #686868;font-size: 14px;font-weight: 600;border-style: none;">
                                        </form>
                                      </li>
                                      <li>
                                        <!-- タスクの削除 -->
                                        <form action="task-delete.php" method="post" >
                                          <input type="hidden" name="task_id" value=<?php echo $task['id'] ?>>
                                          <input type="submit" value="削除" style="color: #686868;font-size: 14px;font-weight: 600;border-style: none;">
                                        </form>
                                      </li>
                                    </ul>
                                  </div>
                                <?php endif; ?>
                              </div>
                              <div class="job_descp">
                                <p>目標 : <?php echo $task['target'] ?></p>
                                <h3>タスク : <?php echo $task['task']; ?></h3>
                                <ul class="job-dt">
                                  <li><a href="#" title=""><?php echo $task['category'] ?></a></li>
                                </ul>
                              </div>
                            </div><!--post-bar end-->
                          <?php endif ; ?>
                        <?php endif; ?>  
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

                  <div class="product-feed-tab" id="info-dd">
                    <div class="posts-section">
                      <?php foreach($tasks as $task) : ?>
                        <!-- 達成済みかどうかの確認 -->
                        <?php if($task['done'] == 0) : ?>
                          <!-- dbのカラム名間違ってるわ -->
                          <!-- このfequencyカラムの値は適当に。(ここではdayが1) -->
                          <?php if($task['frequency'] == 2) : ?>
                            <div class="post-bar">
                              <div class="post_topbar">
                                <div class="usy-dt">
                                  <img src="http://via.placeholder.com/50x50" alt="">
                                  <div class="usy-name">
                                    <h3 style="width:auto"><?php echo $user['name']; ?></h3>
                                    <span><img src="images/clock.png" alt="">達成予定日 <?php echo substr($task['goal'],0,10) ?></span>
                                  </div>
                                </div>
                                <?php if($user_id == $signin_user_id): ?>
                                  <div class="ed-opts">
                                    <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                    <ul class="ed-options">
                                      <!-- タスクの編集 -->
                                      <li>
                                        <form action="task-updata.php" method="post" >
                                          <input type="hidden" name="task_id" value=<?php echo $task['id'] ?>>
                                          <input type="submit" value="編集" style="color: #686868;font-size: 14px;font-weight: 600;border-style: none;">
                                        </form>
                                      </li>
                                      <li>
                                        <!-- タスクの削除 -->
                                        <form action="task-delete.php" method="post" >
                                          <input type="hidden" name="task_id" value=<?php echo $task['id'] ?>>
                                          <input type="submit" value="削除" style="color: #686868;font-size: 14px;font-weight: 600;border-style: none;">
                                        </form>
                                      </li>
                                    </ul>
                                  </div>
                                <?php endif; ?>
                              </div>
                              <div class="job_descp">
                                <p>目標 : <?php echo $task['target'] ?></p>
                                <h3>タスク : <?php echo $task['task']; ?></h3>
                                <ul class="job-dt">
                                  <li><a href="#" title=""><?php echo $task['category'] ?></a></li>
                                </ul>
                              </div>
                            </div><!--post-bar end-->
                          <?php endif ; ?>
                        <?php endif; ?>  
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
                      <?php foreach($tasks as $task) : ?>
                        <!-- 達成済みかどうかの確認 -->
                        <?php if($task['done'] == 0) : ?>
                          <!-- dbのカラム名間違ってるわ -->
                          <!-- このfequencyカラムの値は適当に。(ここではdayが1) -->
                          <?php if($task['frequency'] == 3) : ?>
                            <div class="post-bar">
                              <div class="post_topbar">
                                <div class="usy-dt">
                                  <img src="http://via.placeholder.com/50x50" alt="">
                                  <div class="usy-name">
                                    <h3 style="width:auto"><?php echo $user['name']; ?></h3>
                                    <span><img src="images/clock.png" alt="">達成予定日 <?php echo substr($task['goal'],0,10) ?></span>
                                  </div>
                                </div>
                                <?php if($user_id == $signin_user_id): ?>
                                  <div class="ed-opts">
                                    <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                    <ul class="ed-options">
                                      <!-- タスクの編集 -->
                                      <li>
                                        <form action="task-updata.php" method="post" >
                                          <input type="hidden" name="task_id" value=<?php echo $task['id'] ?>>
                                          <input type="submit" value="編集" style="color: #686868;font-size: 14px;font-weight: 600;border-style: none;">
                                        </form>
                                      </li>
                                      <li>
                                        <!-- タスクの削除 -->
                                        <form action="task-delete.php" method="post" >
                                          <input type="hidden" name="task_id" value=<?php echo $task['id'] ?>>
                                          <input type="submit" value="削除" style="color: #686868;font-size: 14px;font-weight: 600;border-style: none;">
                                        </form>
                                      </li>
                                    </ul>
                                  </div>
                                <?php endif; ?>
                              </div>
                              <div class="job_descp">
                                <p>目標 : <?php echo $task['target'] ?></p>
                                <h3>タスク : <?php echo $task['task']; ?></h3>
                                <ul class="job-dt">
                                  <li><a href="#" title=""><?php echo $task['category'] ?></a></li>
                                </ul>
                              </div>
                            </div><!--post-bar end-->
                          <?php endif ; ?>
                        <?php endif; ?>  
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

                  <!-- doneでは達成済みの目標を表示する -->
                  <div class="product-feed-tab" id="my-bids">
                    <div class="posts-section">
                      <?php foreach($targets as $target) : ?>
                        <!-- 達成済みのtarget -->
                        <?php if($target['done'] == 1) : ?>
                          <div class="post-bar">
                            <div class="post_topbar">
                              <div class="usy-dt">
                                <img src="user_profile_img/<?php echo $user['img_name'] ?>" width = '40' height = '40' alt="">
                                <div class="usy-name">
                                  <h3 style="width:auto"><?php echo $user['name']; ?></h3>
                                  <span><img src="images/clock.png" alt="">達成日 <?php echo substr($target['goal'],0,10) ?></span>
                                </div>
                              </div>
                            </div>
                            <div class="job_descp">
                              <h3>達成した目標 : <?php echo $target['target'] ?></h3>
                              <ul class="job-dt">
                                <li><a href="#"><?php echo $target['category'] ?></a></li>
                              </ul>
                            </div>
                            <!-- div class="job-status-bar">
                              <ul class="like-com">
                                <li>
                                  <a href="#"title="" class="com"><i class="la la-heart"></i>いいね 25</a> -->
                                  <!-- <span>25</span> -->
                                <!-- </li> 
                                <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> コメント 15</a></li>
                              </ul>
                              <a><i class="la la-eye"></i>Views 50</a> -->
                            <!-- </div> -->
                          </div><!--post-bar end-->
                        <?php endif ; ?>
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

                  <div class="product-feed-tab" id="portfolio-dd">
                    <div class="posts-section">
                      <?php foreach($targets as $target) : ?>
                        <div class="post-bar">
                          <div class="post_topbar">
                            <div class="usy-dt">
                              <img src="user_profile_img/<?php echo $user['img_name'] ?>" width = '40' height = '30' alt="">
                              <div class="usy-name">
                                <h3 style="width:auto"><?php echo $user['name']; ?></h3>
                                <span><img src="images/clock.png" alt="">達成予定日 <?php echo substr($target['goal'],0,10) ?></span>
                              </div>
                            </div>
                          </div>
                          <div class="job_descp">
                            <h3>目標 : <?php echo $target['target'] ?></h3>
                            <?php $i = 1; ?>
                            <?php foreach($tasks as $task): ?>
                              <?php if($task['target_id'] == $target['id']): ?>
                                <p>タスク<?php echo $i; ?> : <?php echo $task['task']; ?>
                                  <?php if($task['frequency'] == 1):?>
                                    (1日ごと)
                                  <?php elseif($task['frequency'] == 2): ?>
                                    (1週間ごと)
                                  <?php elseif($task['frequency'] == 3): ?>
                                    (1ヶ月ごと)
                                  <?php endif; ?>
                                </p>
                                <?php $i += 1; ?>
                              <?php endif; ?>
                            <?php endforeach; ?>
                            <ul class="job-dt">
                              <li><a href="#"><?php echo $target['category'] ?></a></li>
                            <li><a href="do.php" class="add_task">タスクを追加する</a></li>
                            </ul>
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
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
      </div><!--overview-edit end-->
    </div><!--overview-box end-->


    <div class="overview-box" id="experience-box">
      <div class="overview-edit">
        <h3>Experience</h3>
        <form>
          <input type="text" name="subject" placeholder="Subject">
          <textarea></textarea>
          <button type="submit" class="save">Save</button>
          <button type="submit" class="save-add">Save & Add More</button>
          <button type="submit" class="cancel">Cancel</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
      </div><!--overview-edit end-->
    </div><!--overview-box end-->

    <div class="overview-box" id="education-box">
      <div class="overview-edit">
        <h3>Education</h3>
        <form>
          <input type="text" name="school" placeholder="School / University">
          <div class="datepicky">
            <div class="row">
              <div class="col-lg-6 no-left-pd">
                <div class="datefm">
                  <input type="text" name="from" placeholder="From" class="datepicker"> 
                  <i class="fa fa-calendar"></i>
                </div>
              </div>
              <div class="col-lg-6 no-righ-pd">
                <div class="datefm">
                  <input type="text" name="to" placeholder="To" class="datepicker">
                  <i class="fa fa-calendar"></i>
                </div>
              </div>
            </div>
          </div>
          <input type="text" name="degree" placeholder="Degree">
          <textarea placeholder="Description"></textarea>
          <button type="submit" class="save">Save</button>
          <button type="submit" class="save-add">Save & Add More</button>
          <button type="submit" class="cancel">Cancel</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
      </div><!--overview-edit end-->
    </div><!--overview-box end-->

    <div class="overview-box" id="location-box">
      <div class="overview-edit">
        <h3>Location</h3>
        <form>
          <div class="datefm">
            <select>
              <option>Country</option>
              <option value="pakistan">Pakistan</option>
              <option value="england">England</option>
              <option value="india">India</option>
              <option value="usa">United Sates</option>
            </select>
            <i class="fa fa-globe"></i>
          </div>
          <div class="datefm">
            <select>
              <option>City</option>
              <option value="london">London</option>
              <option value="new-york">New York</option>
              <option value="sydney">Sydney</option>
              <option value="chicago">Chicago</option>
            </select>
            <i class="fa fa-map-marker"></i>
          </div>
          <button type="submit" class="save">Save</button>
          <button type="submit" class="cancel">Cancel</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
      </div><!--overview-edit end-->
    </div><!--overview-box end-->

    <div class="overview-box" id="skills-box">
      <div class="overview-edit">
        <h3>Skills</h3>
        <ul>
          <li><a href="#" title="" class="skl-name">HTML</a><a href="#" title="" class="close-skl"><i class="la la-close"></i></a></li>
          <li><a href="#" title="" class="skl-name">php</a><a href="#" title="" class="close-skl"><i class="la la-close"></i></a></li>
          <li><a href="#" title="" class="skl-name">css</a><a href="#" title="" class="close-skl"><i class="la la-close"></i></a></li>
        </ul>
        <form>
          <input type="text" name="skills" placeholder="Skills">
          <button type="submit" class="save">Save</button>
          <button type="submit" class="save-add">Save & Add More</button>
          <button type="submit" class="cancel">Cancel</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
      </div><!--overview-edit end-->
    </div><!--overview-box end-->

    <div class="overview-box" id="create-portfolio">
      <div class="overview-edit">
        <h3>Create Portfolio</h3>
        <form>
          <input type="text" name="pf-name" placeholder="Portfolio Name">
          <div class="file-submit">
            <input type="file" name="file">
          </div>
          <div class="pf-img">
            <img src="http://via.placeholder.com/60x60" alt="">
          </div>
          <input type="text" name="website-url" placeholder="htp://www.example.com">
          <button type="submit" class="save">Save</button>
          <button type="submit" class="cancel">Cancel</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
      </div><!--overview-edit end-->
    </div><!--overview-box end-->

  </div><!--theme-layout end-->



<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/flatpickr.min.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>