<?php

// データベースに接続する
try {
    $pdo=new PDO('mysql:dbname=lamiapatria;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DbConnectError:'.$e->getMessage());
    }

// データ登録SQL作成
    $stmt = $pdo->prepare("SELECT * FROM italian_restaurant");
    $status = $stmt->execute();

// データ登録処理後
    $view="";
    
    if($status==false){
        // SQL実行時にエラーがある場合
        $error = $stmt->errorInfo();
        exit("QueryError:".$error[2]);
    }else{
        // Selectデータの数だけ自動でループしてくれる
        while( $result = $stmt-> fetch(PDO::FETCH_ASSOC )){
            // $view .= "<p>";
            // $view .= $result["number"]." : ".$result["name"]."<br>"."Area"." : ".$result["area"]." - ".$result["area2"]."<br>"."Categoria"." : ".$result["category"]."<br>"."Indirizzo"." : ".$result["adress"]."<br>"."Commenti"." : ".$result["comment"];
            // $view .= "</p>";
            $view .="<p>";
            $view .='<a href="u_view.php?number='.$result["number"].'">';
            $view .= $result["number"]. " : " .$result["name"];
            $view .="</a>";

            $view .=' ';
            $view .='<a href="delete.php?number='.$result["number"].'">';
            $view .=' [削除] ';
            $view .="</a>";
            $view .="</p>";
        }

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
<h1>Ristranti Consigliati</h1>
  
      <div>
      <a href="index.html">Regista dei ristranti</a>
      </div>
    
</header>
<div>
    <div><?=$view?></div>
</div>
    
</body>
</html>

          