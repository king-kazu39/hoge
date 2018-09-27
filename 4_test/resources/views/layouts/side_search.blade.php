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

          <div class="col-lg-4 col-md-4 pd-left-none no-pd">
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
          </div><!-- col終わり -->

          <div class="col-lg-8">
            @yield('right_side')
          </div>  
        </div>
      </div><!-- main-section-data end-->
    </div>
  </div>
</main>  
@endsection