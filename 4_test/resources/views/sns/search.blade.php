
@extends('layouts.side_search')          

@section('right_side')
<div class="main-ws-sec">
  @if(isset($inputs) == 0)
  <div class="posts-section">
    <div class="tab-feed st2">
      <ul>
        <li data-tab="feed-dd" class="active">
          <a href="#" title="">
            <img src="images/ic1.png" alt="">
            <span>健康</span>
          </a>
        </li>
        <li data-tab="info-dd">
          <a href="#" title="">
            <img src="images/ic2.png" alt="">
            <span>お金</span>
          </a>
        </li>
        <li data-tab="saved-jobs">
          <a href="#" title="">
            <img src="images/ic4.png" alt="">
            <span>仕事</span>
          </a>
        </li>
        <li data-tab="my-bids">
          <a href="#" title="">
            <img src="images/ic5.png" alt="">
            <span>家族</span>
          </a>
        </li>
        <li data-tab="portfolio-dd">
          <a href="#" title="">
            <img src="images/ic3.png" alt="">
            <span>教育</span>
          </a>
        </li>
        <li data-tab="payment-dd">
          <a href="#" title="">
            <img src="images/ic6.png" alt="">
            <span>精神</span>
          </a>
        </li>
        <li data-tab="pleasure-dd">
          <a href="#" title="">
            <img src="images/ic6.png" alt="">
            <span>楽しみ</span>
          </a>
        </li>
      </ul>
    </div><!-- tab-feed end-->  
  </div><!--posts-section end-->

  <!-- 1ページ目 -->
  <div class="product-feed-tab current" id="feed-dd">
    <div class="posts-section">
      @foreach($targets as $target)
        @if($target->category_id == 1)
          <div class="post-bar">
            <div class="post_topbar">
              <div class="usy-dt">
                <img src="{{$target->img_name}}" height="50px" width="50px">
                <div class="usy-name">
                  <h3><a href="{{ route('show', $target->user_id) }}">{{$target->name}}</a></h3>
                  <span><img src="images/clock.png" alt="">3分前</span>
                </div>
              </div>
            </div>
            <div class="job_descp">
              <h3>{{$target->target}}</h3>
              <ul class="job-dt">
                <li><a href="#" title="">カテゴリ名</a></li>
              </ul>
              <ul class="skill-tags">
                <li>スタート : {{substr($target->created_at,0,10)}}</li>
                <li>ゴール : {{substr($target->goal,0,10)}}</li>
              </ul>
            </div>
            <div class="job-status-bar">
              <ul class="like-com">
                <li><a href="#" title="" class="com"><i class="la la-heart-o"></i> like 15</a></li>
                <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
              </ul>
              <a><i class="la la-eye"></i>閲覧数 50</a>
            </div>
          </div><!--post-bar end-->
        @endif  
      @endforeach

      <!-- <div class="process-comm">
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>
      </div>--><!--process-comm end--> 
    </div><!--posts-section end-->
  </div><!--product-feed-tab end-->

 <!--  2ページ目 -->
  <div class="product-feed-tab" id="info-dd">
    <div class="posts-section">
      @foreach($targets as $target)
        @if($target->category_id == 2)
          <div class="post-bar">
            <div class="post_topbar">
              <div class="usy-dt">
                <img src="{{$target->img_name}}" height="50px" width="50px">
                <div class="usy-name">
                  <h3><a href="{{ route('show', $target->user_id) }}">{{$target->name}}</a></h3>
                  <span><img src="images/clock.png" alt="">3分前</span>
                </div>
              </div>
            </div>
            <div class="job_descp">
              <h3>{{$target->target}}</h3>
              <ul class="job-dt">
                <li><a href="#" title="">カテゴリ名</a></li>
              </ul>
              <ul class="skill-tags">
                <li>スタート : {{substr($target->created_at,0,10)}}</li>
                <li>ゴール : {{substr($target->goal,0,10)}}</li>
              </ul>
            </div>
            <div class="job-status-bar">
              <ul class="like-com">
                <li><a href="#" title="" class="com"><i class="la la-heart-o"></i> like 15</a></li>
                <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
              </ul>
              <a><i class="la la-eye"></i>閲覧数 50</a>
            </div>
          </div><!--post-bar end-->
        @endif  
      @endforeach

      <!-- <div class="process-comm">
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>
      </div>--><!--process-comm end--> 
    </div><!--posts-section end-->
  </div><!--product-feed-tab end-->

  <!-- 3ページ目 -->
  <div class="product-feed-tab" id="saved-jobs">
    <div class="posts-section">
      @foreach($targets as $target)
        @if($target->category_id == 3)
          <div class="post-bar">
            <div class="post_topbar">
              <div class="usy-dt">
                <img src="{{$target->img_name}}" height="50px" width="50px">
                <div class="usy-name">
                  <h3><a href="{{ route('show', $target->user_id) }}">{{$target->name}}</a></h3>
                  <span><img src="images/clock.png" alt="">3分前</span>
                </div>
              </div>
            </div>
            <div class="job_descp">
              <h3>{{$target->target}}</h3>
              <ul class="job-dt">
                <li><a href="#" title="">カテゴリ名</a></li>
              </ul>
              <ul class="skill-tags">
                <li>スタート : {{substr($target->created_at,0,10)}}</li>
                <li>ゴール : {{substr($target->goal,0,10)}}</li>
              </ul>
            </div>
            <div class="job-status-bar">
              <ul class="like-com">
                <li><a href="#" title="" class="com"><i class="la la-heart-o"></i> like 15</a></li>
                <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
              </ul>
              <a><i class="la la-eye"></i>閲覧数 50</a>
            </div>
          </div><!--post-bar end-->
        @endif  
      @endforeach

      <!-- <div class="process-comm">
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>
      </div>--><!--process-comm end--> 
    </div><!--posts-section end-->
  </div><!--product-feed-tab end-->

  <!-- 4ページ目 -->
  <div class="product-feed-tab" id="my-bids">
    <div class="posts-section">
      @foreach($targets as $target)
        @if($target->category_id == 4)
          <div class="post-bar">
            <div class="post_topbar">
              <div class="usy-dt">
                <img src="{{$target->img_name}}" height="50px" width="50px">
                <div class="usy-name">
                  <h3><a href="{{ route('show', $target->user_id) }}">{{$target->name}}</a></h3>
                  <span><img src="images/clock.png" alt="">3分前</span>
                </div>
              </div>
            </div>
            <div class="job_descp">
              <h3>{{$target->target}}</h3>
              <ul class="job-dt">
                <li><a href="#" title="">カテゴリ名</a></li>
              </ul>
              <ul class="skill-tags">
                <li>スタート : {{substr($target->created_at,0,10)}}</li>
                <li>ゴール : {{substr($target->goal,0,10)}}</li>
              </ul>
            </div>
            <div class="job-status-bar">
              <ul class="like-com">
                <li><a href="#" title="" class="com"><i class="la la-heart-o"></i> like 15</a></li>
                <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
              </ul>
              <a><i class="la la-eye"></i>閲覧数 50</a>
            </div>
          </div><!--post-bar end-->
        @endif  
      @endforeach

      <!-- <div class="process-comm">
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>
      </div>--><!--process-comm end--> 
    </div><!--posts-section end-->
  </div><!--product-feed-tab end-->

  <!-- 5ページ目 -->
  <div class="product-feed-tab" id="portfolio-dd">
    <div class="posts-section">
      @foreach($targets as $target)
        @if($target->category_id == 5)
          <div class="post-bar">
            <div class="post_topbar">
              <div class="usy-dt">
                <img src="{{$target->img_name}}" height="50px" width="50px">
                <div class="usy-name">
                  <h3><a href="{{ route('show', $target->user_id) }}">{{$target->name}}</h3>
                  <span><img src="images/clock.png" alt="">3分前</span>
                </div>
              </div>
            </div>
            <div class="job_descp">
              <h3>{{$target->target}}</h3>
              <ul class="job-dt">
                <li><a href="#" title="">カテゴリ名</a></li>
              </ul>
              <ul class="skill-tags">
                <li>スタート : {{substr($target->created_at,0,10)}}</li>
                <li>ゴール : {{substr($target->goal,0,10)}}</li>
              </ul>
            </div>
            <div class="job-status-bar">
              <ul class="like-com">
                <li><a href="#" title="" class="com"><i class="la la-heart-o"></i> like 15</a></li>
                <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
              </ul>
              <a><i class="la la-eye"></i>閲覧数 50</a>
            </div>
          </div><!--post-bar end-->
        @endif  
      @endforeach

      <!-- <div class="process-comm">
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>
      </div>--><!--process-comm end--> 
    </div><!--posts-section end-->
  </div><!--product-feed-tab end-->

  <!-- 6ページ目 -->
  <div class="product-feed-tab" id="payment-dd">
    <div class="posts-section">
      @foreach($targets as $target)
        @if($target->category_id == 6)
          <div class="post-bar">
            <div class="post_topbar">
              <div class="usy-dt">
                <img src="{{$target->img_name}}" height="50px" width="50px">
                <div class="usy-name">
                  <h3><a href="{{ route('show', $target->user_id) }}">{{$target->name}}</h3>
                  <span><img src="images/clock.png" alt="">3分前</span>
                </div>
              </div>
            </div>
            <div class="job_descp">
              <h3>{{$target->target}}</h3>
              <ul class="job-dt">
                <li><a href="#" title="">カテゴリ名</a></li>
              </ul>
              <ul class="skill-tags">
                <li>スタート : {{substr($target->created_at,0,10)}}</li>
                <li>ゴール : {{substr($target->goal,0,10)}}</li>
              </ul>
            </div>
            <div class="job-status-bar">
              <ul class="like-com">
                <li><a href="#" title="" class="com"><i class="la la-heart-o"></i> like 15</a></li>
                <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
              </ul>
              <a><i class="la la-eye"></i>閲覧数 50</a>
            </div>
          </div><!--post-bar end-->
        @endif  
      @endforeach

      <!-- <div class="process-comm">
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>
      </div>--><!--process-comm end--> 
    </div><!--posts-section end-->
  </div><!--product-feed-tab end-->

  <!-- 7ページ目 -->
  <div class="product-feed-tab" id="pleasure-dd">
    <div class="posts-section">
      @foreach($targets as $target)
        @if($target->category_id == 7)
          <div class="post-bar">
            <div class="post_topbar">
              <div class="usy-dt">
                <img src="{{$target->img_name}}" height="50px" width="50px">
                <div class="usy-name">
                  <h3><a href="{{ route('show', $target->user_id) }}">{{$target->name}}</h3>
                  <span><img src="images/clock.png" alt="">3分前</span>
                </div>
              </div>
            </div>
            <div class="job_descp">
              <h3>{{$target->target}}</h3>
              <ul class="job-dt">
                <li><a href="#" title="">カテゴリ名</a></li>
              </ul>
              <ul class="skill-tags">
                <li>スタート : {{substr($target->created_at,0,10)}}</li>
                <li>ゴール : {{substr($target->goal,0,10)}}</li>
              </ul>
            </div>
            <div class="job-status-bar">
              <ul class="like-com">
                <li><a href="#" title="" class="com"><i class="la la-heart-o"></i> like 15</a></li>
                <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
              </ul>
              <a><i class="la la-eye"></i>閲覧数 50</a>
            </div>
          </div><!--post-bar end-->
        @endif  
      @endforeach

      <!-- <div class="process-comm">
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>
      </div>--><!--process-comm end--> 
    </div><!--posts-section end-->
  </div><!--product-feed-tab end-->

  @else
    <div class="posts-section">
      @foreach($targets as $target)
        <div class="post-bar">
          <div class="post_topbar">
            <div class="usy-dt">
              <img src="{{$target->img_name}}" height="50px" width="50px">
              <div class="usy-name">
                <h3><a href="">{{$target->name}}</a></h3>
                <span><img src="images/clock.png" alt="">３時間(dbとつないでcreated_atと現在の時間の差)</span>
              </div>
            </div>
          </div>
        
          <div class="job_descp">
            <h3>目標 : {{$target->target}}</h3>
            <ul class="job-dt">
              <li><a href="#" title="">カテゴリ名</a></li>
              <!-- <li><span>$30 / hr</span></li> -->
            </ul>
            <ul class="skill-tags">
              <li>スタート : {{substr($target->created_at,0,10)}}</li>
              <li>ゴール : {{substr($target->goal,0,10)}}</li>
            </ul>
          </div>

          <div class="job-status-bar">
            <ul class="like-com">
              <li><a href="#" title="" class="com"><i class="la la-heart-o"></i> like 15</a></li>
              <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comment 15</a></li>
            </ul>
            <a><i class="la la-eye"></i>Views 50</a>
          </div>
        </div><!--post-bar end-->
      @endforeach
    </div><!--posts-section end-->
  @endif  
</div>
@endsection