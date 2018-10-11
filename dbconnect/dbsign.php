<?php
// -------------------------------------------------
// --------sign_check.phpの開始----------------------
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
    $user_name = '';
    // $user_id = '';
    $signup_email = '';
    $signin_email = '';
    $signin_password = '';
    $signup_password = '';
    $repeat_password = '';

// --------signin_checkの開始----------------------

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

// --------dbusercheck.phpの開始----------------------

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

// --------dbusercheck.phpの終了----------------------

            // 登録されたuser_idかチェックする
            if ($record == false) {
                $errors['signin'] = 'failed';
                echo 'DBに記録がありません'. '<br>';
            }

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

            // データが1件読み込めれば存在するユーザーということでOK
            // データが0件なら、メールアドレスとパスワードの組み合わせが間違っているということでNG

        } else {
            // エラーを出す
            $errors['signin'] = 'blank';
            echo 'DBに記録がありません' . '<br>';
        }
    }

// --------signin_checkの終了----------------------

// --------signup_checkの開始----------------------

    // 確認ボタンを押すと実行される処理
    // 未入力で確認ボタンを押した時も実行されるので注意
    if (!empty($_POST) && $_POST['from'] == 'signup') {
        // POST送信されてきた値を全て用意した変数に代入する
        $user_name = $_POST['user_name'];
        // $user_id = $_POST['user_id'];
        $signup_email = $_POST['signup_email'];
        $signup_password = $_POST['signup_password'];
        $repeat_password = $_POST['repeat_password'];
        // $Kiyaku = $_POST['Kiyaku'];
        $from = $_POST['from'];

        if ($user_name == '') {
            $errors['user_name'] = '空';
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

        if (empty($errors)) {
            $_SESSION['nexstage_test'] = $_POST;
            header('Location: check.php');
            exit();
        }

    }

// --------signup_checkの終了----------------------

    echo "errorsの中身";
    echo '<pre>';
    var_dump($errors);
    echo '</pre>';

    echo "SESSIONの中身";
    echo '<pre>';
    var_dump($_SESSION['nexstage_test']);
    echo '</pre>';

// -------------------------------------------------
// --------sign_check.phpの終了----------------------
// -------------------------------------------------

?>
