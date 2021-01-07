<?php
require_once ('../admin_menu.php');
require_once('../config.php');
?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>ユーザー検索</title>
 </head>
 <h1>ユーザー検索</h1>
<head>
<title>検索画面</title>
<meta charset="utf-8">

</head>
<body>
	<a href='user_List.php'>ユーザー一覧</a><br><br>

	キーワード検索<br>
	<form action="pdo_search.php" method="get" style="display: inline">
	<input type="text" name="yourname" required="required">
	<input type="submit" value="表示"><br><br>
	</form>

<!--
	<form action="pdo_search.php" method="post" style="display: inline">
	<input type="text" name="yourname" required="required">
	<input type="submit" value="表示"><br><br>
	</form>
-->
</body>
<a href='../admin/admin.php'>ホームに戻る</a>
</html>




<!--
<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>ユーザー検索</title>
 </head>
 <h1>ユーザー検索</h1>
<head>
<title>検索画面</title>
<meta charset="utf-8">

<style>
  dl dt{
  width: 170px;
  padding:5px 0;
  float:left;
  clear:both;
}
dl dd{
  padding:5px 0;
}
</style>

</head>
<body>
<dl>
	<dt>ユーザー一覧</dt>
	<form action="user_LIst.php" style="display: inline">
	<input type="submit" value="表示">
	</form><br><br>

	キーワード検索<br>
	<form action="pdo_search.php" method="post" style="display: inline">
	<dt><input type="text" name="yourname"></dt>
	<input type="submit" value="表示"><br>
	</form>
</dl>
</body>
<a href='../admin/admin.php'>戻る</a>
</html>

-->


<!--

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>ユーザー検索</title>
 </head>
 <h1>ユーザー検索</h1>
<head>
<title>検索画面</title>
<meta charset="utf-8">

</head>
<ul>
<body>
	<li>ユーザー一覧
	<form action="user_LIst.php" style="display: inline">
	<input type="submit" value="表示">
	</form></br>
</body>

<body>
	<li>キーワード検索
	<form action="pdo_search.php" method="post" style="display: inline">
	<input type="text" name="yourname">
	<input type="submit" value="表示"></br>
	</form>
</body>
</ul>
<a href='../admin/admin.php'>戻る</a>
</html>

 -->

<!--
 <body>
	<?php
	echo '</br>';
    echo '<li>入校年度検索';
    $year  = 0;
    for ($i=2019; $i <= 2100; $i++) {
    		$year .= '<option value="'.$i.'">'.$i.'</option>';
    }

    echo '<form action="pdo_search.php" method="post" style="display: inline">
    <select name="yourname">'.$year.'</select>
    <h>年度</h>
    <input type="submit"name="submit"value="表示"/></br>
    </form >' ?>

</body>
-->



