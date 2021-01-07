  <?php
  require_once ('../admin_menu.php');
  require_once('../config.php');
  ?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>管理者設定</title>
 </head>
 <h1>管理者設定</h1>
 <body>
 <ul>
 <li><a href = "../admin/admin_emailchange.php">メールアドレス変更</a>
 <li><a href = "../user_Setting/pass_change.php">パスワード変更</a>
 <li><a href = "../user_Setting/Name_change_H.php">名前変更</a><br>


 </ul>
 </body>

 <!--
  <?php
  require_once ('../admin_menu.php');
function h($s){
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

echo "<a href='../admin/admin.php'>戻る</a>";

?>
-->
 <a href='../admin/admin.php'>ホームに戻る</a>
</html>
