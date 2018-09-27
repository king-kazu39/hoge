@extends('layouts.app')

@section('content')
  <section class="profile-account-setting">
    <div class="container">
      <div class="account-tabs-setting">
        <div class="row">
          <div class="col-lg-3">
            <div class="acc-leftbar">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-acc-tab" data-toggle="tab" href="#nav-acc" role="tab" aria-controls="nav-acc" aria-selected="true"><i class="la la-cogs"></i>アカウント</a>
                  <a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false"><i class="fa fa-lock"></i>パスワードの変更</a>
                  <a class="nav-item nav-link" id="nav-notification-tab" data-toggle="tab" href="#nav-notification" role="tab" aria-controls="nav-notification" aria-selected="false"><i class="fa fa-flash"></i>通知</a>
                  <a class="nav-item nav-link" id="nav-requests-tab" data-toggle="tab" href="#nav-requests" role="tab" aria-controls="nav-requests" aria-selected="false"><i class="fa fa-group"></i>ライバル申請</a>
                  <a class="nav-item nav-link" id="nav-deactivate-tab" data-toggle="tab" href="#nav-deactivate" role="tab" aria-controls="nav-deactivate" aria-selected="false"><i class="fa fa-random"></i>アカウントの削除</a>
                </div>
            </div><!--acc-leftbar end-->
          </div>
          <div class="col-lg-9">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-acc" role="tabpanel" aria-labelledby="nav-acc-tab">
                <div class="acc-setting">
                  <h3>アカウント設定</h3>
                  <form>
                    <div class="notbar">
                      <h4>通知音</h4>
                      <p><br></p>
                      <div class="toggle-btn">
                        <a href="#" title=""><img src="images/up-btn.png" alt=""></a>
                      </div>
                    </div><!--notbar end-->
                    <div class="notbar">
                      <h4>メールの通知</h4>
                      <p><br></p>
                      <div class="toggle-btn">
                        <a href="#" title=""><img src="images/up-btn.png" alt=""></a>
                      </div>
                    </div><!--notbar end-->
                    <div class="notbar">
                      <h4>メッセージの通知</h4>
                      <p><br></p>
                      <div class="toggle-btn">
                        <a href="#" title=""><img src="images/up-btn.png" alt=""></a>
                      </div>
                    </div><!--notbar end-->
                    <div class="save-stngs">
                      <ul>
                        <li>
                          <a class="" href=""
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                変更を保存する
                          </a>
                          <!-- <button type="submit">変更を保存</button> -->
                        </li>
                        <li>
                          <a href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                        </li>
                        <!-- これないとなぜか動かない -->
                        <li class="nav-item dropdown">
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                          </div>
                        </li>
                      </ul>
                    </div><!--save-stngs end-->
                  </form>
                </div><!--acc-setting end-->
              </div>
                <div class="tab-pane fade" id="nav-status" role="tabpanel" aria-labelledby="nav-status-tab">
                </div>
                <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                  <div class="acc-setting">
                  <h3>パスワードの変更</h3>
                  <form>
                    <div class="cp-field">
                      <h5>現在のパスワード</h5>
                      <div class="cpp-fiel">
                        <input type="text" name="old-password" placeholder="現在のパスワード">
                        <i class="fa fa-lock"></i>
                      </div>
                    </div>
                    <div class="cp-field">
                      <h5>新しいパスワード</h5>
                      <div class="cpp-fiel">
                        <input type="text" name="new-password" placeholder="新しいパスワード">
                        <i class="fa fa-lock"></i>
                      </div>
                    </div>
                    <div class="cp-field">
                      <h5>再度、パスワードの入力</h5>
                      <div class="cpp-fiel">
                        <input type="text" name="repeat-password" placeholder="再度、パスワードの入力">
                        <i class="fa fa-lock"></i>
                      </div>
                    </div>
                    <div class="cp-field">
                      <h5><a href="#" title="">パスワードを忘れた場合</a></h5>
                    </div>
                    <div class="save-stngs pd2">
                      <ul>
                        <li><button type="submit">設定を保存</button></li>
                      </ul>
                    </div><!--save-stngs end-->
                  </form>
                </div><!--acc-setting end-->
                </div>
                <div class="tab-pane fade" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">
                  <div class="acc-setting">
                    <h3>通知</h3>
                    <div class="notifications-list">
                      <div class="notfication-details">
                        <div class="noty-user-img">
                          <img src="http://via.placeholder.com/35x35" alt="">
                        </div>
                        <div class="notification-info">
                          <h3><a href="#" title="">たくぞーさん　</a> たくぞーさんがあなたの目標にいいねをしました</h3>
                          <span>2分前</span>
                        </div><!--notification-info -->
                      </div><!--notfication-details end-->
                      <div class="notfication-details">
                        <div class="noty-user-img">
                          <img src="http://via.placeholder.com/35x35" alt="">
                        </div>
                        <div class="notification-info">
                          <h3><a href="#" title="">たくぞーさん　</a>たくぞーさんがあなたの目標にいいねをしました</h3>
                          <span>2分前</span>
                        </div><!--notification-info -->
                      </div><!--notfication-details end-->
                      <div class="notfication-details">
                        <div class="noty-user-img">
                          <img src="http://via.placeholder.com/35x35" alt="">
                        </div>
                        <div class="notification-info">
                          <h3><a href="#" title="">たくぞーさん　</a>たくぞーさんがあなたの目標にいいねをしました</h3>
                          <span>2分前</span>
                        </div><!--notification-info -->
                      </div><!--notfication-details end-->
                      <div class="notfication-details">
                        <div class="noty-user-img">
                          <img src="http://via.placeholder.com/35x35" alt="">
                        </div>
                        <div class="notification-info">
                          <h3><a href="#" title="">たくぞーさん　</a>たくぞーさんがあなたの目標にいいねをしました</h3>
                          <span>2分前</span>
                        </div><!--notification-info -->
                      </div><!--notfication-details end-->
                      <div class="notfication-details">
                        <div class="noty-user-img">
                          <img src="http://via.placeholder.com/35x35" alt="">
                        </div>
                        <div class="notification-info">
                          <h3><a href="#" title="">たくぞーさん　</a>たくぞーさんがあなたの目標にいいねをしました</h3>
                          <span>2分前</span>
                        </div><!--notification-info -->
                      </div><!--notfication-details end-->
                      <div class="notfication-details">
                        <div class="noty-user-img">
                          <img src="http://via.placeholder.com/35x35" alt="">
                        </div>
                        <div class="notification-info">
                          <h3><a href="#" title="">たくぞーさん　</a> たくぞーさんがあなたの目標にいいねをしました</h3>
                          <span>2分前</span>
                        </div><!--notification-info -->
                      </div><!--notfication-details end-->
                      <div class="notfication-details">
                        <div class="noty-user-img">
                          <img src="http://via.placeholder.com/35x35" alt="">
                        </div>
                        <div class="notification-info">
                          <h3><a href="#" title="">たくぞーさん　</a>たくぞーさんがあなたの目標にいいねをしました</h3>
                          <span>2分前</span>
                        </div><!--notification-info -->
                      </div><!--notfication-details end-->
                      <div class="notfication-details">
                        <div class="noty-user-img">
                          <img src="http://via.placeholder.com/35x35" alt="">
                        </div>
                        <div class="notification-info">
                          <h3><a href="#" title="">たくぞーさん　</a>たくぞーさんがあなたの目標にいいねをしました</h3>
                          <span>2分前</span>
                        </div><!--notification-info -->
                      </div><!--notfication-details end-->
                    </div><!--notifications-list end-->
                  </div><!--acc-setting end-->
                </div>
                <div class="tab-pane fade" id="nav-requests" role="tabpanel" aria-labelledby="nav-requests-tab">
                  <div class="acc-setting">
                    <h3>ライバル申請</h3>
                    <div class="requests-list">
                      <div class="request-details">
                        <div class="noty-user-img">
                          <img src="http://via.placeholder.com/35x35" alt="">
                        </div>
                        <div class="request-info">
                          <h3>ようま</h3>
                          <span>スケートボーダー</span>
                        </div>
                        <div class="accept-feat">
                          <ul>
                            <li><button type="submit" class="accept-req">承認</button></li>
                            <li><button type="submit" class="close-req"><i class="la la-close"></i></button></li>
                          </ul>
                        </div><!--accept-feat end-->
                      </div><!--request-detailse end-->
                      <div class="request-details">
                        <div class="noty-user-img">
                          <img src="http://via.placeholder.com/35x35" alt="">
                        </div>
                        <div class="request-info">
                          <h3>ようま</h3>
                          <span>スケートボーダー</span>
                        </div>
                        <div class="accept-feat">
                          <ul>
                            <li><button type="submit" class="accept-req">承認</button></li>
                            <li><button type="submit" class="close-req"><i class="la la-close"></i></button></li>
                          </ul>
                        </div><!--accept-feat end-->
                      </div><!--request-detailse end-->
                      <div class="request-details">
                        <div class="noty-user-img">
                          <img src="http://via.placeholder.com/35x35" alt="">
                        </div>
                        <div class="request-info">
                          <h3>ようま</h3>
                          <span>スケートボーダー</span>
                        </div>
                        <div class="accept-feat">
                          <ul>
                            <li><button type="submit" class="accept-req">承認</button></li>
                            <li><button type="submit" class="close-req"><i class="la la-close"></i></button></li>
                          </ul>
                        </div><!--accept-feat end-->
                      </div><!--request-detailse end-->
                      <div class="request-details">
                        <div class="noty-user-img">
                          <img src="http://via.placeholder.com/35x35" alt="">
                        </div>
                        <div class="request-info">
                          <h3>ようま</h3>
                          <span>スケートボーダー</span>
                        </div>
                        <div class="accept-feat">
                          <ul>
                            <li><button type="submit" class="accept-req">承認</button></li>
                            <li><button type="submit" class="close-req"><i class="la la-close"></i></button></li>
                          </ul>
                        </div><!--accept-feat end-->
                      </div><!--request-detailse end-->
                      <div class="request-details">
                        <div class="noty-user-img">
                          <img src="http://via.placeholder.com/35x35" alt="">
                        </div>
                        <div class="request-info">
                          <h3>ようま</h3>
                          <span>スケートボーダー</span>
                        </div>
                        <div class="accept-feat">
                          <ul>
                            <li><button type="submit" class="accept-req">承認</button></li>
                            <li><button type="submit" class="close-req"><i class="la la-close"></i></button></li>
                          </ul>
                        </div><!--accept-feat end-->
                      </div><!--request-detailse end-->
                      <div class="request-details">
                        <div class="noty-user-img">
                          <img src="http://via.placeholder.com/35x35" alt="">
                        </div>
                        <div class="request-info">
                          <h3>ようま</h3>
                          <span>スケートボーダー</span>
                        </div>
                        <div class="accept-feat">
                          <ul>
                            <li><button type="submit" class="accept-req">承認</button></li>
                            <li><button type="submit" class="close-req"><i class="la la-close"></i></button></li>
                          </ul>
                        </div><!--accept-feat end-->
                      </div><!--request-detailse end-->
                    </div><!--requests-list end-->
                  </div><!--acc-setting end-->
                </div>
                <div class="tab-pane fade" id="nav-deactivate" role="tabpanel" aria-labelledby="nav-deactivate-tab">
                  <div class="acc-setting">
                  <h3>アカウントの削除</h3>
                  <form>
                    <div class="cp-field">
                      <h5>メールアドレス</h5>
                      <div class="cpp-fiel">
                        <input type="text" name="email" placeholder="メールアドレス">
                        <i class="fa fa-envelope"></i>
                      </div>
                    </div>
                    <div class="cp-field">
                      <h5>パスワード</h5>
                      <div class="cpp-fiel">
                        <input type="password" name="password" placeholder="パスワード">
                        <i class="fa fa-lock"></i>
                      </div>
                    </div>
                    <div class="cp-field">
                      <h5>削除理由</h5>
                      <textarea></textarea>
                    </div>
                    <div class="cp-field">
                      <div class="fgt-sec">
                        <input type="checkbox" name="cc" id="c4">
                        <label for="c4">
                          <span></span>
                        </label>
                        <small>広告を受け取らない</small>
                      </div>
                    </div>
                    <div class="save-stngs pd3">
                      <ul>
                        <li><button type="submit">設定を保存</button></li>
                      </ul>
                    </div><!--save-stngs end-->
                  </form>
                </div><!--acc-setting end-->
                </div>
            </div>
          </div>
        </div>
      </div><!--account-tabs-setting end-->
    </div>
  </section>

@endsection