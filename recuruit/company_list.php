

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
/*******************ページング変更箇所************/
include "../Numbers.php";
/*******************ページング変更箇所************/
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

	キーワード<br>
	<form action="company_list.php" method="get" style="display: inline">
	<input type="text" name="yourname">を含む<br><br>
	<input type="text" name="yourname2">を含まない<br><br>
	<input type="submit" value="検索"><br><br>
	</form>

	<form action="company_list.php" method="get" style="display: inline">
	</form>

	<form action="company_list.php" method="get" style="display: inline">
	<input type="submit" value="全体表示"><br><br>
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
/*******************ページング変更箇所************/

$count = 0; // データの総数
/*************************************************/
//テーブル指定
//SHOW TABLE　でテーブル名を取得してそのテーブル名でセレクト文を作ってテーブルデータを取得する
/*****************************************検索してない時************************************************/
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
/******************************************検索かけた時に使われる**********************************************/
$sql3 = 'SHOW TABLES';
$stmt3 = $dbh->query($sql3);


while ($result3 = $stmt->fetch(PDO::FETCH_NUM)){
    $table_names[] = $result3[0];
}

$table_datas2 = array();

foreach ($table_names as $key => $table_name2) {
    $sql4 = "SELECT COMPANY,ADDRESS,PURPOSE1,PURPOSE2,PURPOSE3,CONTENTS FROM $table_name2 ";    //会社、住所、目的、実施内容
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
/**************************************全表示***************************************************/
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
                /*******************ページング変更箇所************/
                $data[] = $val;
                $count = $count+1; // データの総数
                /*******************ページング変更箇所************/
                $yourname = "";
                $yourname2 = "";
           /* ?>
			<td><a href = "../recuruit/company_search.php?id=<?php echo $val;?>">・<?=htmlspecialchars($val,ENT_QUOTES,'UTF-8')?></a></td>
            </html>
            <?php */
            }
            }

                echo "</tr>";
    }

 echo "</table>";
}

/************************************************************************************************/
/***************************************検索**************************************************/

foreach ($table_datas2 as $table_name2 => $table_data2) {

if (empty($table_data2)) {
    continue;
}

echo "<table border=0 style=border-collapse:collapse;>";
$companys = '';
$not_companys = '';
    foreach ($table_data2 as $record_num2 => $record_data2) {
        // レコード内のカラム数分ループ
        $company_flag = 1;


        foreach ($record_data2 as $column_name2 => $val2) {         //カラムごとに検索ループする

            if($company_flag == 1){     //会社名を"$company"に取り出す
                $company = $val2;
                $company_flag = 0;
            }

            if(!(!isset($_GET['yourname'])  || $_GET['yourname'] === "" )){              //検索したとき
                $yourname = $_GET['yourname'];
                if (strpos($val2, $yourname) !== false) {       //含まれる場合
                    $companys = $companys.$company;            //companysにはyournameに含まれる企業名が入る
                  }
            }

            if(!(!isset($_GET['yourname2'])  || $_GET['yourname2'] === "" )){           //NOT検索したとき
                $yourname2 = $_GET['yourname2'];
                 if (strpos($val2, $yourname2) !== false) {     //含まれる場合
                     $not_companys = $not_companys.$company;            //companysにはyourname2に含まれる企業名が入る
                 }
            }
        }

                echo "</tr>";
    }
   // echo $companys;
    if((!(!isset($_GET['yourname'])  ||( $_GET['yourname'] === "") ))&&(!isset($_GET['yourname2'])  ||( $_GET['yourname2'] === "") )){
        echo "「".$yourname."」を含む検索結果<br>";
    }
    elseif((!(!isset($_GET['yourname2'])  ||( $_GET['yourname2'] === "") ))&&(!isset($_GET['yourname'])  ||( $_GET['yourname'] === "") )){
        echo "「".$yourname2."」を含まない検索結果<br>";
    }
    elseif((!(!isset($_GET['yourname2'])  ||( $_GET['yourname2'] === "") ))&&(!(!isset($_GET['yourname'])  ||( $_GET['yourname'] === "") ))){
        echo "「".$yourname."」を含む「".$yourname2."」を含まない検索結果<br>";
    }

    foreach ($table_data as $record_num => $record_data) {

        foreach ($record_data as $column_name => $val) {
            //含む検索の場合   if文（yournameに入っていて、yourname2に入っていない場合）
            if((!(!isset($_GET['yourname'])  ||( $_GET['yourname'] === "") ))&&(!isset($_GET['yourname2'])  ||( $_GET['yourname2'] === "") )){
                if (strpos($companys, $val) !== false) {            // companysに含む企業を表示
                    $data[] = $val;
                    $count = $count+1; // データの総数
                    ?>
      <?php     }
                $yourname2 = "";
            }
            //含まない検索の場合 if文（yournameに入っていなくて、yourname2に入っている場合）
            elseif((!(!isset($_GET['yourname2'])  ||( $_GET['yourname2'] === "") ))&&(!isset($_GET['yourname'])  ||( $_GET['yourname'] === "") )){
                if (strpos($not_companys, $val) === false) {            // companysに含まれない企業を表示
                    $data[] = $val;
                    $count = $count+1; // データの総数
                        ?>
      <?php     }
                 $yourname = "";
            }
            //両方の検索の場合 if文（yourname2に入っていて、yournameにも入っている場合）
            elseif((!(!isset($_GET['yourname2'])  ||( $_GET['yourname2'] === "") ))&&(!(!isset($_GET['yourname'])  ||( $_GET['yourname'] === "") ))){
                if ((strpos($not_companys, $val) === false) &&(strpos($companys, $val) !== false)){
                    $data[] = $val;
                    $count = $count+1; // データの総数
                    ?>
      <?php     }

            }


        }
        echo "</tr>";
    }
    echo "</table>";
}
/************************************************************************************************/
/*******************ページング変更箇所************/
if($count !=0){
        $perPage = 20; // １ページあたりのデータ件数
        $totalPage = ceil($count / $perPage); // 最大ページ数
        $page = empty($_GET['page']) ? 1 : (int) $_GET['page']; // 現在のページ
        function filterData($page, $perPage, $data) {
           return array_filter($data, function($i) use ($page, $perPage) {
              return $i >= ($page - 1) * $perPage && $i < $page * $perPage;
          }, ARRAY_FILTER_USE_KEY);
        }
        $filterData = filterData($page, $perPage, $data);


        foreach ($filterData as $data) {
           ?>   <a href = "../recuruit/company_search.php?id=<?php echo $data; ?>">・<?=htmlspecialchars($data,ENT_QUOTES,'UTF-8')?></a><br>
		<?php  //     print '<li>' . $data . '</li>';
           }
            echo "<br><br>";
           ?>
		<div>
		<?php
		paging2($totalPage, $page,2 ,$yourname, $yourname2);
		?>
		</div>
 		<?php
           /*******************ページング変更箇所************/
}
?>