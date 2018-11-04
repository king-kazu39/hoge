<?php
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $dsn = 'mysql:dbname=nexstage_test;host=localhost';
    //$dsn = 'mysql:dbname=' . substr($url['path'], 1) . ';host=' . $url['host'];

    $user ='root';
    //$user =$url['user'];
    //$password = $url['pass'];
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
   
    // SQL文にエラーがあった場合、画面にエラーを出力する設定
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


    // 文字コードの指定
    $dbh->query('SET NAMES utf8');
    
?>