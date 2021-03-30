<?php
$number =$_POST["number"];
$name =$_POST["name"];
$area =$_POST["area"];
$area2 =$_POST["area2"];
$category =$_POST["category"];
$adress =$_POST["adress"];
$comment =$_POST["comment"];

// DB接続
try {
    $pdo=new PDO('mysql:dbname=lamiapatria;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DbConnectError:'.$e->getMessage());
    }

// Update文を作る
$sql = 'UPDATE italian_restaurant SET area=:area, area2=:area2, category=:category, adress=:adress, comment=:comment';
$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':number', $number, PDO::PARAM_INT);
$stmt->bindValue(':area', $area, PDO::PARAM_STR);
$stmt->bindValue(':area2', $area2, PDO::PARAM_STR);
$stmt->bindValue(':category', $category, PDO::PARAM_STR);
$stmt->bindValue(':adress', $adress, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$status = $stmt->execute();


// データ登録処理後

if($status==false){
    // SQL実行時にエラーがある場合
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
}else{
    header("Location: select.php");
    exit;
    }

?>