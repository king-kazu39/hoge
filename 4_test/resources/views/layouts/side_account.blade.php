@extends('layouts.app')

@section('content')
<section class="cover-sec">
  <img src="http://via.placeholder.com/1600x400">
  <a href="#" title=""><i class="fa fa-camera"></i> Change Image</a>
</section>

<main>
  <div class="main-section">
    <div class="container">
      <div class="main-section-data">
        <div class="row">

          <div class="col-lg-4">
            <div class="main-left-sidebar">
              <div class="user_profile">
                <div class="user-pro-img">
                  <img src="{{ $user->img_name }}" height="170px" width="170px">
                  <a href="#" title=""><i class="fa fa-camera"></i></a>
                </div><!--user-pro-img end-->
                <div class="user_pro_status">
                  <p>{{ $user->name }}</p>
                  <ul class="flw-hr">
                    @if($user->id == Auth::user()->id)
                      <li><a href="{{ route('search') }}" title="" class="flww"><i class="la la-plus"></i>ライバル探す</a></li>
                    @else
                      <li><a href="" title="" class="flww"><i class="la la-plus"></i>ライバル申請</a></li>
                    @endif  
                  </ul>
                  <ul class="flw-status">
                    <li>
                      <span>Following</span>
                      <b>34</b>
                    </li>
                    <li>
                      <span>Followers</span>
                      <b>155</b>
                    </li>
                  </ul>
                </div><!--user_pro_status end-->
                <ul class="social_links">
                  <h5>SNSを連携する</h5>
                  <li><a href="#" title=""><i class="la la-globe"></i> www.example.com</a></li>
                  <li><a href="#" title=""><i class="fa fa-facebook-square"></i> Http://www.facebook.com/john...</a></li>
                  <li><a href="#" title=""><i class="fa fa-twitter"></i> Http://www.Twitter.com/john...</a>
                </ul>
              </div><!--user_profile end-->
            </div><!--main-left-sidebar end-->
          </div>

          <div class="col-lg-8">
            @yield('right_side')
          </div>
        </div>
      </div><!-- main-section-data end-->
    </div> 
  </div>
</main>  
@endsection