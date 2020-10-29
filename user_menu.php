<?php
if(!isset($_SESSION['id'])){
    echo "ログインしてください。";
    echo '<meta http-equiv="refresh" content=" 5; url= ../login/sign.php">';
    exit;
}