
<?php
  
  if(empty($_POST['target_id'])){
    header('Location: my-profile.php');
  }else{
    require_once('dbconnect/dbconnect.php');
  
    $target_id = $_POST['target_id'];

    $sql = 'SELECT * FROM `targets` WHERE `id`=?';
    $data = [$target_id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    $target = $stmt->fetch(PDO::FETCH_ASSOC);

    $errors = [];


    if (isset($_POST['edit'])) {

      $new_goal = $_POST['goal'];

      // もし、入力されていなかったら
      if($new_goal == ''){
        $errors['goal'] = '空';
      }
      $today = date("Y/m/d");
      if(strtotime($new_goal) <  strtotime($today)){
        $errors['goal'] = '過去';
      }

      if (empty($errors)) {
        // エラーがなかったら登録処理
        $sql = 'UPDATE `targets` SET `goal` = ? WHERE `id` = ?';

        $data = [$new_goal, $target_id];
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        header('Location: my-profile.php');
      }

    }

    if(isset($_POST['back'])){
      header('Location: my-profile.php');
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
                        <div class="usy-dt">
                          <div class="usy-name">
                            <h3>目標 : <?php echo $target['target']; ?></h3>
                          </div>
                        </div>
                      </div>
                      
                      <div class="post-project-fields">
                        <form action="goal-updata.php" method="POST">
                          <div class="row">
                            <input type="hidden" name="target_id" value=<?php echo $target_id ;?>>
                            <div class="col-lg-6">
                              <div class="">
                                <p>目標達成予定日</p>
                                <input type="date" name="goal">
                              </div>
                              <?php if (isset($errors['goal']) && $errors['goal'] == '空'): ?>
                                <span style="color: red;">達成予定日を入力してください</span>
                              <?php endif; ?>
                              <?php if (isset($errors['goal']) && $errors['goal'] == '過去'): ?>
                                <span style="color: red;">もう過ぎています</span>
                              <?php endif; ?>
                            </div>
                            <div class="col-lg-12">
                              <ul>
                                <li><button class="active" type="submit" name="edit">延長</button></li>
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