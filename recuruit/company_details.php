<?php
//$val = $_GET['code'];
//echo "企業のコードは ".$val;


session_start();
require_once('../config.php');
require_once('../user_menu.php');
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

$user_id = $row['ID'];          //adminだけ表示させる
$user_name = $row['NAME'];      //adminだけ表示させる
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

$user_name = $user_name. "(" . $user_id.")";    //名前（id)が入っている


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





    <p></p>

      <a href= "../recuruit/company_list.php">topへ戻る</a>
	 </form>


</body>
</script>
</html>


