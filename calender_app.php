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

	// $record['goal']から値を取り出す
	$time_value = $record['goal'];
	// 取り出した値を日付型に変換	
	$timestamp_time = strtotime('+12 hour' , strtotime($time_value));
	// +12時間する
	$time_time = date('Y-m-d H:i:s',$timestamp_time);
	// target['end']に入れる
	$target['end'] = $time_time;


	// $target['color'] = $record['category'];
	// // $record['color']から値を取り出す
	// if($catego = '健康'){$catego = 'purple';}
	// elseif($catego = 'お金'){$catego = 'blue';}
	// elseif($catego = '仕事'){$catego ='skyblue';}
	// elseif($catego = '家族'){$catego ='green';}
	// elseif($catego = '教育'){$catego = 'yellow';}
	// elseif($catego = '精神'){$catego ='orange';}
	// else($catego = '楽しみ'){$catego ='red';}
	// // 条件分岐で色をつける
	// $target['color'] = $catego; 
	// // $target['color']に入れる

// 助けてくださいーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー


	$targets[] = $target;
}

// 結果を返す
// JavaScriptで使えるようにjsonエンコードして返す
echo json_encode($targets);