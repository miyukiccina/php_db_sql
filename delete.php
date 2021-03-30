<?php

// GETでIDを取得
$number = $_GET["number"];

// DB接続
try {
    $pdo=new PDO('mysql:dbname=lamiapatria;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DbConnectError:'.$e->getMessage());
    }

// Update文を作る
$sql = 'DELETE FROM italian_restaurant WHERE number=:number';
$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':number', $number, PDO::PARAM_INT);
$stmt->bindValue(':number', $number, PDO::PARAM_INT);
// ↑変更したいIDを渡す　

$status = $stmt->execute();


// データ登録処理後

if($status==false){
    // SQL実行時にエラーがある場合
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
}else{
    // SELECT.PHPにジャンプ
    header("Location: select.php");
    exit;
    }



?>