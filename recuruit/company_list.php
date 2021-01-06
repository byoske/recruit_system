

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>就職活動実績閲覧</title>
 </head>
 <h1>就職活動実績閲覧</h1>
<head>

<?php
require_once('../config.php');
session_start();
if (isset($_SESSION['id']) && $_SESSION['id'] == 'admin') {
    echo "<a href='../admin/admin.php'>ホームに戻る</a><br><br>";
}
else{
    echo "<a href='../user/user.php'>ホームに戻る</a><br><br>";
}
?>


<title>検索画面</title>
<meta charset="utf-8">

</head>
<body>


	キーワード検索<br>
	<form action="company_list.php" method="get" style="display: inline">
	<input type="text" name="yourname" required="required">
	<input type="submit" value="表示"><br><br>
	</form>

	<form action="company_list.php" method="get" style="display: inline">
	<input type="submit" value="全て表示"><br>
	</form>

</body>
</html>



<?php


try {
    $dbh = new PDO(DSN, DB_USER, DB_PASS,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    if ($dbh == null) {
        print_r('接続失敗').PHP_EOL;
    }
} catch(PDOException $e) {
    echo('Connection failed:'.$e->getMessage());
    die();
}

//テーブル指定
//SHOW TABLE　でテーブル名を取得してそのテーブル名でセレクト文を作ってテーブルデータを取得する

$sql = 'SHOW TABLES';
$stmt = $dbh->query($sql);


while ($result = $stmt->fetch(PDO::FETCH_NUM)){
    $table_names[] = $result[0];
}

$table_datas = array();

foreach ($table_names as $key => $table_name) {
    $sql2 = "SELECT DISTINCT COMPANY FROM $table_name;";
    /* ---- 変更箇所 ---- */

   if($table_name == 'report'){
    $stmt2 = $dbh->query($sql2);
    $table_datas[$table_name] = array();
    while ($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
        $table_datas[$table_name][] = $result2;  // ここの配列への追加がまちがってた
    }
    }

}


foreach ($table_datas as $table_name => $table_data) {

    if (empty($table_data)) {
        continue;
    }

    echo "<table border=0 style=border-collapse:collapse;>";
    echo "<tr>";
    // カラム名を表示
    foreach ($table_data[0] as $column_name => $val) {
        if($column_name == "PASSWORD"){
            continue;
        }
        echo "<th>";
        //echo $column_name;
        echo "</th>";

    }
    echo "</tr>";
    echo "<tr>";
    // レコードデータの表示
    // テーブル内のレコード数分ループ
    foreach ($table_data as $record_num => $record_data) {
        // レコード内のカラム数分ループ

        foreach ($record_data as $column_name => $val) {
            if($column_name == "PASSWORD"){
                continue;
            }
            if($column_name == "ID"){
                $id = $val;
            }
            if (!isset($_GET['yourname'])  || $_GET['yourname'] === "" ){               //検索に何もない時

            ?>

			<td><a href = "../recuruit/company_search.php?id=<?php echo $val;?>"class="lettercolor">・<?=htmlspecialchars($val,ENT_QUOTES,'UTF-8')?></a></td>
            </html>
            <?php
            }

            else{                                                                           //検索したとき
                $yourname = $_GET['yourname'];
                 if (strpos($val, $yourname) !== false) { ?>


			<td><a href = "../recuruit/company_search.php?id=<?php echo $val;?>"class="lettercolor">・<?=htmlspecialchars($val,ENT_QUOTES,'UTF-8')?></a></td>
            </html>


			<?php
                }
            }
            }
                echo "</tr>";


    }
    echo "</table>";
}
?>