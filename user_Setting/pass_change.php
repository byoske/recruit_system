<?php
session_start();
require_once('../user_menu.php');
?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>Login</title>
   <style>

   form dl dt{
  width: 130px;
  padding:5px 0;
  float:left;
  clear:both;
}

form dl dd{
  padding:5px 0;
}

   </style>
 </head>
 <body>
   <h1>パスワード変更</h1>
   <form action="change_rejistrate.php" method="post">
   <dl>
	<dt>旧パスワード</dt>
    <dd><input required type="password" name="password1" size="50"></dd>
	<dt>新パスワード</dt>
    <dd><input required type="password" name="password2" size="50"></dd>
	<dt>新パスワード確認</dt>
    <dd><input required type="password" name="password3" size="50"></dd><br>
    <button type="submit">登録</button>
    <p>※パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。</p>
   </dl>
   </form>
   <?php
   require_once('../config.php');
   require_once('../user_menu.php');

   $id = $_SESSION['id'];
   if($id == "admin") {
        echo "<a href='../admin/admin.php'>ホームに戻る";
   } else {
       echo "<a href = '../user/user.php'>ホームに戻る";
   }
   ?>
 </body>
</html>


