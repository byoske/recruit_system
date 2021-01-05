<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>ユーザー一括登録</title>
 </head>
 <body>
	<?php
	require_once('../admin_menu.php');
	require_once('../config.php');

    echo "<h1>ユーザー登録</h1>";
    $year = $month = $day = 0;
    for ($i=2019; $i <= 2100; $i++) {
    		$year .= '<option value="'.$i.'">stu'.$i.'_</option>';
    }
    for ($i=1; $i <= 35; $i++) {
    		$month .= '<option value="'.$i.'">'.$i.'</option>';
    }
    for ($i=1; $i <= 35; $i++) {
    		$day .= '<option value="'.$i.'">'.$i.'</option>';
    }

    echo '<form action="signUp.php" method="post">
    <select name="year">'.$year.'</select>
    <select name="month">'.$month.'</select>
    <h>番～</h>
    <select name="day">'.$day.'</select>
    <h>番</h>
    <input type="submit"name="submit"value="登録"/></br>
    </form ></br>' ?>

	<a href='../admin/admin.php'>ホームに戻る</a>
</body>
</html>
