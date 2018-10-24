<?php 

require_once("dbconnect/dbconnect.php");

echo json_encode("test");


    $target_id = $_POST['target_id'];
    $user_id = $_POST['user_id'];


    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';


    // INSERT文を用意する
    $sql = "INSERT INTO `likes` (`user_id`, `target_id`) VALUES (?, ?);";

    $data = [$user_id, $target_id];
    $stmt = $dbh->prepare($sql);
    $res = $stmt->execute($data);

     echo json_encode($res);












 ?>