

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


	企業名検索<br>
	<form action="company_list.php" method="get" style="display: inline">
	<input type="text" name="yourname" required="required">
	<input type="submit" value="表示"><br><br>
	</form>

	<form action="company_list.php" method="get" style="display: inline">
	</form>

	含まない検索<br>
	<form action="company_list.php" method="get" style="display: inline">
	<input type="text" name="yourname2" required="required">
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
/*****************************************検索************************************************/
$sql = 'SHOW TABLES';
$stmt = $dbh->query($sql);


while ($result = $stmt->fetch(PDO::FETCH_NUM)){
    $table_names[] = $result[0];
}

$table_datas = array();

foreach ($table_names as $key => $table_name) {
    $sql2 = "SELECT COMPANY FROM $table_name GROUP BY COMPANY ORDER BY MAX(CODE) DESC;";
    /* ---- 変更箇所 ---- */

   if($table_name == 'report'){
    $stmt2 = $dbh->query($sql2);
    $table_datas[$table_name] = array();
    while ($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
        $table_datas[$table_name][] = $result2;  // ここの配列への追加がまちがってた
    }
    }

}
/******************************************NOT検索**********************************************/
$sql3 = 'SHOW TABLES';
$stmt3 = $dbh->query($sql3);


while ($result3 = $stmt->fetch(PDO::FETCH_NUM)){
    $table_names[] = $result3[0];
}

$table_datas2 = array();

foreach ($table_names as $key => $table_name2) {
    $sql4 = "SELECT COMPANY,PURPOSE1,PURPOSE2,PURPOSE3,CONTENTS FROM $table_name2 ";
    /* ---- 変更箇所 ---- */

    if($table_name2 == 'report'){
        $stmt4 = $dbh->query($sql4);
        $table_datas2[$table_name2] = array();
        while ($result4 = $stmt4->fetch(PDO::FETCH_ASSOC)){
            $table_datas2[$table_name2][] = $result4;  // ここの配列への追加がまちがってた
        }
    }

}
/***********************************************************************************************/
/**************************************検索***************************************************/
foreach ($table_datas as $table_name => $table_data) {

    if (empty($table_data)) {
        continue;
    }

    echo "<table border=0 style=border-collapse:collapse;>";

    // カラム名を表示

    // レコードデータの表示
    // テーブル内のレコード数分ループ

    foreach ($table_data as $record_num => $record_data) {
        // レコード内のカラム数分ループ

        foreach ($record_data as $column_name => $val) {

            if ((!isset($_GET['yourname'])  || $_GET['yourname'] === "" )&&(!isset($_GET['yourname2'])  || $_GET['yourname2'] === "" )){   //検索に何もない時

            ?>

			<td><a href = "../recuruit/company_search.php?id=<?php echo $val;?>">・<?=htmlspecialchars($val,ENT_QUOTES,'UTF-8')?></a></td>
            </html>
            <?php
            }

            elseif(!isset($_GET['yourname2'])  || $_GET['yourname2'] === "" ){                                                                //検索したとき
                $yourname = $_GET['yourname'];
                 if (strpos($val, $yourname) !== false) { ?>


			<td><a href = "../recuruit/company_search.php?id=<?php echo $val;?>">・<?=htmlspecialchars($val,ENT_QUOTES,'UTF-8')?></a></td>
            </html>


			<?php
                }
            }
            }
                echo "</tr>";


    }
    echo "</table>";
}
/************************************************************************************************/
/***************************************NOT検索**************************************************/

foreach ($table_datas2 as $table_name2 => $table_data2) {

if (empty($table_data2)) {
    continue;
}

echo "<table border=0 style=border-collapse:collapse;>";
$companys = '';
    foreach ($table_data2 as $record_num2 => $record_data2) {
        // レコード内のカラム数分ループ
        $company_flag = 1;


        foreach ($record_data2 as $column_name2 => $val2) {         //カラムごとに検索ループする

            if($company_flag == 1){     //会社名を"$company"に取り出す
                $company = $val2;
                $company_flag = 0;
            }

            if(!(!isset($_GET['yourname2'])  || $_GET['yourname2'] === "" )){           //検索したとき
                $yourname2 = $_GET['yourname2'];
                 if (strpos($val2, $yourname2) !== false) {     //yourname2 を含まない
                     $companys = $companys.$company;            //companysにはyourname2に含まれる企業名が入る
                     break;
                 }
            }
        }

                echo "</tr>";


    }
   // echo $companys;
    foreach ($table_data as $record_num => $record_data) {
        foreach ($record_data as $column_name => $val) {
            if(!(!isset($_GET['yourname2'])  ||( $_GET['yourname2'] === "") )){
                if (strpos($companys, $val) === false) {            // companysに含まれない企業を表示
                        ?><td><a href = "../recuruit/company_search.php?id=<?php echo $val;?>">・<?=htmlspecialchars($val,ENT_QUOTES,'UTF-8')?></a></td>
           				 </html>
      <?php     }
            }

        }
        echo "</tr>";
    }
    echo "</table>";
}
/************************************************************************************************/


?>