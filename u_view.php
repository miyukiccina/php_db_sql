<?php
// GETでIDを取得
$number = $_GET["number"];


// DB接続
try {
    $pdo=new PDO('mysql:dbname=lamiapatria;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DbConnectError:'.$e->getMessage());
    }
// SELECT文を作る
$sql = "SELECT * FROM italian_restaurant WHERE number=:number";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':number', $number, PDO::PARAM_INT);
// $stmt->bindValue(':a2', $area, PDO::PARAM_STR);
// $stmt->bindValue(':a3', $area2, PDO::PARAM_STR);
// $stmt->bindValue(':a4', $category, PDO::PARAM_STR);
// $stmt->bindValue(':a5', $adress, PDO::PARAM_STR);
// $stmt->bindValue(':a6', $comment, PDO::PARAM_STR);
$status = $stmt->execute();

// データ表示
if($status==false){
    // SQL実行時にエラーがある場合
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
}else{
    // データのみの抽出の場合はwhileループで取り出さない
    $row = $stmt->fetch();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Nostra Patria</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
    <h1 id="title">La Nostra Patria</h1>
    <div>-La cucina che ti mancava-</div>
    </header>
</body>
</html>


<form action="update.php" method="post">

  <p>Il nome del ristorante：<input type="text" name="name" value="<?=$row["name"]?>" size="20"></p>
  <p>Area：<input type="text" name="area" value="<?=$row["area"]?>" size="20"></p>
  <p>Area2：<input type="text" name="area2" value="<?=$row["area2"]?>" size="20"></p>
  <p>Categoria：<input type="text" name="category" value="<?=$row["category"]?>" size="20"></p>
  <p>Indrizzo：<input type="text" name="adress" value="<?=$row["adress"]?>" size="20"></p>
  <p>Commenti:<textArea name="comment" rows="4" cols="40"><?=$row["comment"]?></textArea></p>

  <p><input type="hidden" name = "number" value="<?=$row["number"]?>" ></p>
  <p><input type="submit" value="Register" ></p>

  
  <div>
      <a href="select.php">Vedi dei ristranti consigliati</a>
      </div>


</form>

