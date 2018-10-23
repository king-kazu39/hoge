
<?php

  session_start();
  require_once('dbconnect/dbconnect.php');

  //ユーザのログインの確認
  // if (!isset($_SESSION['naxstage']['id'])) {
  //  header('Location:sign-in.php');
  // }
  // $signin_user_id = $_SESSTION['nexstage']['id'];
  $signin_user_id = 1;

  // =====================ここからsigninユーザ情報取得=====================

  $sql = 'SELECT * FROM `users` WHERE `id` = ?';
  $data = [$signin_user_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

  // =====================ここまでsigninユーザ情報取得=====================

  // ========================ここから目標数とライバル数取得=============================

    $sql = 'SELECT `target_count`,`rival_count` FROM `activities` WHERE `user_id` = ?';
    $data = [$signin_user_id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    // フェッチする
    $target_rival_count = $stmt->fetch(PDO::FETCH_ASSOC);

  // ========================ここまで目標数とライバル数取得=============================

  if(empty($_POST['task_id'])){
    header('Location: timeline.php');
  }else{

    $task_id = $_POST['task_id'];

    $sql = 'SELECT `tasks`.*, `targets`.`target`
            FROM `tasks` 
            LEFT JOIN `targets`
            ON `tasks`.`target_id` = `targets`.`id`
            WHERE `tasks`.`id`=?';
    $data = [$task_id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    $task_edit = '';
    $freq = '';

    $errors = [];

    if (isset($_POST['edit'])) {

      $task_edit = $_POST['task'];
      $freq = $_POST['freq'];

      
      // もし、入力されていなかったら
      if ($task_edit == '') {
        $errors['task'] = '空';
      }
      if ($freq == '') {
        $errors['freq'] = '空';
      }

      if (empty($errors)) {
        $sql = 'UPDATE `tasks` SET `task` = ?, `fequency` = ? WHERE `id` = ?';

        $data = [$task_edit, $freq, $task_id];
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        header('Location: profile.php?user_id='.$signin_user_id);
        exit();
      }

    }

    if(isset($_POST['back'])){
      header('Location: profile.php?user_id='.$signin_user_id);
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
            <a href="timeline.php" title=""><img src="images/logo.png" alt=""></a>
          </div><!--logo end-->

          <div class="menu-btn">
            <a href="my-profile.html" title=""><i class="fa fa-bars"></i></a>
          </div><!--menu-btn end-->
          <div class="user-account">
            <div class="user-info">
              <img src="http://via.placeholder.com/30x30" alt="">
              <a href=<?php echo "profile.php?user_id=".$signin_user_id; ?>><?php echo $signin_user['name'] ?></a>
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
                      <h3><?php echo $signin_user['name'] ?></h3>
                      <span><?php echo $signin_user['id'] ?></span>
                    </div>
                  </div><!--user-profile end-->
                  <ul class="flw-status">
                    <li>
                      <a href="search.html">
                        <span>目標数</span>
                        <?php if($target_rival_count): ?>
                          <b><?php echo $target_rival_count['target_count']; ?></b>
                        <?php else: ?>
                          <b>0</b>
                        <?php endif; ?>
                      </a>
                    </li>
                    <li>
                      <a href="rivals.html">
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
              </div>

              <div class="col-lg-8">
                <div class="product-feed-tab current" id="feed-dd">
                  <div class="posts-section">
                    <div class="post-bar">
                      <div class="post_topbar">
                        <div class="usy-dt">
                          <div class="usy-name">
                            <h3>目標 : <?php echo $task['target']; ?></h3>
                          </div>
                        </div>
                      </div>
                              

                      <div class="post-project-fields">
                        <form action="task-updata.php" method="POST">
                          <input type="hidden" name="task_id" value=<?php echo $task_id; ?>>
                          <div class="row">
                            <div class="col-lg-12">
                              <p>タスク</p>
                              <input type="text" name="task" placeholder=<?php echo $task['task']; ?>>
                              <?php if (isset($errors['task']) && $errors['task'] == '空'): ?>
                                <span style="color: red;">タスクを入力してください</span>
                                <br>
                                <br>
                              <?php endif; ?>
                            </div>
                            <div class="col-lg-12">
                              <div class="inp-field">
                                <select name="freq">
                                  <option value="">確認頻度</option>
                                  <?php if($task['fequency'] == 1): ?>
                                    <option value="1" selected>1日ごと</option>
                                  <?php else: ?>
                                    <option value="1">1日ごと</option>
                                  <?php endif; ?>
                                  <?php if($task['fequency'] == 2): ?>
                                    <option value="2" selected>1週間ごと</option>
                                  <?php else: ?>
                                    <option value="2">1週間ごと</option>
                                  <?php endif; ?>
                                  <?php if($task['fequency'] == 3): ?>
                                    <option value="3" selected>1ヶ月ごと</option>
                                  <?php else: ?>
                                    <option value="3">1ヶ月ごと</option>
                                  <?php endif; ?>  
                                </select>
                              </div>
                              <?php if (isset($errors['freq']) && $errors['freq'] == '空'): ?>
                              <span style="color: red;">選択してください</span>
                              <?php endif; ?>
                            </div>
                            <div class="col-lg-12">
                              <ul>
                                <li><button class="active" type="submit" name="edit">編集する</button></li>
                                <li><button class="active" type="submit" name="back">戻る</button></li>
                              </ul>
                            </div>
                          </div>
                        </form>
                      </div><!--post-project-fields end-->


                    </div><!--post-bar end-->
                  </div><!--posts-section end-->
                </div><!--product-feed-tab end-->

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