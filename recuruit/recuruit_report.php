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
        $id = $_SESSION['id'];
         try {
             $pdo = new PDO(DSN, DB_USER, DB_PASS);
             $stmt = $pdo->prepare('select * from USER where ID = ?');
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
             echo $e->getMessage() . PHP_EOL;
    }
       if(isset($_POST['reset'])){
        unset( $_SESSION['Company']);
        unset($_SESSION['address_re']);
        unset($_SESSION['tel']);
        unset($_SESSION['date']);
        unset($_SESSION['taime1']);
        unset($_SESSION['taime2'] );
        unset($_SESSION['min1']);
        unset($_SESSION['min2']);
        unset($_SESSION['pur1']);
        unset($_SESSION['pur2']);
        unset($_SESSION['pur3']);
        unset($_SESSION['stat']) ;
        unset($_SESSION['Contents']);
        unset($_SESSION['Schedule'] );
        unset($_SESSION['Remarks']);

    }
    ?>

	<form action="confirm.php" method="post">
    <div class="element_wrap">
    	<label for="i_Company">企業名</label>
    	<input required id="i_Company" type="text" name="Company" value ="<?php if( !empty($_SESSION['Company']) ){ echo $_SESSION['Company']; } ?>" placeholder="株式会社イケメン">
    </div>
 	<div class="element_wrap">
 		<label for="i_address">住所</label>
 		<input required  type="text" name ="address_re" value="<?php if( !empty($_SESSION['address_re']) ){ echo $_SESSION['address_re']; } ?>" placeholder="東京都千代田区千代田１−１">
 	</div>
 	<div class="element_wrap">
 		<label for="i_tel">電話番号</label>
 		<input required id="i_tel" type="tel" name="TEL"  value ="<?php if( !empty($_SESSION['TEL']) ){ echo $_SESSION['TEL']; } ?>" placeholder="080-1234-5678">
 	</div>
 	<div class="element_wrap">
 		<label for="i_date">日付</label>
 		<input required id ="i_date" type="date" name="date" value="<?php if( !empty($_SESSION['date']) ){ echo $_SESSION['date']; } ?>">
 	</div>
 	<div class="element_wrap">
 		<label for="i_time">時間</label>
 		<?php $time1 = $min1  = 0;
 		for($i=1;$i <= 24; $i++)$time1 .='<option value="'.$i.'">'.$i.'</option>';
 		for($c=0;$c <= 55;$c += 5)$min1  .='<option value="'.$c.'">'.$c.'</option>';
 		?>
 		<select name = "time1"><?php echo $time1; ?></select>時
 		<select name = "min1" ><?php echo $min1;  ?></select>分～
		<select name = "time2"><?php echo $time1; ?></select>時
		<select name = "min2" ><?php echo $min1;  ?></select>分
 	</div>
 	<div class="element_wrap">
 		<label for="i_purpose">目的</label>
 		<?php $pur =$pur1 = 0;
 		for($i=4;$i >= 1;$i--)$pur .='<option value="'.$i.'">'.$purpose[$i].'</option>';
        ?>
        <select name = "pur" ><?php echo $pur; ?></select>and
        <select name = "pur2"><?php echo $pur; ?></select>and
        <select name = "pur3"><?php echo $pur; ?></select>
 	</div>
 	<div class="element_wrap">
 		<label for="i_status">採用状況</label>
 		<?php $stat = 0;
 		for($i=1;$i <= 6;$i++)$stat .='<option value="'.$i.'">'.$status[$i].'</option>';
 		?>
 		<select  name = "stat" ><?php echo $stat; ?></select>
 	</div>
	<div class="element_wrap">
		<label for="i_contents">実施内容</label>
		<textarea  name = "Contents" rows="10" value="<?php if( !empty($_SESSION['Contents']) ){ echo $_SESSION['Contents']; } ?>" placeholder="説明された内容、試験・面接内容など記載"></textarea>
	</div>
	<div class="element_wrap">
		<label for="i_schedule">今後のスケジュール</label>
		<textarea  rows = "10"name = "Schedule" value="<?php if( !empty($_SESSION['Schedule']) ){ echo $_SESSION['Schedule']; } ?>" placeholder="この後の採用試験、採用試験の結果通知の日程等を記載"></textarea>
	</div>
	<div class="element_wrap">
		<label for="i_remarks">備考</label>
		<textarea  rows = "10" name = "Remarks" value="<?php if( !empty($_SESSION['Remarks']) ){ echo $_SESSION['Remarks']; } ?>"placeholder="入社への意向など特記事項"></textarea>
	</div>

    <input type="submit"name="btn_confirm" value="入力内容を確認する">
    </form >
	<form action="recuruit_report.php" method="post">
	<INPUT type="submit" name="reset" value="入力内容をリセットする">
	</form>

</body>
</html>


