<?php

    session_start();
    require_once('../config.php');
    require_once ('droplist.php');
    require_once ('../style.php');
    $code = $_GET['code'];
    try {
        $pdo = new PDO(DSN, DB_USER, DB_PASS);
        $stmt = $pdo->prepare('select * from REPORT where CODE = ?');
        $stmt->execute([$code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }

        // フォームから送信されたデータを各変数に格納

        $company = $row['COMPANY'];
        $company2 = $row['COMPANY2'];
        $address = $row['ADDRESS'];
        $tel = $row['TEL'];
        $date = $row['DATE'];
        $hour1 = $row['HOUR1'];
        $min1 = $row['MIN1'];
        $hour2 = $row['HOUR2'];
        $min2 = $row['MIN2'];
        $purpose1 = $row['PURPOSE1'];
        $purpose2 = $row['PURPOSE2'];
        $purpose3 = $row['PURPOSE3'];
        $contents = $row['CONTENTS'];
        $schedule = $row['SCHEDULE'];
        $remarks = $row['REMARKS'];


        //配列の値の入れ直し




    // 送信ボタンが押されたら

?>


<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>就職報告</title>
 </head>
 <h1>就職活動実績報告画面</h1>

<body>
	<?php
//        session_start();
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


<div>
                <?php echo $code; ?>
               <div class="element_wrap">
                    <label>企業名</label>
                    <p><?php echo $company; ?></p>
               </div>

               <div class="element_wrap">
                    <label>住所</label>
                    <p><?php echo $address; ?></p>
               </div>

               <div class="element_wrap">
                    <label>電話番号</label>
                    <p><?php echo $tel; ?></p>
               </div>

               <div class="element_wrap">
                    <label>日付</label>
                    <p><?php echo $date; ?></p>
               </div>

               <div class="element_wrap">
                    <label>時間</label>
                    <p><?php echo $hour1; ?>時<?php echo $min1; ?>分～<?php echo $hour2; ?>時<?php echo $min2; ?>分</p>
               </div>

               <div class="element_wrap">
                    <label>目的</label>
                    <p><?php echo $purpose1; ?> <?php echo $purpose2; ?> <?php echo $purpose3; ?></p>
               </div>
            </div>

	<form action="confirm.php" method="post">


	<input type="hidden" name="company" value="<?php echo $company;?>" >
    <input type="hidden" name="company2" value= "<?php echo $company2;?>" >
	<input type="hidden" name="address" value= "<?php echo $address;?>" >
	<input type="hidden" name="tel" value= "<?php echo $tel;?>" >
	<input type="hidden" name="date" value= "<?php echo $date;?>" >
	<input type="hidden" name="hour1" value= "<?php echo $hour1;?>" >
    <input type="hidden" name="hour2" value= "<?php echo $hour2;?>" >
    <input type="hidden" name="min1" value= "<?php echo $min1;?>" >
    <input type="hidden" name="min2" value= "<?php echo $min2;?>" >
    <input type="hidden" name="purpose1" value= "<?php echo $purpose1;?>" >
    <input type="hidden" name="purpose2" value= "<?php echo $purpose2;?>" >
    <input type="hidden" name="purpose3" value= "<?php echo $purpose3;?>" >
	<input type="hidden" name="code" value= "<?php echo $code;?>" >


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
    <p><a href="../recuruit/recuruit_report_top.php" style=mmargin:center>戻る</a></p>
	 </form>

</body>
</html>


