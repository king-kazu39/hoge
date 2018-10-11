<?php
// -------------------------------------------------
// --------dbsign.phpの開始----------------------
// -------------------------------------------------

    echo "POSTの中身";
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    require_once(dirname(__FILE__) . "/dbconnect.php"); //$dbhが使えるようにした

    // バリデーションを出すために$errorsという配列を用意した
    $errors = array();

    // ラジオボタンチェックの有無とサインイン＆サインアップページのバリデーションで戻ってきた時の値チェックで使用する
    $from = '';

    // フォームの値保持でechoの内容を出力させないために空文字を入れ初期化した
    $name = '';
    // $user_id = '';
    $signup_email = '';
    $signin_email = '';
    $signin_password = '';
    $signup_password = '';
    $repeat_password = '';

// --------signinチェックの開始----------------------

    if (!empty($_POST) && $_POST['from'] == 'signin') {
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
        // $user_id = $_POST['user_id'];
        $signin_email = $_POST['signin_email'];
        $signin_password = $_POST['signin_password'];

        // バリデーション（emailとpasswordの空チェック）
        // if ($user_id != '' && $signin_password != '') {
        if ($signin_email != '' && $signin_password != '') {

// --------nexstageのusersテーブルからメルアドと一致するユーザー検索の開始----------------------

            $sql = 'SELECT * FROM `users` WHERE `email` = ?';
            $data = [$signin_email];
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);

            echo '<pre>';
            var_dump($stmt);
            echo '</pre>';

            $record = $stmt->fetch(PDO::FETCH_ASSOC);

            echo '<pre>';
            var_dump($record);
            echo '</pre>';
            // die();

// --------nexstageのusersテーブルからメルアドと一致するユーザー検索の終了----------------------

            // 登録されたuser_idかチェックする
            if ($record == false) {
                $errors['signin'] = 'failed';
                echo 'DBに記録がありません'. '<br>';
            }

// ======================パスワードチェック〜ここから〜======================

            // $passwordは、ユーザーが入力したパスワード
            // $record['password']は、データベースから取ってきたパスワード
            // passwordが一致するかチェック
            if (password_verify($signin_password, $record['password'])) {
                // 認証成功
                // サインインするユーザーのidをセッションに保存
                $_SESSION['nexstage_test']['id'] = $record['id'];
                header('Location: timeline.php');
                exit();
            } else {
                // 認証失敗
                $errors['signin'] = 'failed';
                echo 'パスワードが一致しませんでした' . '<br>';
            }

// ======================パスワードチェック〜ここまで〜======================


            // データが1件読み込めれば存在するユーザーということでOK
            // データが0件なら、メールアドレスとパスワードの組み合わせが間違っているということでNG

        } else {
            // エラーを出す
            $errors['signin'] = 'blank';
            echo 'DBに記録がありません' . '<br>';
        }
    }

// --------signinチェックの終了----------------------

// --------signupチェックの開始----------------------

    // 確認ボタンを押すと実行される処理
    // 未入力で確認ボタンを押した時も実行されるので注意
    if (!empty($_POST) && $_POST['from'] == 'signup') {
        // POST送信されてきた値を全て用意した変数に代入する
        $name = $_POST['name']; //ユーザーネーム
        // $user_id = $_POST['user_id'];
        $signup_email = $_POST['signup_email'];
        $signup_password = $_POST['signup_password'];
        $repeat_password = $_POST['repeat_password'];
        // $Kiyaku = $_POST['Kiyaku'];
        $from = $_POST['from'];

        if ($name == '') {
            $errors['name'] = '空';
        }

        // if ($user_id == '') {
        //     $errors['user_id'] = '空';
        // }

        if ($signup_email == '') {
            $errors['signup_email'] = '空';
        }


        $count = strlen($signup_password);
        if ($signup_password == '') {
            // パスワードの未入力チェック
            $errors['signup_password'] = '空';
        } elseif ($count < 4 || 16 < $count) {
            // パスワードの文字数チェック
            $errors['signup_password'] = '文字数';
        }


        // $_FILES['name属性の値']['name']で画像名取得
        echo $_FILES['img_name']['name']; //取得できているか確認
        $filename = $_FILES['img_name']['name'];

        if (empty($filename)) {
        // ファイルの選択チェック
        $errors['img_name'] = '未選択';
        } else { // ifの条件に一致しなかったらelseを処理
           //ファイルの拡張子チェック
           // jpg || png || gifであれば送信
        $ext = substr($filename, -3);
        echo '<br>';
        echo $ext;

            // 指定の拡張子か判定する
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'gif') {
                $errors['img_name'] = '拡張子';
            }
        }

        //もしバリデーションをすべて通過すれば、check.phpへ遷移する
        if (empty($errors)) {

             // プロフィール画像のアップロード
            $date_str = date('YmdHis'); //yyyymmddhhiiss←左記のフォーマットで出力される
            $submit_filename = $date_str . $filename;
            move_uploaded_file($_FILES['img_name']['tmp_name'], './user_profile_img/' . $submit_filename);

            // 送信データをセッションに保存
            $_SESSION['nexstage_test'] = $_POST;
            $_SESSION['nexstage_test']['img_name'] = $submit_filename;
            header('Location: check.php'); //ヘッダー関数でデータを送る
            exit();
        }

    }

// --------signupチェックの終了----------------------

    echo "errorsの中身";
    echo '<pre>';
    var_dump($errors);
    echo '</pre>';

    echo "SESSIONの中身";
    echo '<pre>';
    var_dump($_SESSION['nexstage_test']);
    echo '</pre>';

// -------------------------------------------------
// --------dbsign.php.phpの終了----------------------
// -------------------------------------------------

?>
