

<?php
require_once('../config.php');


/*  戻ってもバッファに残るようにする  */

header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
/***************************************/

header("Content-type: text/html; charset=utf-8");


require_once('../user_menu.php');


if (isset($_SESSION['id']) && $_SESSION['id'] == 'admin') {
    $id = $_GET['id'];
}
else{
    $id = $_SESSION['id'];
}


try{
    $dbh = new PDO(DSN, DB_USER, DB_PASS);
    //レポートテーブル内の自分のidを昇順に取得
    $statement = $dbh->prepare("SELECT * FROM REPORT WHERE  ID LIKE (:name) ORDER BY COMPANY ASC ");


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



<h2>活動中</h2>



<?php
//活動中の中に表示する内容
if($row_count != 0){
    foreach($rows as $row){
        if($row['CONTENTS'] == NULL){
?>

	<!リンクで変数を遷移先に渡しその内容表示　!>
	<?php if(isset($_SESSION['id']) && $_SESSION['id'] == 'admin'){        //adminの場合 ?>
	<a href = "../recuruit/company_details.php?code=<?php echo $row['CODE'];?>&flg=0 &name=<?php echo $_GET['name']?> &id=<?php echo $_GET['id']?>">・<?=htmlspecialchars($row['COMPANY'],ENT_QUOTES,'UTF-8')?></a>
	<?php }
	else{?>
	<a href = "../recuruit/recuruit_report_edit.php?code=<?php echo $row['CODE'];?>&flg=0">・<?=htmlspecialchars($row['COMPANY'],ENT_QUOTES,'UTF-8')?></a>
	<?php }?>
	［
	<?php if($row['PURPOSE1']!=null){//目的の内容が空なら表示しない?>

	<?=htmlspecialchars($row['PURPOSE1'],ENT_QUOTES,'UTF-8') ?><?php }?>
	<?php if($row['PURPOSE2']!=null){?>
	<?=htmlspecialchars($row['PURPOSE2'],ENT_QUOTES,'UTF-8')?><?php }?>
	<?php if($row['PURPOSE3']!=null){?>
	<?=htmlspecialchars($row['PURPOSE3'],ENT_QUOTES,'UTF-8')?><?php } ?>
	］<br>


<?php

        }
    }
}
?>



<h2>活動実績</h2>

</u>
<?php $company = "initial";?>

<?php
    if($row_count != 0){
        foreach($rows as $row){
            //実施内容の中身があるなら活動実績の方に表示
            if($row['CONTENTS'] != NULL){
?>

<?php if($row['COMPANY'] != $company ){//一つ前の会社名と同じでなければ?>
<?php if($company != "initial"){//一番上に空白を入れない為の処理?>
<br>
<?php }?>
<?php if($row['RESULT'] == "内定"){//リザルトの中身が合格なら
            echo '<font color="#ff4500"> ';//赤
            echo "内定　　　・";
            echo htmlspecialchars($row['COMPANY'],ENT_QUOTES,'UTF-8');
            echo '</font>';
        }else if($row['RESULT'] == null || $row['RESULT'] == "選考中"){//選択なしor新規追加されたときにリザルトに入る値の時
            echo "選考中　　・";
            echo htmlspecialchars($row['COMPANY'],ENT_QUOTES,'UTF-8');
        }else if($row['RESULT'] == "選考落ち"){//不合格の時
            echo  '<font color="#0000FF">';//青
            echo "選考落ち　・";
            echo htmlspecialchars($row['COMPANY'],ENT_QUOTES,'UTF-8');
            echo '</font>';
        }

?>
<?php }?>

<?php if($row['COMPANY'] == $company){?>
➡
<?php }?>
<! 活動実績の内容の表示処理>

 <?php if(isset($_SESSION['id']) && $_SESSION['id'] == 'admin'){        //adminの場合 ?>
		<a href = "../recuruit/company_details.php?code=<?php echo $row['CODE'];?>&flg=1 &name=<?php echo $_GET['name']?> &id=<?php echo $_GET['id']?>">

<?php }else{                                                                   //userの場合?>
		<a href = "../recuruit/recuruit_report_edit.php?code=<?php echo $row['CODE'];?>&flg=1">
<?php } ?>
	［
			<?php if($row['PURPOSE1']!=null){?>
				<?=htmlspecialchars($row['PURPOSE1'],ENT_QUOTES,'UTF-8')?><?php }?>
			<?php if($row['PURPOSE2']!=null){?>
				<?=htmlspecialchars($row['PURPOSE2'],ENT_QUOTES,'UTF-8')?><?php }?>
			<?php if($row['PURPOSE3']!=null){?>
				<?=htmlspecialchars($row['PURPOSE3'],ENT_QUOTES,'UTF-8')?><?php }?>
	 ］
</a>
    <?php     $company = $row['COMPANY'];//一つ前のやつとおんなじか判別するための変数
            }
        }
    }
?>
</body>
</html>