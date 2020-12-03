
<?php
require_once('../config.php');
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
<a href='../recuruit/company_list.php'>戻る</a><br>
<title>検索画面</title>
<meta charset="utf-8">

</head>
<body>
<?php
header("Content-type: text/html; charset=utf-8");
try{
    $dbh = new PDO(DSN, DB_USER, DB_PASS);
    //日本語が含まれているなら名前検索

     $statement = $dbh->prepare("SELECT * FROM report WHERE  COMPANY LIKE (:name) ");



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
<td><a href = "../recuruit/company_details.php?code=<?php echo $row['CODE'];?>">・<?=htmlspecialchars($company,ENT_QUOTES,'UTF-8')?></a></td>
</tr>
	<?php
    }


}
?>