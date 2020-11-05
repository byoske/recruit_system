<?php
function h($s){
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

session_start();
//ログイン済みの場合
if (isset($_SESSION['id']) && $_SESSION['id'] != 'admin') {
    echo 'ようこそ' .  h($_SESSION['id']) . "（".h($_SESSION['name'])."）さん<br>";
    echo '<meta http-equiv="refresh" content=" 2; url= ../user/user.php">';
    exit;
}else if(isset($_SESSION['id']) && $_SESSION['id'] == 'admin'){
    echo 'ようこそ 管理者さん';
    echo '<meta http-equiv="refresh" content=" 2; url=../admin/admin.php">';
    exit;
}

?>
<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>Login</title>
   <?php   //require_once ('../style.php');?>
      <style>

   form dl dt{
  width: 100px;
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
   <h1>ログインしてください</h1>
   <form  action="login.php" method="post">
   <dl>
     <dt>ユーザー名</dt>
     <dd><input type="text" name="id" size="50"></dd>
     <dt>パスワード</dt>
     <dd><input type="password" name="password" size="51"></dd><br>
     <button type="submit">ログイン</button>
   </dl>
   </form>
 </body>
</html>


