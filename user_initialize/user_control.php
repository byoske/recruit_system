<?php

require_once('../admin_menu.php');

function h($s){
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}
$id = $_POST['id'];
//session_start();
//ログイン済みの場合

// echo  h($_SESSION['id']) . "の変更<br>";
echo  h($id) . "の変更<br>";
echo "<td>";
echo "<form action=pass_initialize.php method=post>";
echo "<input type=submit value=パスワード初期化>";
echo "<input type=hidden name=id value='$id'>";
echo "</form>";
echo "</td>";

echo "<td>";
echo "<form action=name_initialize.php method=post>";
echo "<input type=submit value=名前初期化>";
echo "<input type=hidden name=id value='$id'>";
echo "</form>";
echo "</td>";

if($_POST['flag']==1){
    echo "<a href='../user_list/user_LIst.php'>戻る</a>";
}
else{

    //echo "<a href='../user_list/pdo_search.php'>戻る</a>"; こっちだと動かない
    ?>
    <!DOCTYPE html>
    <button type="button" onclick=history.back()>戻る</button>
    <?php
}

//echo  h($id) . "の変更<br>";
// echo "<a href='../websever/pass_initialize.php'>パスワード初期化。</a><br>";
// echo "<a href='/websever/logout.php'>名前変更</a>";
// exit;

?>


