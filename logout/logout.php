<?php
session_start();
$output = '';
if (isset($_SESSION["id"])) {
    $output = 'ログアウトしました。';
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