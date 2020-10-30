
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
   <h1>ログインしろー！！</h1>
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


