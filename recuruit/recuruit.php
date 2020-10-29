<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>就職活動画面</title>
 </head>
 <body>
 <?php

  session_start();
  require_once('../config.php');
  require_once('../user_menu.php');
  $id = $_SESSION['id'];
  try {
      $pdo = new PDO(DSN, DB_USER, DB_PASS);
      $stmt = $pdo->prepare('select * from USER where ID = ?');
      $stmt->execute([$id]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (\Exception $e) {
      echo $e->getMessage() . PHP_EOL;
  }

  ?>
  <h1>就職活動画面</h1>

 <p1>
 	<ul>
 		<li><a href = "recuruit_report.php">就職活動実績　（報告）画面へ</a>
 		<li><a href = "recuruit_browsing.php">就職活動実績　（閲覧）画面へ</a>
 		<li><a href = "../user/user.php">戻る</a>
 	</ul>
 </p1>
 </body>
</html>
