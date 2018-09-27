@extends('layouts.side_home')

@section('right_side')
  <div class="main-ws-sec">
    <div class="post-topbar">
      <div class="user-picy">
        <img src="images/target.jpg" height="50px" width="100px">
      </div>
      <div class="post-st">
        <ul>
          <li><a class="active" href="{{ route('create') }}">目標を書く</a></li>
        </ul>
      </div><!--post-st end-->
    </div><!--post-topbar end-->
  
    <div class="posts-section">
      @foreach($targets as $target)
        <div class="post-bar">
          <div class="post_topbar">
            <div class="usy-dt">
              <img src="{{$target->img_name}}" height="50px" width="50px">
              <div class="usy-name">
                <h3><a href="{{ route('show', $target->user_id)}}">{{$target->name}}</a></h3>
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

　</div><!--main-ws-sec end-->

@endsection

