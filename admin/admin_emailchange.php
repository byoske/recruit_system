<?php
require_once('../admin_menu.php');
require_once('../config.php');

try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $stmt = $pdo->prepare('select * from USER where ID = ?');
    $stmt->execute([$_SESSION['id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
$mail = $row['MAIL'];

//$_SESSION['id'] = $row['MAIL'];


?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>Login</title>
   <style>
   form dl dt{
  width: 200px;
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
   <h1>メールアドレス変更</h1>
   <form action="email_change.php" method="post">
   <dl>
	<p>旧メールアドレスは<?php echo $mail;?>です。</p>
	<dt>新メールアドレス入力</dt>
    <dd><input type="text" name="email2" size="20" onInput="checkForm(email2)"  ><label>@nagoya-vti.ac.jp</label></dd>
	<dt>新メールアドレス確認用</dt>
    <dd><input type="text" name="email3" size="20" onInput="checkForm(email3)"  ><label>@nagoya-vti.ac.jp</label></dd><br>
    <button type="submit">登録</button>
   </dl>
   <!-- 入力フォームには半角文字しか入力できない -->
   <script type="text/javascript">
   <!--
   function checkForm($this) {
       var str=$this.value;
       while(str.match(/[^A-Z^a-z\d\-\_]/)) {
           str=str.replace(/[^A-Z^a-z\d\-\_]/,"");
       }
       $this.value=str;
   }
   //-->
   </script>
   </form>
   <p><a href = '../admin/admin.php'>ホームに戻る</a></p>
 </body>
</html>



