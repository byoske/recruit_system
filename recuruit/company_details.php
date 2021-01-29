<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
<?php
session_start();
require_once('../config.php');
require_once('../user_menu.php');
require_once ('droplist.php');
require_once ('../style.php');


try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $stmt = $pdo->prepare('UPDATE REPORT SET RESULT = ?  WHERE ID = ? AND COMPANY = ?');
    if(!empty($_POST['pass'])){//合格ボタンを押されたら
        ?>
<title> 選考状況更新</title>
<?php
        $pass = $_POST['pass_1'];
        $pass_1 = $_POST['pass'];
        $name = $_POST['name'];
        $id = $_POST['id'];
        $stmt->execute([$pass_1,$id,$pass]);
        echo "情報を更新しました";
        echo "<a href='recuruit_report_top.php?id=".$id."&name=".$name."&list_flag=1 '>次へ</a>";
        exit;
    }else if(!empty($_POST['failure'])){//不合格ボタンを押されたら
        ?>
<title> 選考状況更新</title>
<?php
        $failure=$_POST['failure_1'];
        $failure_1 =$_POST['failure'];
        $name = $_POST['name'];
        $id = $_POST['id'];
        $stmt->execute([$failure_1,$id,$failure]);
        echo "情報を更新しました";
        echo "<a href='recuruit_report_top.php?id=".$id."&name=".$name."&list_flag=1 '>次へ</a>";
        exit;
    }
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

////////////////////////////////////////////////////////////////////

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

$user_id = $row['ID'];          //adminだけ表示させる
$user_name = $row['NAME'];      //adminだけ表示させる
$company = $row['COMPANY'];
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
$_SESSION['Company'] = $row['COMPANY'];
$name = $user_name;
$user_name = $user_name. "(" . $user_id.")";    //名前（id)が入っている


//配列の値の入れ直し




// 送信ボタンが押されたら

?>




   <title><?php echo $company;?> - <?php if($contents == null){ ?>就職活動中報告画面<?php }else{?>就職活動実績報告画面<?php }?></title>

 </head>
 <h1>就職活動実績報告画面</h1>

<body>
	<?php

        $id = $_SESSION['id'];
       /*  try {
             $pdo = new PDO(DSN, DB_USER, DB_PASS);
             $stmt = $pdo->prepare('select * from USER where ID = ?');
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
             echo $e->getMessage() . PHP_EOL;
    }*/?>


<div>


                 <?php if(isset($_SESSION['id']) && $_SESSION['id'] == 'admin'){ ?>
                 <div class="element_wrap">
                    <label>名前</label>
                    <p><?php echo $user_name; ?></p>
                 </div>
				<?php }?>

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

					<?php if(empty($_GET['flg'])){?>

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
               		<?php }else if($_GET['flg'] == 0){?>
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
                	<?php }?>
            </div>

<?php if($_GET['name']==""){                //閲覧からの場合 ?>
      <a href= "../recuruit/company_list.php">一覧に戻る</a><br>
<?php }else{                                //メールからの場合
?>    <a href = "../recuruit/recuruit_report_top.php?name=<?php echo $_GET['name'];?>&id=<?php echo $_GET['id']?>"><?=htmlspecialchars("一覧",ENT_QUOTES,'UTF-8')?></a>
<?php
      }?>

	<?php ///////////////////////////////////先生側の内定不合格選択/////////////////////////////////////////////////
      if($contents == null  || $_SESSION['id'] != 'admin'){
            //何もしない
      }else if($row['RESULT'] == null ){//リザルトの中に何も入っていなかったら表示、活動実績からのリンク?>

				<?php $_SESSION['code'] = $code;?>

				<form action="company_details.php" method="post"><!--  合格ボタンを押した際の処理 上に飛ぶ -->
				<input type="hidden" name="pass_1" value="<?php echo $company;?>" ><br><br>
				<input type="hidden" name = name value="<?php echo $name?>">
				<input type="hidden" name = id value="<?php echo $user_id?>">
				<input type="submit" name="pass" value="内定"style="width:10%;">
				</form>
				<form action="company_details.php" method="post"><!-- 不合格ボタンをした際の処理　上に飛ぶ-->
				<input type="hidden" name="failure_1" value="<?php echo $company;?>" >
				<input type="hidden" name=name value="<?php echo $name?>">
				<input type = "hidden" name = id value="<?php echo $user_id?>">
				<input type="submit" name="failure" value="選考落ち"style="width:10%;">
				</form>
    <?php }?>



<?php  ///////////////////////////////////////前後移動/////////////////////////////////////////////////
      if($row['CONTENTS'] != NULL && $_SESSION['id'] === 'admin'){?>
          <a href = "../recuruit/company_details.php?Edit=1&code=<?php echo $code;?>&flg=0 &name=" class="button" >編集</a></br>
    <?php  }
      if($_GET['name']!=""){
      $statement = $pdo->prepare("SELECT * FROM REPORT WHERE ID = ? AND COMPANY = ? ORDER BY CODE ASC ");
    $statement-> execute([$user_id,$company]);
      }else{
          $statement = $pdo->prepare("SELECT * FROM REPORT WHERE  COMPANY = ? ORDER BY CODE ASC ");
          $statement-> execute([$company]);
      }
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
            if($_GET['name']==""){                  //nameが空白なら空白を送る
                if($code > $code2[$c] && $b <= 0){
                    $b++;
                    ?><a href = "company_details.php?code=<?php echo $code2[$c];?>&name=&id=">次へ</a><?php
                }
            $c--;
            }
            else{                                   //nameが値が入っていたらそのまま送る
                if($code > $code2[$c] && $b <= 0){
                    $b++;
                    ?><a href = "company_details.php?code=<?php echo $code2[$c];?>&name=<?php echo $_GET['name'];?> &id=<?php echo $_GET['id']?>">前へ</a><?php
                }
            $c--;
            }
        }
        $c = 0;
         //次へ行く処理
        while($c <= $row_count -1){
            if($_GET['name']==""){                  //nameが空白なら空白を送る
                if($code < $code2[$c] && $i <= 0){
                    $i++;
                    ?><a href = "company_details.php?code=<?php echo $code2[$c];?> &name=&id=">前へ</a><?php
                }
            $c++;
            }
            else{                                   //nameが値が入っていたらそのまま送る
                if($code < $code2[$c] && $i <= 0){
                    $i++;
                    ?><a href = "company_details.php?code=<?php echo $code2[$c];?> &name=<?php echo $_GET['name'];?> &id=<?php echo $_GET['id']?>">次へ</a><?php
                }
                $c++;
            }
        }




         }?>
</body>
</script>
</html>


