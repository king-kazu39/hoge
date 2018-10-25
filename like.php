<?php 

require_once("dbconnect/dbconnect.php");

echo json_encode("test");


    $target_id = $_POST['target-id'];
    $user_id = $_POST['user-id'];


    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    if (isset($_POST["is_unlike"])) {
         $sql ="DELETE FROM `likes` WHERE `user_id` = ?  and `target_id` = ?";
    } else {

    // INSERT文を用意する
    $sql = "INSERT INTO `likes` (`user_id`, `target_id`) VALUES (?, ?);";}

    $data = [$user_id, $target_id];
    $stmt = $dbh->prepare($sql);
    $res = $stmt->execute($data);

     echo json_encode($res);












 ?>