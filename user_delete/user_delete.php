<?php

require_once('../admin_menu.php');
require_once('../config.php');

if(!empty($_POST['id'])){
    $id = $_POST['id'];
}
else{
    $id = $_GET['id_pdo'];
}

if($id == "admin") {
    $alert = "<script type='text/javascript'>alert('adminユーザーは削除できません\\n※OKボタンを押してください');</script>";
    echo $alert;
}else{

try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $stmt = $pdo->prepare('delete from USER where ID = ?');
    $stmt->execute([$id]);


} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

    }

if(!empty($_POST['id'])){
    if($_POST['flag']==1){
      echo ' <meta http-equiv="refresh" content="0; url=../user_list/user_List.php">';
    }
    else{
        echo ' <meta http-equiv="refresh" content="0; url=../user_list/pdo_search.php">';
    }
}
else{
    echo ' <meta http-equiv="refresh" content="0; url=../user_list/pdo_search.php">';

}
?>