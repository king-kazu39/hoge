<?php
session_start();
require_once('dbconnect/dbconnect.php');

$signin_user_id = $_SESSION['nexstage_test']['id'];

// サインインしているユーザー情報をDBから読み込む
// usersとtargets２つのテーブルを結合
// TODO:サインアップ→サインインした時の表示を直す
$sql = 'SELECT `t`.*, `u`.`id`, `u`. `name`, `u`.`img_name` 
        FROM `targets` AS `t` 
        LEFT JOIN `users` AS `u` 
        ON `t`.`user_id` = `u`. `id` 
        WHERE `t`.`user_id` = ? ';

$data = [$signin_user_id];
$stmt = $dbh->prepare($sql);
$res =$stmt->execute($data);

$targets = [];
while(true) {
	$record = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($record == false) {
		break;
	}
	$target = [];
	$target['title'] = $record['target'];
	$target['start'] = $record['created'];
	$target['end'] = $record['goal'];

// 助けてくださいーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

	// // $record['goal']から値を取り出す
	// $time_value = $record['goal'];
	// // 取り出した値を日付型に変換	
	// $timestamp_time = strtotime($time_value);
	// // +12時間する
	// $timestamp_time = $timestamp_time + 120000;
	// // target['end']に入れる
	// $target['end'] = $timestamp_time;


	// $target['color'] = $record['category'];
	// // $record['color']から値を取り出す
	// if($catego = '健康'){color:purple;}
	// if($catego = 'お金'){color:blue;}
	// if($catego = '仕事'){color:skyblue;}
	// if($catego = '家族'){color:green;}
	// if($catego = '教育'){color:yellow;}
	// if($catego = '精神'){color:orange;}
	// if($catego = '楽しみ'){color:red;}
	// // 条件分岐で色をつける
	// $target['color'] = $catego; 
	// // $target['color']に入れる

// 助けてくださいーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー


	$targets[] = $target;
}

// 結果を返す
// JavaScriptで使えるようにjsonエンコードして返す
echo json_encode($targets);