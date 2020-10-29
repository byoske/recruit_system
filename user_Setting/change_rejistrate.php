<?php
session_start();
require_once('../config.php');
require_once('../user_menu.php');

$name = $_SESSION['id'];
$password2 = $_POST['password2'];
$password3 = $_POST['password3'];

try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $stmt = $pdo->prepare('select * from user where id = ?');
    $stmt->execute([$name]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}



//パスワード確認後sessionにメールアドレスを渡す
if (password_verify($_POST['password1'], $row['PASSWORD'])) {
    session_regenerate_id(true); //session_idを新しく生成し、置き換える

    if ($password2 != $password3) {
        echo '新パスワードが間違っています。<br />';
        echo "<a href = '../user_Setting/pass_change.php'>戻る";
        return false;
    }

    if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $password2)) {
        $password2 = password_hash($password2, PASSWORD_DEFAULT);
    } else {
        echo 'パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。<br />';
        echo "<a href = '../user_Setting/pass_change.php'>戻る";
        return false;
    }

    try {
        //        $pdo = new PDO(DSN, DB_USER, DB_PASS);
        $stmt = $pdo->prepare('update user set PASSWORD = ? where id = ?');
        $stmt->execute([$password2, $name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }

    echo 'パスワード変更しました。<br />';
    echo '自動的にログアウトするので、再度ログインしてください。<br />';
    echo '※ブラウザから戻るはしないでください。<br /><br />';
    echo '10秒経ってもページが切り替わらない場合は、下記ログアウトをクリックしてください。<br />';
    echo "<a href='../logout/logout.php'>ログアウト</a>";
    echo '<meta http-equiv="refresh" content=" 5; url= ../logout/logout.php">';
} else {
    echo '旧パスワードが間違っています。<br />';
    echo "<a href = '../user_Setting/pass_change.php'>戻る";
    return false;
}

