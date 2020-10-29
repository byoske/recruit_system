<?php
session_start();
if(!isset($_SESSION['id'])){
    echo "ログインしてください。";
    echo '<meta http-equiv="refresh" content=" 5; url= ../login/sign.php">';
    exit;
}
if($_SESSION['id'] != "admin"){
    echo '管理者用ページです。';
    echo '<meta http-equiv="refresh" content=" 5; url= ../user/user.php">';
    exit;
}