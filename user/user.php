<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>ユーザー画面</title>
   <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/base-min.css">
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
  <h1><?php echo 'ようこそ' .  $id .'('.$row['NAME'].  ')さん'; ?></h1>

 <p1>
 	<ul>
 		<li><a href = "user_Setting.php">ユーザー設定</a>
 		<li><a href = "../recuruit/recuruit_report_top.php">就職活動報告</a>
 		<li><a href = "../recuruit/company_list.php">就職活動実績閲覧</a>
 		<li><a href = "../logout/logout.php">ログアウト</a>
 	</ul>
 </p1>
 </body>
</html>
