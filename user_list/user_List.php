<?php
require_once('../admin_menu.php');
require_once('../config.php');


/*  戻ってもバッファに残るようにする  */

header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
/***************************************/

header("Content-type: text/html; charset=utf-8");
/*
if(empty($_GET)) {
    header("Location: pdo_search_form.html");
    exit();
}else{
    //名前入力判定
    if (!isset($_GET['yourname'])  || $_GET['yourname'] === "" ){
        $errors['name'] = "名前が入力されていません。";
    }
}*/

if(!empty($_GET['yourname'])){
    $yourname = $_GET['yourname'];
    $min_year = $_GET['min_year'];
    $max_year = $_GET['max_year'];
}else{
    $tmp = "";
    $flag = 0;
  /************************一番新しい年度を検索する******************************/
    for($yourname=2018; $yourname <2100; $yourname++){
    $dbh = new PDO(DSN, DB_USER, DB_PASS);
    $statement = $dbh->prepare("SELECT * FROM USER WHERE  ID LIKE (:name) ");

    if($statement){
        //ポストされた値をLIKEで使えるように変換をしている

        $like_yourname = "stu%".$yourname."%_";
        //プレースホルダへ実際の値を設定する
        $statement->bindValue(':name', $like_yourname, PDO::PARAM_STR);
        if($statement->execute()){
            //レコード件数取得
            $row_count = $statement->rowCount();
         }
    }
    if($row_count != ""){       //データが見つかった時にフラグが立つ
        if($flag == 0){
            $min_year = $yourname;
        }
        $flag = 1;
    }
    if(($row_count == 0)&&($flag == 1)){
        $yourname = $yourname -1;
        $max_year = $yourname;
        /*echo "BREAK";
        echo $min_year;
        echo $max_year;*/
        break;

    }
$tmp = $row_count;
    }
  /**********************************************************************************/
}
    try{
        $dbh = new PDO(DSN, DB_USER, DB_PASS);

        $statement = $dbh->prepare("SELECT * FROM USER WHERE  ID LIKE (:name) ");


        if($statement){
            //ポストされた値をLIKEで使えるように変換をしている

            $like_yourname = "%".$yourname."%";
            $_SESSION['yourname'] = $yourname;
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
<title>ユーザー一覧</title>
<meta charset="utf-8">
</head>
<body>
<?php echo "<h1>ユーザー一覧</h1>"; ?>
<a href='../admin/admin.php'>ホームに戻る</a>
<p><b><?php echo $yourname."年度\t" .$row_count."名"?></b></p>


<table border=1 style=border-collapse:collapse>
<tr><td>ID</td><td>NAME</td><td>MAIL</td><td>CREATED</td></tr>

<?php

if($row_count != 0){
    foreach($rows as $row){
        ?>

	<td><?= $id = $row['ID'];
	$_SESSION['pdo_id'] = $id; ?></td>
	<?php if($id != "admin"){  ?>
	<td><a href = "../recuruit/recuruit_report_top.php?id=<?php echo $id;?>&name=<?php echo $row['NAME'];?>&list_flag=<?php echo 0;?>&yourname=<?php echo $yourname;?>"><?=htmlspecialchars($row['NAME'],ENT_QUOTES,'UTF-8')?></td>
<?php }else{?>
    <td><?=htmlspecialchars($row['NAME'],ENT_QUOTES,'UTF-8')?></td>
<?php } ?>

	<td><?=htmlspecialchars($row['MAIL'],ENT_QUOTES,'UTF-8')?></td>
	<td><?=htmlspecialchars($row['CREATED'],ENT_QUOTES,'UTF-8')?></td>
 <?php




    $flag = 0;
    echo "<td>";
    echo "<form action=../user_initialize/user_control.php method=GET>";
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
        <form action=../user_delete/user_delete.php method=get >
        <input type=submit value=削除 name=delete onClick= "return dispDelete('<?php echo $id;?>')">
        <input type=hidden name=id_pdo value=<?php echo $id;?>>
        <input type=hidden name=flag value=<?php echo $flag;?>>
        <input type=hidden name=yourname value=<?php echo $_SESSION['yourname']?>>
        </form>
        </td>
</body>
</html>
<?php
        echo "</tr>";
    }
    echo "</table><br>";

	if($min_year < $yourname){?>
	<td><a href ="?yourname=<?php echo $yourname-1;?>&min_year=<?php echo $min_year;?>&max_year=<?php echo $max_year;?>"><?=htmlspecialchars($yourname-1)?></td>
<?php   echo "年度へ";
    }
    if($max_year > $yourname){
        ?>
	<td><a href ="?yourname=<?php echo $yourname+1;?>&min_year=<?php echo $min_year;?>&max_year=<?php echo $max_year;?>"><?=htmlspecialchars($yourname+1)?></td>
<?php  echo "年度へ";
    }
}
?>
