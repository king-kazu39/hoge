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

    

















 ?>