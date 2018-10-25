<?php 
    session_start();
    // セッションの情報を破棄する
    // $_SESSIOM変数の破棄
    $_SESSION = [];
    // サーバー内の$_SESSIONをクリア
    session_destroy();
    // サインアウト後の遷移
    header("Location: signup_and_in.php");
    exit();
 ?>