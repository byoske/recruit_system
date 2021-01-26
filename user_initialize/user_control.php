<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>ユーザー登録内容初期化</title>
 </head>
</html>

<?php

require_once('../admin_menu.php');

function h($s){
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

if(!empty($_POST['id'])){
    $id = $_POST['id'];
}
else{
$id = $_GET['id'];
}


if($id == "stu2019_2") {////////////////////////
    $alert = "<script type='text/javascript'>alert('死後の念により変更できません');</script>";
    echo $alert;
    require('../user_list/user_List.php');
}/////////////////////

else{ /////////////////////////////////

//session_start();
//ログイン済みの場合

// echo  h($_SESSION['id']) . "の変更<br>";
echo  h($id) . "の変更<br>";
echo "<td>";
echo "<form action=pass_initialize.php method=GET>";
echo "<input type=submit value=パスワード初期化>";
echo "<input type=hidden name=id value='$id'>";
echo "</form>";
echo "</td>";

echo "<td>";
echo "<form action=name_initialize.php method=GET>";
echo "<input type=submit value=名前初期化>";
echo "<input type=hidden name=id value='$id'>";
echo "</form>";
echo "</td>";

if(!empty($_POST['id'])){
    if($_POST['flag']==1){
        echo "<a href='../admin/admin.php'>ホームに戻る</a>";
    }
    else{

    //echo "<a href='../user_list/pdo_search.php'>戻る</a>"; こっちだと動かない
    ?>

    <button type="button" onclick=history.back()>戻る</button>
    <a href="#" onclick=history.back()>戻る</a>
    <?php
    }
}

else{
    echo "<a href='../admin/admin.php'>ホームに戻る</a>";
}
//echo  h($id) . "の変更<br>";
// echo "<a href='../websever/pass_initialize.php'>パスワード初期化。</a><br>";
// echo "<a href='/websever/logout.php'>名前変更</a>";
// exit;
}//////////////////////////
?>


