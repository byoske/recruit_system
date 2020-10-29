<?php
require_once('../admin_menu.php');
require_once('../config.php');
//データベースへ接続、テーブルがない場合は作成
//$pdo->exec("create table if not exists userDetaでテーブル作成(存在しない場合)
try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("create table if not exists USER(
      ID varchar(255),
      NAME varchar(255),
      MAIL varchar(255),
      PASSWORD varchar(255),
      CREATED timestamp not null default current_timestamp
    )");
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
//POSTのValidate。
//id int not null auto_increment primary key,

$year = 'stu'.$_POST['year'].'_';
$id = $_POST['month'];
$id2 = $_POST['day'];
$name = 'none';

$password = password_hash('password', PASSWORD_DEFAULT);

//登録処理
for($id; $id <= $id2 ;$id++){
    try {
         $stmt = $pdo->prepare("insert into user(ID,NAME,MAIL,PASSWORD) value(?, ?, ?, ?)");
         $stmt->execute([$year.$id, $name ,$year.$id.'@nagoya-vti.ac.jp',  $password]);
         echo $year.$id."登録完了</br>";
    } catch (\Exception $e) {
        echo  $year.$id.'は登録済みのidです。</br>';
    }
}
echo "<a href='../admin/admin.php'>次へ</a>";
