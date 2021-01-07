<?php
session_start();
require_once('../config.php');
require_once('../user_menu.php');
?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>ユーザー設定</title>
 </head>
 <h1>ユーザー設定</h1>
 <body>
 <ul>
 <li><a href = "../user_Setting/pass_change.php">パスワード変更</a>
 <li><a href = "../user_Setting/Name_change_H.php">名前変更</a>
 </ul>
 <a href='user.php'>ホームに戻る</a>
 </body>
</html>


