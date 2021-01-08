
<?php
require_once('../config.php');
session_start();
$val = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>就職活動実績閲覧</title>
</head>
<h1><?php echo $val;?></h1>
<head>
<?php if (isset($_SESSION['id']) && $_SESSION['id'] == 'admin') {     //adminの場合    ?>
			<a href='../admin/admin.php'>ホームに戻る</a><br>
<?php }
      else{                                                              //userの場合      ?>
      		<a href='../user/user.php'>ホームに戻る</a><br>
<?php } ?>
<title>検索画面</title>
<meta charset="utf-8">

</head>
<body>
<?php
header("Content-type: text/html; charset=utf-8");
try{
    $dbh = new PDO(DSN, DB_USER, DB_PASS);
    //日本語が含まれているなら名前検索

     $statement = $dbh->prepare("SELECT * FROM report WHERE  COMPANY LIKE (:name) ORDER BY CODE DESC ");



    if($statement){
        //ポストされた値をLIKEで使えるように変換をしている

        $like_yourname = $val;
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

<p><?=htmlspecialchars($val, ENT_QUOTES, 'UTF-8')."での検索結果"?><?=$row_count?>件です。</p>


<table border=0 style=border-collapse:collapse>


<?php

if($row_count != 0){
    foreach($rows as $row){





        $company = $row['DATE']." ".$row['PURPOSE1']." " .$row['PURPOSE2']." ".$row['PURPOSE3'];

?>
<tr>
<td><a href = "../recuruit/company_details.php?code=<?php echo $row['CODE'];?>&name=""">・<?=htmlspecialchars($company,ENT_QUOTES,'UTF-8')?></a>&nbsp;&nbsp;&nbsp;

	<?php
	if (isset($_SESSION['id']) && $_SESSION['id'] == 'admin') {     //adminの場合
	    echo $row['NAME']. '('.$row['ID'].')';
	}
	?></td></tr>
<?php
    }


}
?>