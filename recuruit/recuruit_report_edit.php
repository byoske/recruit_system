<?php
    //合格不合格のリザルトに入る値の処理
    session_start();
    require_once('../config.php');
    require_once ('droplist.php');
    require_once ('../style.php');

    $id = $_SESSION['id'];

    try {
        $pdo = new PDO(DSN, DB_USER, DB_PASS);
        $stmt = $pdo->prepare('UPDATE REPORT SET RESULT = ?  WHERE ID = ? AND COMPANY = ?');
        if(!empty($_POST['pass'])){//合格ボタンを押されたら
            $pass = $_POST['pass_1'];
            $pass_1 = $_POST['pass'];
            $stmt->execute([$pass_1,$id,$pass]);
            echo "情報を更新しました";
            echo '<meta http-equiv="refresh" content=" 2; url=recuruit_report_top.php">';
            echo "<a href='recuruit_report_top.php'>次へ</a>";
            require_once ("mail.php");
            exit;
        }else if(!empty($_POST['failure'])){//不合格ボタンを押されたら
            $failure=$_POST['failure_1'];
            $failure_1 =$_POST['failure'];
            $stmt->execute([$failure_1,$id,$failure]);
            echo "情報を更新しました";
            echo '<meta http-equiv="refresh" content=" 2; url=recuruit_report_top.php">';
            echo "<a href='recuruit_report_top.php'>次へ</a>";
            require_once ("mail.php");
            exit;
        }
    } catch (\Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }




?>
<?php



    $code = $_GET['code'];//活動中、活動実績のリンクを押した際に送信されるcodeを取得
    $flg =  $_GET['flg'];//活動中からのリンクか判別するための変数
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
<div>

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

               <?php if($flg == 1){?>
               		<div class="element_wrap">
                    <label>実施内容</label>
                    <p><?php echo $contents; ?></p>

              		</div>

         	 	     <div class="element_wrap">
                    <label>今後のスケジュール</label>
                    <p><?php echo $schedule; ?></p>
            	    </div>

              		<div class="element_wrap">
                    <label>備考</label>
                    <p><?php echo $remarks; ?></p>
               		</div>
              	<?php }?>
            </div>

	<?php  if($flg == 0){ ?>
	<form action="confirm.php" method="post">

	<!--  //////////confirmにて内容確認のために必要なものの定義///////////////-->
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
	<textarea required name = "Contents" rows="10"   placeholder="説明された内容、試験・面接内容など記載"><?php if(!empty($_GET['Edit'])) echo $row['CONTENTS']; ?></textarea>
	</div>
	<div class="element_wrap">
	<label for="i_schedule">今後のスケジュール</label>
	<textarea required rows = "10"name = "Schedule"   placeholder="この後の採用試験、採用試験の結果通知の日程等を記載"><?php if(!empty($_GET['Edit'])) echo $row['SCHEDULE']; ?></textarea>
	</div>
	<div class="element_wrap">
	<label for="i_remarks">備考</label>
	<textarea required rows = "10" name = "Remarks"  placeholder="入社への意向など特記事項"><?php if(!empty($_GET['Edit'])) echo $row['REMARKS']; ?></textarea>
	</div>



				<INPUT type="reset" name="reset" value="入力内容をリセットする">
 	  		    <input type="submit"name="btn_confirm" value="入力内容を確認する">


	 </form>

	<?php }else if($row['RESULT'] == null ){//リザルトの中に何も入っていなかったら表示、活動実績からのリンク?>

				<?php $_SESSION['code'] = $code;
				if($contents != null){
				?>
				<a href = "recuruit_report.php?code=<?php echo $code?>" >
				<input type="hidden" name="pass" value="1">
				<input type="hidden" name="flg" value=<?php echo $flg?>>

				<input name="btn_confirm"type = "submit" value = "次の選考"style="width:10%;" >
				</a>

				<form action="recuruit_report_edit.php" method="post"><!合格ボタンを押した際の処理 上に飛ぶ>
				<input type="hidden" name="pass_1" value="<?php echo $company;?>" ><br><br>
				<input type="submit" name="pass" value="内定"style="width:10%;">
				</form>
				<form action="recuruit_report_edit.php" method="post"><!不合格ボタンをした際の処理　上に飛ぶ>
				<input type="hidden" name="failure_1" value="<?php echo $company;?>" >
				<input type="submit" name="failure" value="選考落ち"style="width:10%;">
				</form>

		<?php }
    }else if($row['RESULT'] != null ){
        ?><a href = "../recuruit/recuruit_report_edit.php?Edit=1&code=<?php echo $code;?>&flg=0" class="button" >編集</a></br><?php
    $statement = $pdo->prepare("SELECT * FROM REPORT WHERE ID = ? AND COMPANY = ? ORDER BY CODE ASC ");
    $statement-> execute([$id,$company]);
    if($statement){
        if($statement->execute()){
            //レコード件数取得
            $row_count = $statement->rowCount();

            while($row = $statement->fetch()){
                $rows[] = $row;
            }
            $code2 = array_column($rows,'CODE');
        }
        //前へ戻る処理
        $i = 0;$b = 0;$c = $row_count -1;
        while($c >= 0){
            if($code > $code2[$c] && $b <= 0){$b++;
            ?><a href = "recuruit_report_edit.php?code=<?php echo $code2[$c];?>&flg=1">前へ</a><?php
                        }
                         $c--;
                    }

                  $c = 0;
                   //次へ行く処理
                    while($c <= $row_count -1){
                         if($code < $code2[$c] && $i <= 0){$i++;
                             ?><a href = "recuruit_report_edit.php?code=<?php echo $code2[$c];?>&flg=1">次へ</a><?php
                         }
                         $c++;
                    }


             //echo '<br>',"<a href='#' onclick=history.back()>戻る</a>";

         }
         }?>
<br>
<a href= "../recuruit/recuruit_report_top.php">一覧に戻る</a>
</body>
</script>
</html>


