

<?php
session_start();
require_once('../config.php');
require_once('../user_menu.php');
$id = $_SESSION['id'];
try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $stmt = $pdo->prepare('select * from USER where ID = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
if(isset($_POST['yes'])){

    $name2 = $_POST['name2'];
    $name1 = $_POST['name'];


if (!isset($row['ID'])) {
    echo 'データベースに接続できません。<br />';
    echo "<a href = '../user/user_Setting.php'>戻る";
    return false;
}

//パスワード確認後sessionにメールアドレスを渡す
if (($row['NAME'] == "none" && $name2 == $name1) || ($id == "admin" && $name2 == $name1)){
    session_regenerate_id(true); //session_idを新しく生成し、置き換える

    try {
        //        $pdo = new PDO(DSN, DB_USER, DB_PASS);
        $stmt = $pdo->prepare('update USER set NAME = ? where ID = ?');
        $stmt->execute([$name2, $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
// セッションname更新
        $_SESSION['name'] = $name2;
    } catch (\Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
    echo '名前を変更しました。<br />';

    if($id == "admin") {
        echo "<a href='../admin/admin.php'>ホームに戻る</a>";
    } else {
        $output = '';
        if (isset($_SESSION["id"])) {
            $output = '再ログインしてください。';
        } else {
            require_once('../user_menu.php');
            //    $output = 'タイムアウトしました。';
        }
        //セッション変数のクリア
        $_SESSION = array();
        //セッションクッキーも削除
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
                );
        }
        //セッションクリア
        @session_destroy();

        echo $output;
        echo "<br /> <a href='../login/sign.php'>ログイン画面へ</a>";
    }

    }else {
        echo '名前が一致しませんでした。<br />';
        echo "<a href = '../user_Setting/Name_change_H.php'>戻る";
        return false;
}
}
?>
