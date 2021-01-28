 <!DOCTYPE html>


 <html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>Login</title>
   <style>

   form dl dt{
  width: 100px;
  padding:5px 0;
  float:left;
  clear:both;
}

form dl dd{
  padding:5px 0;
}

   </style>
 </head>
 <body>


 <?php
 session_start();
 require_once('../config.php');
 require_once('../user_menu.php');

 $id = $_SESSION['id'];
 try {
     $pdo = new PDO(DSN, DB_USER, DB_PASS);
     $stmt = $pdo->prepare('select * from USER where ID = ?');
     $stmt->execute([$id]);
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
 } catch (\Exception $e) {
     echo $e->getMessage() . PHP_EOL;
 }
 /* ------ adminの場合 ------*/
 if($id == "admin") {
     if(isset($_POST['yes'])){
         if(empty($_POST['name2']) ) {
             echo "名前を入力してください。";
             echo "</br>";
             echo "<a href ='../user_Setting/Name_change_H.php'>戻る";
             exit;
         }
         else {?>

         <?php if($_POST['name2'] == $_POST['name']){ ?>
     	<h1>お名前はこちらで本当によろしいですか？</h1><h1>>>><?= $_POST['name2'];?></h1>

     	<?php }else{
     	  echo "正しく名前を入力してください。";
     	  echo "</br>";
     	  echo "<a href='../user_Setting/Name_change_H.php'>戻る";
     	  exit;}
     	?>

      	<form action = "../user_Setting/Name_change_H.php" style="display: inline">
	    <input type="submit" value="いいえ">
	    </form>
      	<form action="change_Name.php" method="post" style="display: inline">
        <input type="hidden" name="name" value="<?= $_POST['name'];?>">
    	<input type="hidden" name="name2" value="<?= $_POST['name2'];?>">
    	<input type="submit" name="yes" value="はい">
    	</form></br></br>
    	<?php
    	exit;
    	?>

	<?php }}else{?>
		<body>
  	 	<h1>名前変更</h1>
   		<form action="Name_change_H.php" method="post">
   		<dl>
		<dt>名前入力</dt>
    	<dd><input type="text" name="name" size="50" onInput="checkForm(this)"></dd>
    	<dt>名前再入力</dt>
    	<dd><input type="text" name="name2" size="50" onInput="checkForm(this)"></dd>
    	<input type="submit"  name="yes" value="登録">
   		</dl>
   		</form>
		</body>
	<?php
    }
    echo "<a href='../admin/admin.php'>ホームに戻る";
 }
 /* ------ userの場合 ------*/

 else{
   if($row['NAME'] == "none"){
      if(isset($_POST['yes'])){
          if(empty($_POST['name2']) ) {
             echo "名前を入力してください。";
             echo "</br>";
             echo "<a href='../user_Setting/Name_change_H.php'>戻る";
             exit;
         }
         else {?>

         <?php if($_POST['name2'] == $_POST['name']){ ?>


       	<h1>お名前はこちらで本当によろしいですか？</h1><h1>>>><?= $_POST['name2'];?></h1>
      	<p>※名前変更は一度のみのため間違えのないようにしてください。</p>

      	 <?php }else{
	       echo "正しく名前を入力してください。";
	       echo "</br>";
	       echo "<a href='../user_Setting/Name_change_H.php'>戻る";
	       exit;}
	     ?>

      	<form action = "../user_Setting/Name_change_H.php" style="display: inline">
	    <input type="submit" value="いいえ">
	    </form>
      	<form action="change_Name.php" method="post" style="display: inline">
        <input type="hidden" name="name" value="<?= $_POST['name'];?>">
    	<input type="hidden" name="name2" value="<?= $_POST['name2'];?>">
    	<input type="submit" name="yes" value="はい">
    	</form></br></br>
    	<?php
    	exit;
    	?>



	<?php }}else{?>
		<body>
  	 	<h1>名前変更</h1>
   		<form action="Name_change_H.php" method="post">
   		<dl>
		<dt>名前入力</dt>
    	<dd><input type="text" name="name" size="50" onInput="checkForm(this)"></dd>
    	<dt>名前再入力</dt>
    	<dd><input type="text" name="name2" size="50"  onInput="checkForm(this)"></dd>
    	<input type="submit"  name="yes" value="登録">
    	<p>※名前変更は一度のみのため間違えのないよう入力してください。</p>
   		</dl>
   		</form>
		</body>

    <?php }
        }else if($row['NAME'] != 'none'){
            /* ---- 追加 ----- */
            if($id != "admin") {?>
            	  既に変更済みです。変更が必要な場合は管理者まで連絡ください。
            	  <br>
          <?php }
        }
        echo "<a href='../user/user.php'>ホームに戻る";
 }?>

</html>
   <script type="text/javascript">
   <!--
   function checkForm($this) {
       var str=$this.value;
       while(str.match(/[A-Z a-z\d]/)) {
           str=str.replace(/[A-Z a-z\d]/,"");
       }
       $this.value=str;
   }
   //-->
   </script>

