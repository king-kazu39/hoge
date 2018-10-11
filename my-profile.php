<?php 
  
  session_start();
  require_once('dbconnect/dbconnect.php');

  // if (!isset($_SESSION['naxstage']['id'])) {
  //  header('Location:sign-in.html');
  // }

  // $signin_user_id = $_SESSTION['nexstage'];
  $signin_user_id = 1;

  // サインインしているユーザー情報をDBから読み込む
  $sql = 'SELECT `t`.*, `u`.`id`, `u`. `name` 
      FROM `targets` AS `t` 
      LEFT JOIN `users` AS `u` 
      ON `t`.`user_id` = `u`. `id` 
      WHERE `t`.`user_id` = ? ';

  $data = [$signin_user_id];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  // $user = $stmt->fetch(PDO::FETCH_ASSOC);


  // $users_name = ['users']['name'];
  // $targets = ['targets']['target'];


  // targets 入れる配列
  $targets = array();

  // レコードは無くなるまで取得処理
  while (true) {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    // もし取得するものがなくなったら処理を抜ける
    if ($record == false) {
      break;
    }

    // レコードがあれば追加
    $targets = $record;
  }

 ?>