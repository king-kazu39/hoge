<?php 
  
  session_start();
  require_once('dbconnect/dbconnect.php');

  // if (!isset($_SESSION['naxstage']['id'])) {
  //  header('Location:sign-in.html');
  // }

  // $signin_user_id = $_SESSTION['nexstage'];
  $signin_user_id = 1;

  //達成ボタンを押したとき、fequencyをdoneに対応する値に変える
  //taskを取得する前にこのsql文必要
  if(isset($_POST['achieve'])){
    $sql = 'UPDATE `tasks` SET `fequency` = ? WHERE `target_id` = ?';

    #4はdoneに対応しているので、後で変えてください
    $data = [4, $_POST['target_id']];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
  }

  // サインインしているユーザー情報をDBから読み込む
  //timeline.phpでは最後のwhere無くさないと、自分の投稿しか出ないはず
  // $sql = 'SELECT `t`.*, `u`.`id`, `u`. `name` 
  //     FROM `targets` AS `t` 
  //     LEFT JOIN `users` AS `u` 
  //     ON `t`.`user_id` = `u`. `id` 
  //     WHERE `t`.`user_id` = ? ';

  //taskを取得するsql文
  $sql = 'SELECT `tasks`.*, `u`.`name`, `targets`.`target`, `targets`.`goal`, `targets`.`category`
      FROM `tasks`
      LEFT JOIN `targets`
      ON `tasks`.`target_id` = `targets`.`id`
      LEFT JOIN `users` AS `u`
      ON `targets`.`user_id` = `u`.`id`
      WHERE `u`.`id` = ?
      ORDER BY `tasks`.`target_id` ASC ';

  $data = [$signin_user_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  // $user = $stmt->fetch(PDO::FETCH_ASSOC);


  // $users_name = ['users']['name'];
  // $targets = ['targets']['target'];


  // targets 入れる配列
  //$targets = array();
  $tasks = array();

  // レコードは無くなるまで取得処理
  while (true) {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    // もし取得するものがなくなったら処理を抜ける
    if ($record == false) {
      break;
    }

    // レコードがあれば追加
    //[]必要
    //$targets[] = $record;
    $tasks[] = $record;
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
                <div class="main-left-sidebar no-margin">
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

                  <!-- goal日程を過ぎたtargetに対して達成にするか、goal日程を伸ばすか選ばせる -->
                  <?php 
                     $target_id = 0;
                     $today = date("Y/m/d");
                  ?>
                  <?php foreach($tasks as $task) : ?>
                    <!-- 同じtargetがなんども出てこないように -->
                    <?php if($task['target_id'] != $target_id ): ?>
                      <!-- goal日程が過ぎたtargetの取得 -->
                      <?php if(strtotime($task['goal']) <  strtotime($today) and $task['fequency'] != 4): ?>
                        <div class="posts-section">
                          <div class="post-bar">

                            <div class="job_descp">
                              <h3 style="color:orange">達成予定日を過ぎました。</h3>
                              <p>目標 : <?php echo $task['target'] ?></p>
                              <p>達成予定日 <?php echo substr($task['goal'],0,10) ?></p>
                              <ul class="skill-tags">
                                <li>
                                  <!-- 達成の時はfrequencyを4(doneに対応)に更新させる -->
                                  <form action="my-profile.php" method="post">
                                    <input type="hidden" name="target_id" value=<?php echo $task['target_id'] ?>>
                                    <input type="submit" value="達成" name="achieve" style="color: #fff;font-size:16px; background-color: orange; border: 1px solid #e5e5e5;padding: 10px 25px; font-weight: 600; ">
                                  </form>
                                </li>
                                <li>
                                  <!-- 延長の時はtargetのgoalを更新する -->
                                  <form action="goal-updata.php" method="post" >
                                    <input type="hidden" name="target_id" value=<?php echo $task['target_id'] ?>>
                                    <input type="submit" value="延長" style="color: #fff;font-size:16px; background-color: orange; border: 1px solid #e5e5e5;padding: 10px 25px; font-weight: 600; ">
                                  </form>
                                </li>
                              </ul>
                            </div>
                          </div><!--post-bar end-->
                        </div>
                      <?php endif; ?>
                    <?php endif ; ?>
                    <?php $target_id = $task['target_id']; ?>
                  <?php endforeach; ?>

                  <div class="user-tab-sec">
                    <div class="tab-feed st2">
                      <ul>
                        <li data-tab="feed-dd" class="active">
                          <a href="#" title="">
                            <img src="images/ic_day.png" alt="">
                            <span>DAY</span>
                          </a>
                        </li>
                        <li data-tab="info-dd">
                          <a href="#" title="">
                            <img src="images/ic_week.png" alt="">
                            <span>WEEK</span>
                          </a>
                        </li>
                        <li data-tab="saved-jobs">
                          <a href="#" title="">
                            <img src="images/ic_month.png" alt="">
                            <span>MONTH</span>
                          </a>
                        </li>
                        <li data-tab="my-bids">
                          <a href="#" title="">
                            <img src="images/ic_done.png" alt="">
                            <span>DONE</span>
                          </a>
                        </li>
                      </ul>
                    </div><!-- tab-feed end-->
                  </div><!--user-tab-sec end-->

                  <div class="product-feed-tab current" id="feed-dd">
                    <div class="posts-section">
                      <?php foreach($tasks as $task) : ?>
                        <!-- dbのカラム名間違ってるわ -->
                        <!-- このfequencyカラムの値は適当に。(ここではdayが1) -->
                        <?php if($task['fequency'] == 1) : ?>
                          <div class="post-bar">
                            <div class="post_topbar">
                              <div class="usy-dt">
                                <img src="http://via.placeholder.com/50x50" alt="">
                                <div class="usy-name">
                                  <h3><?php echo $task['name']; ?></h3>
                                  <!-- <span><img src="images/clock.png" alt="">3 min ago</span> -->
                                  <span><img src="images/clock.png" alt="">達成予定日 <?php echo substr($task['goal'],0,10) ?></span>
                                </div>
                              </div>
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
                                  <!-- <li><a href="#" title="">編集</a></li>
                                  <li><a href="#" title="">消去</a></li>
                                  <li><a href="#" title="">非表示</a></li> -->
                                </ul>
                              </div>
                            </div>
                            <div class="epi-sec">
                              <!-- <ul class="descp">
                                <li><img src="images/icon8.png" alt=""><span>Epic Coder</span></li>
                                <li><img src="images/icon9.png" alt=""><span>India</span></li>
                              </ul>
                              <ul class="bk-links">
                                <li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
                                <li><a href="#" title=""><i class="la la-envelope"></i></a></li>
                              </ul> -->
                            </div>
                            <div class="job_descp">
                              <p>目標 : <?php echo $task['target'] ?></p>
                              <h3>タスク : <?php echo $task['task']; ?></h3>
                              <!-- <p><a href="#" title="">view more</a></p>
                              <p>ハマチ・マグロ・えび・いか </p> -->
                              <ul class="skill-tags">
                                <li><a href="#" title=""><?php echo $task['category'] ?></a></li>
                                <!-- <li><a href="#" title="">寿司</a></li>
                                <li><a href="#" title="">食べ放題</a></li> -->
                              </ul>
                            </div>
                            <div class="job-status-bar">
                              <ul class="like-com">
                                <li>
                                  <a href="#"title="" class="com"><i class="la la-heart"></i>いいね</a>
                                  <!-- <span>25</span> -->
                                </li> 
                                <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> コメント 15</a></li>
                              </ul>
                              <a><i class="la la-eye"></i>Views 50</a>
                            </div>
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

                  <div class="product-feed-tab" id="info-dd">
                    <div class="posts-section">
                      <?php foreach($tasks as $task) : ?>
                        <!-- dbのカラム名間違ってるわ -->
                        <!-- このfequencyカラムの値は適当に。(ここではweekが2) -->
                        <?php if($task['fequency'] == 2) : ?>
                          <div class="post-bar">
                            <div class="post_topbar">
                              <div class="usy-dt">
                                <img src="http://via.placeholder.com/50x50" alt="">
                                <div class="usy-name">
                                  <h3><?php echo $task['name']; ?></h3>
                                  <!-- <span><img src="images/clock.png" alt="">3 min ago</span> -->
                                  <span><img src="images/clock.png" alt="">達成予定日 <?php echo substr($task['goal'],0,10) ?></span>
                                </div>
                              </div>
                              <div class="ed-opts">
                                <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                <ul class="ed-options">
                                  <li><a href="#" title="">編集</a></li>
                                  <li><a href="#" title="">消去</a></li>
                                  <li><a href="#" title="">非表示</a></li>
                                </ul>
                              </div>
                            </div>
                            <div class="epi-sec">
                              <!-- <ul class="descp">
                                <li><img src="images/icon8.png" alt=""><span>Epic Coder</span></li>
                                <li><img src="images/icon9.png" alt=""><span>India</span></li>
                              </ul>
                              <ul class="bk-links">
                                <li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
                                <li><a href="#" title=""><i class="la la-envelope"></i></a></li>
                              </ul> -->
                            </div>
                            <div class="job_descp">
                              <p>目標 : <?php echo $task['target'] ?></p>
                              <h3>タスク : <?php echo $task['task']; ?>
                              <!-- </h3><p><a href="#" title="">view more</a></p>
                              <p>味噌・醤油・豚骨 </p> -->
                              <ul class="skill-tags">
                                <li><a href="#" title=""><?php echo $task['category'] ?></a></li>
                                <!-- <li><a href="#" title="">寿司</a></li>
                                <li><a href="#" title="">食べ放題</a></li> -->
                              </ul>
                            </div>
                            <div class="job-status-bar">
                              <ul class="like-com">
                                <li>
                                  <a href="#"title="" class="com"><i class="la la-heart"></i>いいね</a>
                                  <!-- <span>25</span> -->
                                </li> 
                                <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> コメント 15</a></li>
                              </ul>
                              <a><i class="la la-eye"></i>Views 50</a>
                            </div>
                          </div><!--post-bar end-->
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
                        <!-- dbのカラム名間違ってるわ -->
                        <!-- このfequencyカラムの値は適当に。(ここではmonthが3) -->
                        <?php if($task['fequency'] == 3) : ?>
                          <div class="post-bar">
                            <div class="post_topbar">
                              <div class="usy-dt">
                                <img src="http://via.placeholder.com/50x50" alt="">
                                <div class="usy-name">
                                  <h3><?php echo $task['name']; ?></h3>
                                  <!-- <span><img src="images/clock.png" alt="">3 min ago</span> -->
                                  <span><img src="images/clock.png" alt="">達成予定日 <?php echo substr($task['goal'],0,10) ?></span>
                                </div>
                              </div>
                              <div class="ed-opts">
                                <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                <ul class="ed-options">
                                  <li><a href="#" title="">編集</a></li>
                                  <li><a href="#" title="">消去</a></li>
                                  <li><a href="#" title="">非表示</a></li>
                                </ul>
                              </div>
                            </div>
                            <div class="epi-sec">
                              <!-- <ul class="descp">
                                <li><img src="images/icon8.png" alt=""><span>Epic Coder</span></li>
                                <li><img src="images/icon9.png" alt=""><span>India</span></li>
                              </ul>
                              <ul class="bk-links">
                                <li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
                                <li><a href="#" title=""><i class="la la-envelope"></i></a></li>
                              </ul> -->
                            </div>
                            <div class="job_descp">
                              <p>目標 : <?php echo $task['target'] ?></p>
                              <h3>タスク : <?php echo $task['task']; ?>
                              <!-- </h3><p><a href="#" title="">view more</a></p>
                              <p>うし・ぶた・ひつじ・とり </p> -->
                              <ul class="skill-tags">
                                <li><a href="#" title=""><?php echo $task['category'] ?></a></li>
                                <!-- <li><a href="#" title="">寿司</a></li>
                                <li><a href="#" title="">食べ放題</a></li> -->
                              </ul>
                            </div>
                            <div class="job-status-bar">
                              <ul class="like-com">
                                <li>
                                  <a href="#"title="" class="com"><i class="la la-heart"></i>いいね</a>
                                  <!-- <span>25</span> -->
                                </li> 
                                <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> コメント 15</a></li>
                              </ul>
                              <a><i class="la la-eye"></i>Views 50</a>
                            </div>
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

                  <!-- doneでは達成済みの目標を表示する -->
                  <div class="product-feed-tab" id="my-bids">
                    <div class="posts-section">
                      <!-- 同じ目標がなんども表示されないように -->
                      <?php $target_id = 0; ?>
                      <?php foreach($tasks as $task) : ?>
                        <!-- dbのカラム名間違ってるわ -->
                        <!-- このfequencyカラムの値は適当に。(ここではdoneが4) -->
                        <?php if($task['fequency'] == 4) : ?>
                          <?php if($task['target_id'] != $target_id): ?>
                            <div class="post-bar">
                              <div class="post_topbar">
                                <div class="usy-dt">
                                  <img src="http://via.placeholder.com/50x50" alt="">
                                  <div class="usy-name">
                                    <h3><?php echo $task['name']; ?></h3>
                                    <!-- <span><img src="images/clock.png" alt="">3 min ago</span> -->
                                    <span><img src="images/clock.png" alt="">達成日 <?php echo substr($task['goal'],0,10) ?></span>
                                  </div>
                                </div>
                                <div class="ed-opts">
                                  <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                  <ul class="ed-options">
                                    <li><a href="#" title="">編集</a></li>
                                    <li><a href="#" title="">消去</a></li>
                                    <!-- <li><a href="#" title="">非表示</a></li> -->
                                  </ul>
                                </div>
                              </div>
                              <div class="epi-sec">
                                <!-- <ul class="descp">
                                  <li><img src="images/icon8.png" alt=""><span>Epic Coder</span></li>
                                  <li><img src="images/icon9.png" alt=""><span>India</span></li>
                                </ul> -->
                                <!-- <ul class="bk-links">
                                  <li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
                                  <li><a href="#" title=""><i class="la la-envelope"></i></a></li>
                                </ul> -->
                              </div>
                              <div class="job_descp">
                                <h3>達成した目標 : <?php echo $task['target'] ?></h3>
                                <!-- <h3><?php echo $task['task'] ?></h3> -->
                                <!-- <p><a href="#" title="">view more</a></p> -->
                                <!-- <p>ハマチ・マグロ・えび・いか </p> -->
                                <ul class="skill-tags">
                                  <li><a href="#" title=""><?php echo $task['category'] ?></a></li>
                                  <!-- <li><a href="#" title="">食べ放題</a></li> -->
                                </ul>
                              </div>
                              <div class="job-status-bar">
                                <ul class="like-com">
                                  <li>
                                    <a href="#"title="" class="com"><i class="la la-heart"></i>いいね</a>
                                    <!-- <span>25</span> -->
                                  </li> 
                                  <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> コメント 15</a></li>
                                </ul>
                                <a><i class="la la-eye"></i>Views 50</a>
                              </div>
                            </div><!--post-bar end-->
                          <?php endif ; ?>  
                        <?php endif ; ?>
                        <?php $target_id = $task['target_id']; ?>
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