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

<!-- カレンダー機能 -->
<link rel="stylesheet" href="fullcalendar.min.css" type="text/css">
    <script src="moment.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="jquery-ui.custom.min.js" type="text/javascript"></script>
    <script src="fullcalendar.min.js" type="text/javascript"></script>
    <script src="ja.js" type="text/javascript"></script>
    <title>jQuery</title>
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
								</div><!--theme-layout end-->



							<script type="text/javascript" src="js/jquery.min.js"></script>
							<script type="text/javascript" src="js/popper.js"></script>
							<script type="text/javascript" src="js/bootstrap.min.js"></script>
							<script type="text/javascript" src="js/jquery.range-min.js"></script>
							<script type="text/javascript" src="lib/slick/slick.min.js"></script>
							<script type="text/javascript" src="js/script.js"></script>
							<script src='moment.min.js'></script>
							<script src='jquery.min2.js'></script>
							<script src='fullcalendar.min.js'></script>
							<script>

							  $(document).ready(function() {

							    $('#calendar').fullCalendar({
							      header: {
							        left: 'prev,next today',
							        center: 'title',
							        right: 'month,agendaWeek,agendaDay,listMonth'
							      },
							      defaultDate: '2018-03-12',
							      navLinks: true, // can click day/week names to navigate views
							      businessHours: true, // display business hours
							      editable: true,
							      events: [
							        {
							          title: 'Business Lunch',
							          start: '2018-03-03T13:00:00',
							          constraint: 'businessHours'
							        },
							        {
							          title: 'Meeting',
							          start: '2018-03-13T11:00:00',
							          constraint: 'availableForMeeting', // defined below
							          color: '#257e4a'
							        },
							        {
							          title: 'Conference',
							          start: '2018-03-18',
							          end: '2018-03-20'
							        },
							        {
							          title: 'Party',
							          start: '2018-03-29T20:00:00'
							        },

							        // areas where "Meeting" must be dropped
							        {
							          id: 'availableForMeeting',
							          start: '2018-03-11T10:00:00',
							          end: '2018-03-11T16:00:00',
							          rendering: 'background'
							        },
							        {
							          id: 'availableForMeeting',
							          start: '2018-03-13T10:00:00',
							          end: '2018-03-13T16:00:00',
							          rendering: 'background'
							        },

							        // red areas where no events can be dropped
							        {
							          start: '2018-03-24',
							          end: '2018-03-28',
							          overlap: false,
							          rendering: 'background',
							          color: '#ff9f89'
							        },
							        {
							          start: '2018-03-06',
							          end: '2018-03-08',
							          overlap: false,
							          rendering: 'background',
							          color: '#ff9f89'
							        }
							      ]
							    });

							  });

							</script>
						</body>
						</html>