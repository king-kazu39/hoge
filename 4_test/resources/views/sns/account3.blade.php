@extends('layouts.side_account')

@section('right_side')

<div class="main-ws-sec">
  
  <div class="user-tab-sec">
    <h3>Chihiro</h3>
    <div class="tab-feed st2">
      <ul>
        <li data-tab="feed-dd" class="active">
          <a href="#" title="">
            <img src="images/ic1.png" alt="">
            <span>DAY</span>
          </a>
        </li>
        <li data-tab="info-dd">
          <a href="#" title="">
            <img src="images/ic2.png" alt="">
            <span>WEEK</span>
          </a>
        </li>
        <li data-tab="saved-jobs">
          <a href="#" title="">
            <img src="images/ic4.png" alt="">
            <span>MONTH</span>
          </a>
        </li>
        <li data-tab="my-bids">
          <a href="#" title="">
            <img src="images/ic5.png" alt="">
            <span>DONE</span>
          </a>
        </li>
      </ul>
    </div><!-- tab-feed end-->
  </div><!--user-tab-sec end-->

  <!-- 1日 -->
  <div class="product-feed-tab current" id="feed-dd">
    <div class="posts-section">
      <div class="post-bar">
        <div class="post_topbar">
          <div class="usy-dt">
            <img src="http://via.placeholder.com/50x50" alt="">
            <div class="usy-name">
              <h3> Chihiro</h3>
              <span><img src="images/clock.png" alt="">3 min ago</span>
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
        <div class="job_descp">
          <h3>寿司食べ放題いく</h3><p><a href="#" title="">view more</a></p>
          <p>寿司・寿司・寿司 </p>
          <ul class="skill-tags">
            <li><a href="#" title="">寿司</a></li>
            <li><a href="#" title="">食べ放題</a></li>
          </ul>
        </div>
        <div class="job-status-bar">
          <ul class="like-com">
            <li>
              <a href="#"title="" class="com"><i class="la la-heart"></i>いいね 15</a>
              <!-- <span>25</span> -->
            </li> 
            <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> コメント 15</a></li>
          </ul>
          <a><i class="la la-eye"></i>Views 50</a>
        </div>
      </div><!--post-bar end-->

      <div class="process-comm">
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>
      </div><!--process-comm end-->
    </div><!--posts-section end-->
  </div><!--product-feed-tab end-->
    
  <!-- 1週間 -->
  <div class="product-feed-tab" id="info-dd">
    <div class="posts-section">
      <div class="post-bar">
        <div class="post_topbar">
          <div class="usy-dt">
            <img src="http://via.placeholder.com/50x50" alt="">
            <div class="usy-name">
              <h3> Chihiro</h3>
              <span><img src="images/clock.png" alt="">3 min ago</span>
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
        <div class="job_descp">
          <h3>寿司食べ放題いく</h3><p><a href="#" title="">view more</a></p>
          <p>寿司・寿司・寿司 </p>
          <ul class="skill-tags">
            <li><a href="#" title="">寿司</a></li>
            <li><a href="#" title="">食べ放題</a></li>
          </ul>
        </div>
        <div class="job-status-bar">
          <ul class="like-com">
            <li>
              <a href="#"title="" class="com"><i class="la la-heart"></i>いいね 15</a>
              <!-- <span>25</span> -->
            </li> 
            <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> コメント 15</a></li>
          </ul>
          <a><i class="la la-eye"></i>Views 50</a>
        </div>
      </div><!--post-bar end-->

      <div class="process-comm">
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>
      </div><!--process-comm end-->
    </div><!--posts-section end-->
  </div><!--product-feed-tab end-->

  <!-- 1ヶ月 -->
  <div class="product-feed-tab" id="saved-jobs">
    <div class="posts-section">
      <div class="post-bar">
        <div class="post_topbar">
          <div class="usy-dt">
            <img src="http://via.placeholder.com/50x50" alt="">
            <div class="usy-name">
              <h3> Chihiro</h3>
              <span><img src="images/clock.png" alt="">3 min ago</span>
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
          <h3>寿司食べ放題いく</h3><p><a href="#" title="">view more</a></p>
          <p>寿司・寿司・寿司 </p>
          <ul class="skill-tags">
            <li><a href="#" title="">寿司</a></li>
            <li><a href="#" title="">食べ放題</a></li>
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

      <div class="process-comm">
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>
      </div><!--process-comm end-->
    </div><!--posts-section end-->
  </div><!--product-feed-tab end-->

  <!-- done -->
  <div class="product-feed-tab" id="my-bids">
    <div class="posts-section">
      <div class="post-bar">
        <div class="post_topbar">
          <div class="usy-dt">
            <img src="http://via.placeholder.com/50x50" alt="">
            <div class="usy-name">
              <h3> Chihiro</h3>
              <span><img src="images/clock.png" alt="">3 min ago</span>
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
          <h3>寿司食べ放題いく</h3><p><a href="#" title="">view more</a></p>
          <p>寿司・寿司・寿司 </p>
          <ul class="skill-tags">
            <li><a href="#" title="">寿司</a></li>
            <li><a href="#" title="">食べ放題</a></li>
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
@endsection