<?php
    session_start();
    require("dbconnect/dbconnect.php");

    $user_id = $_SESSION["id"];
    $comment = $_POST["write_comment"];
    $target_id = $_POST["target_id"];

    $sql = "INSERT INTO `comments`(`comment`, `user_id`, `target_id`, `created`) VALUES (?,?,?,now());";
    $data = [$comment, $user_id, $target_id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    header("Location: timeline.php");
    exit();