<?php

require_once('../admin_menu.php');
require_once('../config.php');


$id = $_POST['id'];
if($id == "admin") {
    $alert = "<script type='text/javascript'>alert('adminユーザーは削除できません\\n※OKボタンを押してください');</script>";
    echo $alert;
}else{
try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $stmt = $pdo->prepare('delete from USER where ID = ?');
    $stmt->execute([$id]);
    //$row = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
}
require('../user_list/user_List.php');
