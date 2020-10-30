<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>就職報告</title>
 </head>
 <h1>就職活動実績報告画面</h1>

<body>
	<?php
        session_start();
        require_once('../config.php');
        require_once ('../style.php');
        require_once ('droplist.php');

        $id = $_SESSION['id'];
         try {
             $pdo = new PDO(DSN, DB_USER, DB_PASS);
             $stmt = $pdo->prepare('select * from USER where ID = ?');
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
             echo $e->getMessage() . PHP_EOL;
    }?>

	<form action="pdo_search.php" method="post">
    <div class="element_wrap">
    	<label for="i_Company">企業名</label>
    	<input id="i_Company" type="text" name="Company" value ="" placeholder="株式会社イケメン">
    </div>
 	<div class="element_wrap">
 		<label for="i_address">住所</label>
 		<input id="i_address" type="text" name ="address" value="" placeholder="東京都千代田区千代田１−１">
 	</div>
 	<div class="element_wrap">
 		<label for="i_tel">電話番号</label>
 		<input id="i_tel" type="tel" name="TEL" value ="" inputmode="tel" placeholder="080-1234-5678">
 	</div>
 	<div class="element_wrap">
 		<label for="i_date">日付</label>
 		<input id ="i_date" type="date" name="date" value="<?php echo date('Y年m月d日')?>">
 	</div>
 	<div class="element_wrap">
 		<label for="i_time">時間</label>
 		<?php $time1 = $time2 = $min1 = $min2 = 0;
 		for($i=0;$i <= 23; $i++)$time1 .='<option value="'.$i.'">'.$i.'</option>';
 		for($c=0;$c <= 55;$c += 5)$min1  .='<option value="'.$c.'">'.$c.'</option>';
 		?>
 		<select name = "time1"><?php echo $time1; ?></select>時
 		<select name = "min1" ><?php echo $min1;  ?></select>分～
		<select name = "time2"><?php echo $time1; ?></select>時
		<select name = "min2" ><?php echo $min1;  ?></select>分
 	</div>
 	<div class="element_wrap">
 		<label for="i_purpose">目的</label>
 		<?php $pur = $pur1 = $pur2 = 0;
 		for($i=1;$i <= 4;$i++)$pur .='<option value="'.$i.'">'.$purpose[$i].'</option>';
 		for($i=1;$i <= 4;$i++)$pur1 .='<option value="'.$i.'">'.$purpose[$i].'</option>';
 		for($i=1;$i <= 4;$i++)$pur2 .='<option value="'.$i.'">'.$purpose[$i].'</option>';
 		?>
        <select name = "pur1" ><?php echo $pur; ?></select>
        <select name = "pur2"><?php echo $pur1; ?></select>
        <select name = "pur3"><?php echo $pur2; ?></select>

 	</div>
 	<div class="element_wrap">
 		<label for="i_status">採用状況</label>
 		<?php $stat = 0;
 		for($i=1;$i <= 6;$i++)$stat .='<option value="'.$i.'">'.$status[$i].'</option>';
 		?>
 		<select name = "stat" ><?php echo $stat; ?></select>
 	</div>

	<div class="element_wrap">
		<label for="i_contents">実施内容</label>
		<textarea required name = "Contents" rows="10"  placeholder="説明された内容、試験・面接内容など記載"></textarea>
	</div>
	<div class="element_wrap">
		<label for="i_schedule">今後のスケジュール</label>
		<textarea required rows = "10"name = "Schedule"  placeholder="この後の採用試験、採用試験の結果通知の日程等を記載"></textarea>
	</div>
	<div class="element_wrap">
		<label for="i_remarks">備考</label>
		<textarea required rows = "10" name = "Remarks" placeholder="入社への意向など特記事項"></textarea>
	</div>

	<INPUT type="reset" name="reset" value="入力内容をリセットする">
    <input type="submit"name="btn_confirm" value="入力内容を確認する">
    <p><a href="../user/user.php" style=mmargin:center>戻る</a></p>

</body>
</html>


