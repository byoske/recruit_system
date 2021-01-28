
<?php
require_once('../admin_menu.php');
require_once('../config.php');


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
    $sql2 = "SELECT * FROM $table_name;";
    /* ---- 変更箇所 ---- */
    if($table_name == 'user'){
    $stmt2 = $dbh->query($sql2);
    $table_datas[$table_name] = array();
    while ($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
        $table_datas[$table_name][] = $result2;  // ここの配列への追加がまちがってた
    }
    }
    /* ----------------- */
}

foreach ($table_datas as $table_name => $table_data) {
    //echo "<h1>$table_name</h1>";
    echo "<h1>ユーザー一覧</h1>";
    echo "<a href = '../admin/admin.php'>ホームに戻る</a>";
    if (empty($table_data)) {
        continue;
    }

    echo "<table border=1 style=border-collapse:collapse;>";
    echo "<tr>";
    // カラム名を表示
    foreach ($table_data[0] as $column_name => $val) {
        if($column_name == "PASSWORD"){
            continue;
        }
        echo "<th>";
        echo $column_name;
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

            if($column_name == "NAME"){
                if($id != "admin"){
               // echo "<td>".$val;
               ?>
		<!DOCTYPE html>
               <html>
                <head>
   <meta charset="utf-8">
   <title>ユーザー一覧</title>
 </head>
				<body>
                <td><a href = "../recuruit/recuruit_report_top.php?id=<?php echo $id;?>&name=<?php echo $val;?>&list_flag=<?php echo 1;?>"><?=htmlspecialchars($val,ENT_QUOTES,'UTF-8')?>

            <?php    continue;
                }
            }

            echo "<td>";
            echo $val;
            //            echo "</td>";

        }

        $flag =1;

        echo "<td>";
        echo "<form action=../user_initialize/user_control.php method=post>";
        echo "<input type=submit value=変更>";
        echo "<input type=hidden name=id value='".$id."'>";
        echo "<input type=hidden name=flag value='".$flag."'>";
        echo "</form>";
        echo "</td>";
?>
<script type="text/javascript">
<!--
function dispDelete($id){

	if($id != "admin"){
  if(!window.confirm('本当に削除しますか？==>'+$id)){
    window.alert('キャンセルされました'); // 警告ダイアログを表示
    return false;
  }
  window.alert('削除されました');//削除ダイアログを表示
  return true;
	}
}
//------>
</script>
<html>
<body>
        <td>
        <form action=../user_delete/user_delete.php method=post >
        <input type=submit value=削除 name=delete onClick= "return dispDelete('<?php echo $id;?>')">
        <input type=hidden name=id value=<?php echo $id;?>>
        <input type=hidden name=flag value=<?php echo $flag;?>>
        </form>
        </td>
</body>
</html>
<?php
        echo "</tr>";


    }
    echo "</table>";
}
?>
