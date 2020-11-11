<?php
require_once('../admin_menu.php');
require_once('../config.php');


/*  戻ってもバッファに残るようにする  */

header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
/***************************************/

header("Content-type: text/html; charset=utf-8");

if(empty($_POST)) {
    header("Location: pdo_search_form.html");
    exit();
}else{
    //名前入力判定
    if (!isset($_POST['yourname'])  || $_POST['yourname'] === "" ){
        $errors['name'] = "名前が入力されていません。";
    }
}


    try{
        $dbh = new PDO(DSN, DB_USER, DB_PASS);
        //日本語が含まれているなら名前検索
        if(preg_match( "/[ぁ-ん]+|[ァ-ヴー]+|[一-龠]/u", $_POST['yourname'])){
            $statement = $dbh->prepare("SELECT * FROM USER WHERE  NAME LIKE (:name) ");
        }else{//含まれていないならID 検索
            $statement = $dbh->prepare("SELECT * FROM USER WHERE  ID LIKE (:name) ");
        }

        if($statement){
            //ポストされた値をLIKEで使えるように変換をしている
            $yourname = $_POST['yourname'];
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
<title>検索結果</title>
<meta charset="utf-8">
</head>
<body>

<a href='../user_list/List_meny.php'>戻る</a>
<p><?=htmlspecialchars($yourname, ENT_QUOTES, 'UTF-8')."での検索結果"?><?=$row_count?>件です。</p>


<table border=1 style=border-collapse:collapse>
<tr><td>ID</td><td>NAME</td><td>MAIL</td><td>CREATED</td></tr>

<?php

if($row_count != 0){
    foreach($rows as $row){
?>

	<td><?= $id = $row['ID']?></td>
	<td><?=htmlspecialchars($row['NAME'],ENT_QUOTES,'UTF-8')?></td>
	<td><?=htmlspecialchars($row['MAIL'],ENT_QUOTES,'UTF-8')?></td>
	<td><?=htmlspecialchars($row['CREATED'],ENT_QUOTES,'UTF-8')?></td>
 <?php




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
    echo "</td>";

    echo "</tr>";
    ?>
<?php
    }


}
?>
