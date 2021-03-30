<?php
if(
    !isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["area"]) || $_POST["area"]=="" ||
    !isset($_POST["area2"]) || $_POST["area2"]=="" ||
    !isset($_POST["category"]) || $_POST["category"]=="" ||
    !isset($_POST["adress"]) || $_POST["adress"]=="" ||
    !isset($_POST["comment"]) || $_POST["comment"]==""
){
    exit('ParamError');
}

$name = $_POST["name"];
$area = $_POST["area"];
$area2 = $_POST["area2"];
$category = $_POST["category"];
$adress = $_POST["adress"];
$comment = $_POST["comment"];

// データベースに接続する
try {
$pdo=new PDO('mysql:dbname=lamiapatria;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
}


// データ登録SQL
$sql = "INSERT INTO italian_restaurant(number, name, area, area2, category, adress, comment)VALUES(NULL, :a1, :a2, :a3, :a4, :a5, :a6)";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $area, PDO::PARAM_STR);
$stmt->bindValue(':a3', $area2, PDO::PARAM_STR);
$stmt->bindValue(':a4', $category, PDO::PARAM_STR);
$stmt->bindValue(':a5', $adress, PDO::PARAM_STR);
$stmt->bindValue(':a6', $comment, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if($status==false){

    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
}else{
    header("Location: index.html");
    exit;
}

?>