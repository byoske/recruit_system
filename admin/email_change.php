<?php
require_once('../admin_menu.php');
require_once('../config.php');


$id = $_SESSION['id'];
//$password1 = $_POST['password1'];
$domain = "@nagoya-vti.ac.jp";
$email2 = $_POST['email2'];
$email3 = $_POST['email3'];

try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $stmt = $pdo->prepare('select * from user where ID = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

/*
 if (!isset($row['NAME'])) {
 echo 'メールアドレス又はパスワードが間違っています。<br />';
 echo "<a href = '../login/pass_change.php'>戻る";
 return false;
 }
 */

//パスワード確認後sessionにメールアドレスを渡す

    session_regenerate_id(true); //session_idを新しく生成し、置き換える

    if ($email2 != $email3) {
        echo '正しくメールアドレスを入力してください。<br />';
        echo "<a href = '../admin/admin_emailchange.php'>戻る";
        return false;
    }

  //$email2 = password_hash($email2, PASSWORD_DEFAULT);


    try {
        //        $pdo = new PDO(DSN, DB_USER, DB_PASS);
        $stmt = $pdo->prepare('update user set MAIL = ? where ID = ?');
        $stmt->execute([$email3.$domain, $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }

    echo 'メールアドレスを変更しました。<br />';
    echo "<a href='../admin/admin.php'>ホームに戻る</a>";


