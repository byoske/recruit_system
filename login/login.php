<?php

require_once('../config.php');
session_start();

if (isset($_POST['id']) == NULL){
    require_once('../user_menu.php');
}

$id = $_POST['id'];


//DB内でPOSTされたメールアドレスを検索
try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $stmt = $pdo->prepare('select * from USER where ID = ?');
    $stmt->execute([$_POST['id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
//emailがDB内に存在しているか確認
if (!isset($row['ID'])) {
    echo '登録されていないユーザー名です。<br />';
    echo "<a href = 'sign.php'>戻る";
    return false;
}
//パスワード確認後sessionにメールアドレスを渡す
if (password_verify($_POST['password'], $row['PASSWORD'])) {
    session_regenerate_id(true); //session_idを新しく生成し、置き換える
    $_SESSION['id'] = $row['ID'];
    $_SESSION['name'] = $row['NAME'];
    echo "ログインしました。</br>";
    if($id == "admin") {
        echo '<meta http-equiv="refresh" content=" 2; url=../admin/admin.php">';
        echo "<a href='../admin/admin.php'>次へ</a>";
        exit;
    }
    echo '<meta http-equiv="refresh" content=" 2; url= ../user/user.php">';
    echo "<a href='../user/user.php'>次へ</a>";
} else {
    echo 'パスワードが間違っています。<br />';
    echo "<a href = 'sign.php'>戻る";
    return false;
}

