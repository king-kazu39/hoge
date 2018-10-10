<?php

    require_once(dirname(__FILE__) . "/dbconnect.php");

    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    echo '<pre>';
    var_dump($_SESSION['nexstage_test']);
    echo '</pre>';

    $check = '';

    // echo $_SESSION['nexstage_test']['user_name'];

    if (!isset($_SESSION['nexstage_test'])) {
        // sign_inへ強制遷移させる
        header('Location: sign_in_logic.php');
    }

    $user_name = $_SESSION['nexstage_test']['user_name'];
    // $user_id = $_SESSION['nexstage_test']['user_id'];
    $signup_email = $_SESSION['nexstage_test']['signup_email'];
    $user_password = $_SESSION['nexstage_test']['signup_password'];

    if (!empty($_POST)) {
        echo "<br>" . "<br>";
        echo "通過";

        $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
        // $hash_password = $user_password;


// ----ここからdbinsert.phpファイルにする-------

        // img_nameありSQL文
        // $sql = 'INSERT INTO `users` SET `user_name` = ?, `user_id` = id, `email` = ?, `password` = ?, `img_name` = ?, `created` = NOW()';

        // $data = [$user_name, $user_id, $signup_email, $password, $img_name];

        // img_nameなしSQL文
        $sql = 'INSERT INTO `users` SET `user_name` = ?, `email` = ?, `password` = ?, `created` = NOW()';

        $data = [$user_name, $signup_email, $hash_password];

        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        // DB切断
        $dbh = null;

// ----ここからdbinsert.phpファイルにする-------

        // 登録完了ページへ遷移
        header('Location: thanks.php');

        if ($check == 'back') {
            header('Location: signup_and_in.php');
        }

    }


?>