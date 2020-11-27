<?php
require_once('../config.php');
require_once ('droplist.php');

try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("create table if not exists REPORT(
        CODE INT PRIMARY KEY AUTO_INCREMENT,
        ID varchar(255),
        NAME varchar(255),
        COMPANY varchar(255),
        COMPANY2 varchar(255),
        ADDRESS varchar(255),
        TEL varchar(100),
        DATE varchar(255),
        HOUR1 int(100),
        MIN1 int(100),
        HOUR2 int(100),
        MIN2 int(100),
        PURPOSE1 varchar(255),
        PURPOSE2 varchar(255),
        PURPOSE3 varchar(255),
        CONTENTS text(255),
        SCHEDULE text(255),
        REMARKS text(255)

      )");
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

/*
 try {
 $pdo = new PDO(DSN, DB_USER, DB_PASS);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $pdo->exec("create table if not exists REPORT(
 ID varchar(255),
 NAME varchar(255),
 COMPANY varchar(255),
 ADDRESS varchar(255),
 TEL int(100),
 DATE date(100),
 TIME int(100),
 PURPOSE varchar(255),
 CONTENTS text(255),
 SCHEDULE text(255),
 REMARKS text(255)

 )");
 } catch (Exception $e) {
 echo $e->getMessage() . PHP_EOL;
 }
 */

/*
 try {
 $pdo = new PDO(DSN, DB_USER, DB_PASS);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $pdo->exec("create table if not exists REPORT(
 ID varchar(255),
 NAME varchar(255)
 )");
 } catch (Exception $e) {
 echo $e->getMessage() . PHP_EOL;
 }
 */


session_start();
/*
 $id = $_SESSION['id'];
 $name = $_SESSION['name'];
 $Company = $_POST['Company'];
 $Company2 = $_POST['Company2'];
 $address = $_POST['address'];
 $tel = $_POST['TEL'];
 $date = $_POST['date'];
 $hour1 = $_POST['hour1'];
 $min1 = $_POST['min1'];
 $hour2 = $_POST['hour2'];
 $min2 = $_POST['min2'];


 $pur1 = $purpose[$_POST['pur1']];
 $pur2 = $purpose[$_POST['pur2']];
 $pur3 = $purpose[$_POST['pur3']];
 */

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$Company =$_SESSION['Company'];
$Company2 = $_SESSION['Company2'];
$address =$_SESSION['address_re'];
$tel = $_SESSION['tel'];
$date =$_SESSION['date'];
$hour1 = $_SESSION['taime1'];
$hour2 =$_SESSION['taime2'];
$min1 =$_SESSION['min1'];
$min2 =$_SESSION['min2'];
$pur1 =$_SESSION['pur1'];
$pur2 = $_SESSION['pur2'];
$pur3 = $_SESSION['pur3'];
// $_SESSION['stat'] = $status[$_POST['stat']];



/*
 $pur1 = $_POST['pur1'];
 $pur2 = $_POST['pur2'];
 $pur3 = $_POST['pur3'];
 */

//$stat = $_POST['stat'];

if($pur1 == "選択")$pur1 = NULL;
if($pur2 == "選択")$pur2 = NULL;
if($pur3 == "選択")$pur3 = NULL;

try {
    $stmt = $pdo->prepare("insert into report(ID,NAME,COMPANY,COMPANY2,ADDRESS,TEL,DATE,HOUR1,MIN1,HOUR2,MIN2,PURPOSE1,PURPOSE2,PURPOSE3) value(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$id, $name, $Company, $Company2, $address, $tel, $date, $hour1, $min1, $hour2, $min2, $pur1, $pur2, $pur3]);
} catch (\Exception $e) {
    echo  '再入力してください。</br>';
}

echo "<a href='../user/user.php'>次へ</a>";

/*
 try {
 $stmt = $pdo->prepare("insert into report(ID,NAME) value( ?, ?)");
 $stmt->execute([$id, $name]);
 } catch (\Exception $e) {
 echo  '再入力してください。</br>';
 }

 echo "<a href='../user/user.php'>次へ</a>";
 */
