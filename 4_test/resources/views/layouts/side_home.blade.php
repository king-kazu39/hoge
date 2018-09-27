@extends('layouts.app')

@section('content')
<main>
<div class="main-section">
  <div class="container">
    <div class="main-section-data">
      <div class="row">

        @guest
          <div class="col-lg-4 col-md-4 pd-left-none no-pd">
            ログインしていません
          </div>    
        @else
          <div class="col-lg-4 col-md-4 pd-left-none no-pd">
            <div class="main-left-sidebar no-margin">
              
              <div class="user-data full-width">
                <div class="user-profile">
                  <div class="username-dt">
                    <div class="usr-pic">
                      <a href=""><img src="{{ $user->img_name }}" class="rounded-circle" height="100px" width="100px" ></a>
                    </div>
                  </div><!--username-dt end-->
                  <div class="user-specs">
                    <h3>{{ $user->name }}</h3>
                    <!-- <span>{{ $user->id }}</span> -->
                  </div>
                </div><!--user-profile end-->
                <ul class="user-fw-status">
                  <li>
                    <h4>目標数</h4>
                    <span><a href="{{ route('show', $user->id) }}">34</a></span>
                  </li>
                  <li>
                    <h4>ライバル</h4>
                    <span><a href="">155</a></span>
                  </li>
                </ul>

              </div><!--user-data end-->

              <div class="suggestions full-width">
                <div class="sd-title">
                  <h3>自分の目標</h3>
                  <i class="la la-ellipsis-v"></i>
                </div><!--sd-title end-->
                
                @foreach($user_targets as $user_target)
                  <div class="suggestions-list">
                    <div class="suggestion-usd">
                      <div class="sgt-text">
                        <h4>{{$user_target->target}}</h4>
                        <span>{{$user_target->goal}}までに達成</span>
                        <span>カテゴリ名</span>
                      </div>
                      <!-- <span>d/w/m</span> -->
                    </div>
                    <!-- <div class="view-more">
                      <p>カテゴリ名</p>
                      <a href="#" title="">View More</a>
                    </div> -->
                  </div><!--suggestions-list end-->
                @endforeach
              </div>  

              <div class="suggestions full-width">
                <div class="sd-title">
                  <h3>おすすめライバル</h3>
                  <i class="la la-ellipsis-v"></i>
                </div><!--sd-title end-->
                <div class="suggestions-list">
                  <div class="suggestion-usd">
                    <img src="images/amazon.png" height="35px" width="35px">
                    <div class="sgt-text">
                      <h4><a href="">ジェフ・ベゾス</a></h4>
                      <span>資産20兆円越え</span>
                    </div>
                    <span></span>
                  </div>
                  <div class="view-more">
                    <a href="#" title="">ライバル申請</a>
                  </div>
                </div><!--suggestions-list end-->

                <div class="suggestions-list">
                  <div class="suggestion-usd">
                    <img src="images/cmp-icon1.png" height="35px" width="35px">
                    <div class="sgt-text">
                      <h4><a href="">マック・ザッカーバーグ</a></h4>
                      <span>インスタ潰す</span>
                    </div>
                    <span></span>
                  </div>
                  <div class="view-more">
                    <a href="#" title="">ライバル申請</a>
                  </div>
                </div><!--suggestions-list end-->

              </div><!--suggestions end-->
                
            </div><!--main-left-sidebar end-->
          </div>
        @endguest

        <div class="col-lg-8 col-md-8 no-pd">
          @yield('right_side')
        </div><!-- col終わり -->

      </div>
    </div>
  </div>       
</div>        
</main>
@endsection