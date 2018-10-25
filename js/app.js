

$(function() {

    $(document).on('click', '.js-like',function() {

        var target_id = $(this).siblings('.target-id').text();
        var user_id = $(this).siblings('.user-id').text();
        var like_btn = $(this);
        var like_count = $(this).siblings('.like_count').text();

        console.log(target_id);   //target_idを取得できているか確認
        console.log(user_id);   //user_idを取得できているか確認            




        $.ajax({
            // 送信先、送信するデータなど
            url: 'like.php',
            type: 'POST',
            datatype: 'json',
            data: {
                'target-id': target_id,
                'user-id': user_id,
            }


        })
        .done(function(data) {
            if (data) {
                like_count++;
                like_btn.siblings('.like_count').text(like_count);
                like_btn.removeClass('js-like');
                like_btn.addClass('js-unlike');
                like_btn.children('span').text('いいねを取り消す');


            }

        })
        .fail(function(error) {
            // 失敗時の処理
            console.log('error');
        })

    });

});


// いいねを取り消す処理
 $(document).on('click', '.js-unlike', function() {
        var target_id = $(this).siblings('.target-id').text();
        var user_id = $(this).siblings('user-id').text();
        var like_btn = $(this);
        var like_count = $(this).siblings('.like_count').text();
        $.ajax({
            // 送信先、送信するデータなど
            url: 'like.php',
            type: 'POST',
            datatype: 'json',
            data: {
                'target-id': target_id,
                'user-id': user_id,
                'is_unlike': true,
            }
        })
        .done(function(data) {
            if (data) {
                like_count--;
                like_btn.siblings('.like_count').text(like_count);
                like_btn.removeClass('js-unlike');
                like_btn.addClass('js-like');
                like_btn.children('span').text('いいね!');

            }
        })
        .fail(function(err) {
            console.log('error');
        })
    });
