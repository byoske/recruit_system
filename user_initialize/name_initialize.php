<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>名前初期化</title>
 </head>
</html>

<?php
require_once('../admin_menu.php');
require_once('../config.php');

//session_start();
//$id = $_SESSION['id'];

if(!empty($_POST['id'])){
    $id = $_POST['id'];
}
else{
    $id = $_GET['id'];
}

//echo  h($id) . "の変更<br>";
//$password1 = $_POST['password1'];
$name = 'none';        //変数にdefaultのパスワードを入れる

try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $stmt = $pdo->prepare('select * from user where ID = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}


//$name = password_hash($name, PASSWORD_DEFAULT);



try {

    $stmt = $pdo->prepare('update user set name = ? where ID = ?'); //DBのカラムを指定
    $stmt->execute([$name, $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

echo '名前を初期化しました。<br />';
echo "<a href='../admin/admin.php'>ホームに戻る</a>";