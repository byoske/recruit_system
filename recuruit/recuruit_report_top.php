<?php
    session_start();
    require_once("../config.php");
    require_once("../user_menu.php");

?>
<!DOCTYPE html>
<html lang="ja">

<?php
if (isset($_SESSION['id']) && $_SESSION['id'] == 'admin') {     //adminの場合
    $val = $_GET['name'];
?>
 <head>
   <meta charset="utf-8">
   <title><?php echo $val;?> - 就職活動状況</title>
 </head>
 <body>
<h1><?php echo $val."(".$_GET['id'].")";?></h1>

<?php }else{ ?>
 <head>
   <meta charset="utf-8">
   <title>就職活動報告</title>
 </head>
 <body>
<h1>就職活動報告</h1>
<?php }?>


 <p1>
 <?php

if (isset($_SESSION['id']) && $_SESSION['id'] == 'admin') {     //adminの場合
  /*  if( $_GET['list_flag'] == 1){
     echo "<a href = '../user_list/user_List.php'>戻る</a>";
    }
    else{
        $yourname = $_GET['yourname'];
        ?>
        <td><a href = "../user_list/pdo_search.php?yourname=<?php echo $yourname;?>"><?=htmlspecialchars("戻る",ENT_QUOTES,'UTF-8')?></a></td>
<?php } */
    echo "<a href = '../admin/admin.php'>ホームに戻る</a>";
}
else{                                                               //userの場合
    echo "<a href = '../user/user.php'>ホームに戻る</a>";


?>
<br>
	 <a href = "../recuruit/recuruit_report.php" >新規作成</a>

<?php }

echo '<ul>'; require_once("../user_list/recuruit_list.php");  //テーブルを表示するファイルを一度呼び出し
                echo '</ul>';?>

 	<u>

 </p1>
 </body>
</html>