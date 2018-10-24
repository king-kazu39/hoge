<?php 
function get_comments($dbh, $target_id)
    {
        $sql = "SELECT `c`.*,`u`.`name`,`u`.`img_name` FROM `comments` AS `c` LEFT JOIN `users` AS `u` ON `c`.`user_id` = `u`.`id` WHERE `c`.`target_id`=?";

        $data = [$target_id];

        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        $comments = [];

        while (true) {
            $comment = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($comment == false) {
                break;
            }
            $comments[] = $comment;
        }

        return $comments;
}

        // コメント一件に対してコメント数を取得する
        function count_comments($dbh, $target_id)
    {
        $sql = "SELECT COUNT(*) AS `comment_cnt` FROM `comments` WHERE `target_id` = ?";

        $data = [$target_id];

        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result["comment_cnt"];
    }


    // 更新時間作成
//     function convert_to_fuzzy_time($dbh, $target_id){
//     $unix   = strtotime($dbh, $target_id);
//     $now    = time();
//     $diff_sec   = $now - $unix;

//     if($diff_sec < 60){
//         $time   = $diff_sec;
//         $unit   = "秒前";
//     }
//     elseif($diff_sec < 3600){
//         $time   = $diff_sec/60;
//         $unit   = "分前";
//     }
//     elseif($diff_sec < 86400){
//         $time   = $diff_sec/3600;
//         $unit   = "時間前";
//     }
//     elseif($diff_sec < 2764800){
//         $time   = $diff_sec/86400;
//         $unit   = "日前";
//     }
//     else{
//         if(date("Y") != date("Y", $unix)){
//             $time   = date("Y年n月j日", $unix);
//         }
//         else{
//             $time   = date("n月j日", $unix);
//         }

//         return $time;
//     }

//     return (int)$time . $unit;
// }

















 ?>