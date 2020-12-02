<!DOCTYPE html>
<html lang="ja">
 <head>
 <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
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
    }


    ?>

	<form action="confirm.php" method="post">
     <div class="element_wrap">
    	<label for="i_Company">企業名</label>
    	<input required id="i_Company" type="text" name="company" value ="" placeholder="株式会社イケメン"><br>

    	<label for="i_Company">フリガナ</label>
    	<input required id="i_Company" type="text" name="company2" value ="" placeholder="カブシキガイシャイケメン">
    </div>

 	<div class="element_wrap">
 		<label for="i_address">住所</label>
 		<input required  type="text" name ="address" value="" placeholder="東京都千代田区千代田１−１">
 	</div>

 	<div class="element_wrap">
 		<label for="i_tel">電話番号</label>
 		<input required id="i_tel" type="tel" name="tel"  value ="" placeholder="080-1234-5678">
 	</div>

 	<div class="element_wrap">
 		<label for="i_date">日付</label>
 		<input required id ="i_date" type="date" name="date" value="">
 	</div>

 	<div class="element_wrap">
 		<label for="i_time">時間</label>
 		<?php $time1 = $min1  = 0;
 		for($i=0;$i <= 23; $i++)$time1 .='<option value="'.$i.'">'.$i.'</option>';
 		for($c=0;$c <= 55;$c += 5)$min1  .='<option value="'.$c.'">'.$c.'</option>';
 		?>
 		<select name = "hour1"><?php echo $time1; ?></select>時
 		<select name = "min1" ><?php echo $min1;  ?></select>分～
		<select name = "hour2"><?php echo $time1; ?></select>時
		<select name = "min2" ><?php echo $min1;  ?></select>分
 	</div>

 	<div class="element_wrap">
 		<label for="i_purpose">目的</label>
 		<?php $pur =$pur1 = 0;
 		for($i=1;$i <= 4;$i++)$pur .='<option value="'.$i.'">'.$purpose[$i].'</option>';
        ?>
        <select name = "purpose1" ><?php echo $pur; ?></select>
        <select name = "purpose2"><?php echo $pur; ?></select>
        <select name = "purpose3"><?php echo $pur; ?></select>
 	</div>


		<input type="hidden" name="Contents" value= "NULL" >


	<INPUT type="reset" name="reset" value="入力内容をリセットする">
    <input type="submit"name="btn_confirm" value="入力内容を確認する">

	</form>

</body>
</html>


