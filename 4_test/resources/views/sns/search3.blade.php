@extends('layouts.app')

@section('content')
<div class="search-sec">
  <div class="container">
    <div class="search-box">
      <form action="{{ route('search') }}" method="POST">
        {{ csrf_field() }}
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


          <div class="col-lg-3">
            <div class="filter-secs">
              <div class="filter-heading">
                <h3>検索フィルター</h3>
                <a href="#" title="">解除</a>
              </div><!--filter-heading end-->
              <div class="paddy">
                <div class="filter-dd">
                  <div class="filter-ttl">
                    <h3>名前</h3>
                    <a href="#" title="">解除</a>
                  </div>
                  <form>
                    <input type="text" name="search-skills" placeholder="名前で検索">
                  </form>
                </div>
                <div class="filter-dd">
                  <div class="filter-ttl">
                    <h3>カテゴリー</h3>
                    <a href="#" title="">解除</a>
                  </div>
                  <form class="job-tp">
                    <select>
                      <option>カテゴリーを選択</option>
                      <option>健康</option>
                      <option>お金</option>
                      <option>仕事</option>
                      <option>家族</option>
                      <option>教育</option>
                      <option>精神</option>
                      <option>楽しみ</option>
                    </select>
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                  </form>
                </div>
                <div class="filter-dd">
                  <div class="filter-ttl">
                    <h3>目標期間</h3>
                    <a href="#" title="">解除</a>
                  </div>
                  <form class="job-tp">
                    <select>
                      <option>期間を選択</option>
                      <option>毎日</option>
                      <option>週間</option>
                      <option>月間</option>
                      <option>年間</option>
                    </select>
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                  </form>
                </div>
                <div class="filter-dd">
                  <div class="filter-ttl">
                    <h3>表示するユーザー</h3>
                    <a href="#" title="">解除</a>
                  </div>
                  <form class="job-tp">
                    <select>
                      <option>全てのユーザー</option>
                      <option>ライバルのみ表示</option>
                    </select>
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                  </form>
                </div>
              </div>
            </div><!--filter-secs end-->
          </div>
          

          <div class="col-lg-6">
            <div class="main-ws-sec">
              <div class="posts-section">
                
                @foreach($targets as $target)
                  <div class="post-bar">
                    <div class="post_topbar">
                      <div class="usy-dt">
                        <img src="http://via.placeholder.com/50x50" alt="">
                        <div class="usy-name">
                          <h3>{{ $target->name }}</h3>
                          <span><img src="images/clock.png" alt="">3分前</span>
                        </div>
                      </div>
                      <div class="ed-opts">
                        <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                        <ul class="ed-options">
                          <li><a href="#" title="">編集</a></li>
                          <li><a href="#" title="">閉じる</a></li>
                          <li><a href="#" title="">非表示</a></li>
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
                      <h3>{{ $target->target }}</h3>
                      <ul class="job-dt">
                        <li><a href="#" title="">2018年10月28日</a></li>
                      </ul>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="#" title="">もっと見る</a></p>
                      <ul class="skill-tags">
                        <li><a href="#" title="">健康</a></li>
                        <li><a href="#" title="">お金</a></li>
                        <li><a href="#" title="">仕事</a></li>
                        <li><a href="#" title="">家族</a></li>
                        <li><a href="#" title="">教育</a></li>  
                      </ul>
                    </div>
                    <div class="job-status-bar">
                      <ul class="like-com">
                        <li>
                          <a href="#"><i class="la la-heart"></i>いいね</a>
                          <img src="images/liked-img.png" alt="">
                          <span>25</span>
                        </li> 
                        <li><a href="#" title="" class="com"><img src="images/com.png" alt="">コメント 15</a></li>
                      </ul>
                      <a><i class="la la-eye"></i>閲覧数 50</a>
                    </div>
                  </div><!--post-bar end-->
                @endforeach  

              </div><!--posts-section end-->
            </div><!--main-ws-sec end-->
          </div>
          
          <div class="col-lg-3">
            <div class="right-sidebar">
              <div class="widget widget-about">
                <img src="images/wd-logo.png" alt="">
                <h3>task manager</h3>
                <span>世界中にライバルを作ろう</span>
                <div class="sign_link">
                  <h3><a href="#" title="">サインアップ</a></h3>
                  <a href="#" title="">task managerとは</a>
                </div>
              </div><!--widget-about end-->
              <div class="widget widget-jobs">
                <div class="sd-title">
                  <h3>トップ　いいね</h3>
                  <i class="la la-ellipsis-v"></i>
                </div>
                <div class="jobs-list">
                  <div class="job-info">
                    <div class="job-details">
                      <h3>沖縄制覇</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                    </div>
                    <div class="hr-rate">
                      <span>50</span>
                    </div>
                  </div><!--job-info end-->
                  <div class="job-info">
                    <div class="job-details">
                      <h3>スケートボーダー</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                    </div>
                    <div class="hr-rate">
                      <span>50</span>
                    </div>
                  </div><!--job-info end-->
                  <div class="job-info">
                    <div class="job-details">
                      <h3>沖縄制覇</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                    </div>
                    <div class="hr-rate">
                      <span>50</span>
                    </div>
                  </div><!--job-info end-->
                  <div class="job-info">
                    <div class="job-details">
                      <h3>沖縄制覇</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                    </div>
                    <div class="hr-rate">
                      <span>50</span>
                    </div>
                  </div><!--job-info end-->
                  <div class="job-info">
                    <div class="job-details">
                      <h3>沖縄制覇</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                    </div>
                    <div class="hr-rate">
                      <span>50</span>
                    </div>
                  </div><!--job-info end-->
                </div><!--jobs-list end-->
              </div><!--widget-jobs end-->
              <div class="widget widget-jobs">
                <div class="sd-title">
                  <h3>週間アクセスランキング</h3>
                  <i class="la la-ellipsis-v"></i>
                </div>
                <div class="jobs-list">
                  <div class="job-info">
                    <div class="job-details">
                      <h3>沖縄制覇</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                    </div>
                    <div class="hr-rate">
                      <span>50</span>
                    </div>
                  </div><!--job-info end-->
                  <div class="job-info">
                    <div class="job-details">
                      <h3>沖縄制覇</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                    </div>
                    <div class="hr-rate">
                      <span>50</span>
                    </div>
                  </div><!--job-info end-->
                  <div class="job-info">
                    <div class="job-details">
                      <h3>沖縄制覇</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                    </div>
                    <div class="hr-rate">
                      <span>50</span>
                    </div>
                  </div><!--job-info end-->
                </div><!--jobs-list end-->
              </div><!--widget-jobs end-->
            </div><!--right-sidebar end-->
          </div>

        </div>
      </div><!-- main-section-data end-->
    </div> 
  </div>
</main>
@endsection