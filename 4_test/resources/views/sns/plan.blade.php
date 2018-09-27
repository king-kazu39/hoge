@extends('layouts.side_home')

@section('right_side')

<div class="main-ws-sec">
  <div class="posts-section">
    <div class="tab-feed st2">
      <ul>
        <li data-tab="feed-dd" class="active">
          <a href="#" title="">
            <img src="images/ic1.png" alt="">
            <span>Plan</span>
          </a>
        </li>
        <li data-tab="info-dd">
          <a href="#" title="">
            <img src="images/ic2.png" alt="">
            <span>Do</span>
          </a>
        </li>
        <li data-tab="saved-jobs">
          <a href="#" title="">
            <img src="images/ic4.png" alt="">
            <span>Check</span>
          </a>
        </li>
        <li data-tab="my-bids">
          <a href="#" title="">
            <img src="images/ic5.png" alt="">
            <span>Ajust</span>
          </a>
        </li>
      </ul>
    </div><!-- tab-feed end-->  
  </div><!--posts-section end-->

  <div class="product-feed-tab current" id="feed-dd">
    <div class="posts-section">
      <div class="post-bar">
        <div class="post_topbar">
          <div class="usy-dt">
            <div class="usy-name">
              <h3>達成目標</h3>
            </div>
          </div>
        </div>
                  
        <div class="post-project-fields">
          <form action="{{ route('store') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="row">
              <div class="col-lg-12">
                <input type="text" name="target" placeholder="目標の入力">
              </div>
              <div class="col-lg-12">
                <div class="inp-field">
                  <p>カテゴリ</p>
                  <select name="category_id">
                    <option value="1">健康</option>
                    <option value="2">お金</option>
                    <option value="3">仕事</option>
                    <option value="4">家族</option>
                    <option value="5">教育</option>
                    <option value="6">精神</option>
                    <option value="7">楽しみ</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12">
                <p>目標達成日</p>
                <input type="date" name="goal">
              </div>  
              <div class="col-lg-12">
                <ul>
                  <li><button class="active" type="submit" value="post">宣言する！</button></li>
                  <li><a href="#" title="">考え直す</a></li>
                </ul>
              </div>
            </div>
          </form>
        </div><!--post-project-fields end-->

      </div><!--post-bar end-->
    </div><!--posts-section end-->
  </div><!--product-feed-tab end-->

  <div class="product-feed-tab" id="info-dd">
    <div class="posts-section">
      <div class="post-bar">
      <div class="post_topbar">
        <div class="usy-dt">
          <img src="http://via.placeholder.com/50x50" alt="">
          <div class="usy-name">
            <h3>ようま</h3>
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
        <h3>沖縄制覇</h3>
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
    </div><!--posts-section end-->
  </div><!--product-feed-tab end-->

  <div class="product-feed-tab" id="saved-jobs">
    <div class="posts-section">
      <div class="post-bar">
      <div class="post_topbar">
        <div class="usy-dt">
          <img src="http://via.placeholder.com/50x50" alt="">
          <div class="usy-name">
            <h3>かずやさん</h3>
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
        <h3>沖縄制覇</h3>
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
    </div><!--posts-section end-->
  </div><!--product-feed-tab end-->

              
  <div class="product-feed-tab" id="my-bids">
    <div class="posts-section">
      <div class="post-bar">
      <div class="post_topbar">
        <div class="usy-dt">
          <img src="http://via.placeholder.com/50x50" alt="">
          <div class="usy-name">
            <h3>かずやさん</h3>
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
        <h3>沖縄制覇</h3>
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
    </div><!--posts-section end-->
  </div><!--product-feed-tab end-->

  <div class="product-feed-tab" id="portfolio-dd">
    <div class="portfolio-gallery-sec">
      <h3>Portfolio</h3>
      <div class="gallery_pf">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="gallery_pt">
              <img src="http://via.placeholder.com/271x174" alt="">
              <a href="#" title=""><img src="images/all-out.png" alt=""></a>
            </div><!--gallery_pt end-->
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="gallery_pt">
              <img src="http://via.placeholder.com/170x170" alt="">
              <a href="#" title=""><img src="images/all-out.png" alt=""></a>
            </div><!--gallery_pt end-->
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="gallery_pt">
              <img src="http://via.placeholder.com/170x170" alt="">
              <a href="#" title=""><img src="images/all-out.png" alt=""></a>
            </div><!--gallery_pt end-->
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="gallery_pt">
              <img src="http://via.placeholder.com/170x170" alt="">
              <a href="#" title=""><img src="images/all-out.png" alt=""></a>
            </div><!--gallery_pt end-->
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="gallery_pt">
              <img src="http://via.placeholder.com/170x170" alt="">
              <a href="#" title=""><img src="images/all-out.png" alt=""></a>
            </div><!--gallery_pt end-->
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="gallery_pt">
              <img src="http://via.placeholder.com/170x170" alt="">
              <a href="#" title=""><img src="images/all-out.png" alt=""></a>
            </div><!--gallery_pt end-->
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="gallery_pt">
              <img src="http://via.placeholder.com/170x170" alt="">
              <a href="#" title=""><img src="images/all-out.png" alt=""></a>
            </div><!--gallery_pt end-->
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="gallery_pt">
              <img src="http://via.placeholder.com/170x170" alt="">
              <a href="#" title=""><img src="images/all-out.png" alt=""></a>
            </div><!--gallery_pt end-->
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="gallery_pt">
              <img src="http://via.placeholder.com/170x170" alt="">
              <a href="#" title=""><img src="images/all-out.png" alt=""></a>
            </div><!--gallery_pt end-->
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="gallery_pt">
              <img src="http://via.placeholder.com/170x170" alt="">
              <a href="#" title=""><img src="images/all-out.png" alt=""></a>
            </div><!--gallery_pt end-->
          </div>
        </div>
      </div><!--gallery_pf end-->
    </div><!--portfolio-gallery-sec end-->
  </div><!--product-feed-tab end-->


  <div class="product-feed-tab" id="payment-dd">
    <div class="billing-method">
      <ul>
        <li>
          <h3>Add Billing Method</h3>
          <a href="#" title=""><i class="fa fa-plus-circle"></i></a>
        </li>
        <li>
          <h3>See Activity</h3>
          <a href="#" title="">View All</a>
        </li>
        <li>
          <h3>Total Money</h3>
          <span>$0.00</span>
        </li>
      </ul>
      <div class="lt-sec">
        <img src="images/lt-icon.png" alt="">
        <h4>All your transactions are saved here</h4>
        <a href="#" title="">Click Here</a>
      </div>
    </div><!--billing-method end-->
    <div class="add-billing-method">
      <h3>Add Billing Method</h3>
      <h4><img src="images/dlr-icon.png" alt=""><span>With workwise payment protection , only pay for work delivered.</span></h4>
      <div class="payment_methods">
        <h4>Credit or Debit Cards</h4>
        <form>
          <div class="row">
            <div class="col-lg-12">
              <div class="cc-head">
                <h5>Card Number</h5>
                <ul>
                  <li><img src="images/cc-icon1.png" alt=""></li>
                  <li><img src="images/cc-icon2.png" alt=""></li>
                  <li><img src="images/cc-icon3.png" alt=""></li>
                  <li><img src="images/cc-icon4.png" alt=""></li>
                </ul>
              </div>
              <div class="inpt-field pd-moree">
                <input type="text" name="cc-number" placeholder="">
                <i class="fa fa-credit-card"></i>
              </div><!--inpt-field end-->
            </div>
            <div class="col-lg-6">
              <div class="cc-head">
                <h5>First Name</h5>
              </div>
              <div class="inpt-field">
                <input type="text" name="f-name" placeholder="">
              </div><!--inpt-field end-->
            </div>
            <div class="col-lg-6">
              <div class="cc-head">
                <h5>Last Name</h5>
              </div>
              <div class="inpt-field">
                <input type="text" name="l-name" placeholder="">
              </div><!--inpt-field end-->
            </div>
            <div class="col-lg-6">
              <div class="cc-head">
                <h5>Expiresons</h5>
              </div>
              <div class="rowwy">
                <div class="row">
                  <div class="col-lg-6 pd-left-none no-pd">
                    <div class="inpt-field">
                      <input type="text" name="f-name" placeholder="">
                    </div><!--inpt-field end-->
                  </div>
                  <div class="col-lg-6 pd-right-none no-pd">
                    <div class="inpt-field">
                      <input type="text" name="f-name" placeholder="">
                    </div><!--inpt-field end-->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="cc-head">
                <h5>Cvv (Security Code) <i class="fa fa-question-circle"></i></h5>
              </div>
              <div class="inpt-field">
                <input type="text" name="l-name" placeholder="">
              </div><!--inpt-field end-->
            </div>
            <div class="col-lg-12">
              <button type="submit">Continue</button>
            </div>
          </div>
        </form>
        <h4>Add Paypal Account</h4>
      </div>
    </div><!--add-billing-method end-->
  </div><!--product-feed-tab end-->
</divs>


@endsection