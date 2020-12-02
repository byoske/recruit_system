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

<?php
if(!empty($_GET['re'])){
    echo "aaaaaaa";
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>





<u>
<font color="#ff4500">
<h2>活動中</h2>
</font>
</u>


<table border='0'>
<?php

if($row_count != 0){
    foreach($rows as $row){
        if($row['CONTENTS'] == NULL){
?>

	<td><a href = "../recuruit/recuruit_report_edit.php?code=<?php echo $row['CODE'];?>">・<?=htmlspecialchars($row['COMPANY'],ENT_QUOTES,'UTF-8')?></a></td>

	<?php if($row['PURPOSE1']!=null){?>
	<td>［</td>
	<td><?=htmlspecialchars($row['PURPOSE1'],ENT_QUOTES,'UTF-8') ?></td> <?php }?>
	<?php if($row['PURPOSE3']!=null){?>
	<td><?=htmlspecialchars($row['PURPOSE2'],ENT_QUOTES,'UTF-8')?></td><?php }?>
	<?php if($row['PURPOSE3']!=null){?>
	<td><?=htmlspecialchars($row['PURPOSE3'],ENT_QUOTES,'UTF-8')?></td><?php } ?>
	<td>］</td>
	</tr>

<?php

        }
    }
}
?>
</table>


</body>
</html>