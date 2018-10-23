

$(function() {

    $('.js-like').on('click', function() {


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
            // 成功時の処理
            console.log(data);
        })
        .fail(function(err) {
            // 失敗時の処理
            console.log('error');
        })

    });

});
