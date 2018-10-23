<?php
require_once('dbconnect/dbconnect.php');
// サインインしているユーザー情報をDBから読み込む
// usersとtargets２つのテーブルを結合
// TODO:サインアップ→サインインした時の表示を直す
$sql = 'SELECT `t`.*, `u`.`id`, `u`. `name`, `u`.`img_name` 
        FROM `targets` AS `t` 
        LEFT JOIN `users` AS `u` 
        ON `t`.`user_id` = `u`. `id` 
        -- WHERE `t`.`user_id` = ? ';

$data = [];
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

	$targets[] = $target;
}

// 結果を返す
// JavaScriptで使えるようにjsonエンコードして返す
echo json_encode($targets);