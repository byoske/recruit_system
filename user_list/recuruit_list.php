<?php
require_once('../config.php');


/*  戻ってもバッファに残るようにする  */

header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
/***************************************/

header("Content-type: text/html; charset=utf-8");

session_start();
require_once('../user_menu.php');
$id = $_SESSION['id'];



try{
    $dbh = new PDO(DSN, DB_USER, DB_PASS);

        $statement = $dbh->prepare("SELECT * FROM REPORT WHERE  ID LIKE (:name) ");

    if($statement){
        //ポストされた値をLIKEで使えるように変換をしている
        $yourname = $id;
        $like_yourname = "%".$yourname."%";
        //プレースホルダへ実際の値を設定する
        $statement->bindValue(':name', $like_yourname, PDO::PARAM_STR);

        if($statement->execute()){
            //レコード件数取得
            $row_count = $statement->rowCount();

            while($row = $statement->fetch()){
                $rows[] = $row;
            }

        }else{
            $errors['error'] = "検索失敗しました。";
        }

        //データベース接続切断
        $dbh = null;
    }

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    $errors['error'] = "データベース接続失敗しました。";
}


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<p><?=$row_count?>件です。</p>



<table border='0'>
<?php

if($row_count != 0){
    foreach($rows as $row){
?>

	<td><?=htmlspecialchars($row['COMPANY'],ENT_QUOTES,'UTF-8')?></td>
	<?php if($row['PURPOSE1']!=null){?>
	<td><?=htmlspecialchars($row['PURPOSE1'],ENT_QUOTES,'UTF-8') ?></td> <?php }?>
	<?php if($row['PURPOSE3']!=null){?>
	<td><?=htmlspecialchars($row['PURPOSE2'],ENT_QUOTES,'UTF-8')?></td><?php }?>
	<?php if($row['PURPOSE3']!=null){?>
	<td><?=htmlspecialchars($row['PURPOSE3'],ENT_QUOTES,'UTF-8')?></td><?php }?>


 <?php


/*
    $flag = 0;
    echo "<td>";
    echo "<form action=../user_initialize/user_control.php method=post>";
    echo "<input type=submit value=変更>";
    echo "<input type=hidden name=id value='".$id."'>";
    echo "<input type=hidden name=flag value='".$flag."'>";
    echo "</form>";
    echo "</td>";


    echo "<td>";
    echo "<form action=../user_delete/user_delete.php method=post>";
    echo "<input type=submit value=削除>";
    echo "<input type=hidden name=id value='".$id."'>";
    echo "<input type=hidden name=flag value='".$flag."'>";
    echo "<input type=hidden name=yourname value='".$_POST['yourname']."'>";
    echo "</td>";
    echo "</form>";
    echo "</td>";*/

    echo "</tr>";
    ?>
<?php
    }

}
?>
