<?php
    session_start();
    require_once("../config.php");
    require_once("../user_menu.php");
?>
<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>就職活動報告</title>
 </head>
 <body>

  <h1>就職活動報告</h1>





 <p1>
     <a href = "../user/user.php">戻る</a><br>
	 <a href = "../recuruit/recuruit_report.php" >新規作成</a>
 	<ul>
 		<?php require_once("../user_list/recuruit_list.php");//テーブルを表示するファイルを一度呼び出し?>
 	</ul>
 	<u>

 </p1>
 </body>
</html>