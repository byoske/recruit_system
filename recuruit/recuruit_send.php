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
        REMARKS text(255),
        RESULT varchar(100)

      )");
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}


session_start();

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
$Contents = $_SESSION['Contents'];
$Schedule = $_SESSION['Schedule'];
$Remarks = $_SESSION['Remarks'];

if($pur1 == "選択")$pur1 = NULL;
if($pur2 == "選択")$pur2 = NULL;
if($pur3 == "選択")$pur3 = NULL;

//活動実績から新規追加をしたらここに入る
if(!empty($_SESSION['code2'])){
    if($_SESSION['code2'] != null){
        try {
            $code2 = $_SESSION['code2'];
            //$pdo = new PDO(DSN, DB_USER, DB_PASS);
            $stmt = $pdo->prepare('UPDATE REPORT SET RESULT = ?  WHERE CODE = ?');
            $stmt->execute(["選考中",$code2]);

        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }

    //require_once ("mail.php");

}

if($Contents == NULL){//新規作成の際のデータベースの登録内容
    if(empty($_SESSION['code2'])){
        try{

            $statement = $pdo->prepare("SELECT COUNT(*) FROM REPORT WHERE ID = ? AND COMPANY = ?");
            $statement->execute([$id,$Company]);
            $count = (int)$statement->fetchColumn();
            if($count != 0){
                echo "※すでに登録されている企業です
                                新規追加を作成したい場合は活動実績から行ってください";
                echo '<meta http-equiv="refresh" content=" 3; url=recuruit_report_top.php">';
                echo "<a href='recuruit_report_top.php'>次へ</a>";
                exit;
            }

        }catch(\Exception $e){
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit('Error: ' . $e->getMessage());
        }
    }
    try {
        $stmt = $pdo->prepare("insert into report(ID,NAME,COMPANY,COMPANY2,ADDRESS,TEL,DATE,HOUR1,MIN1,HOUR2,MIN2,PURPOSE1,PURPOSE2,PURPOSE3) value(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id, $name, $Company, $Company2, $address, $tel, $date, $hour1, $min1, $hour2, $min2, $pur1, $pur2, $pur3]);
        $stmt = ("SELECT * FROM REPORT ORDER BY CODE DESC LIMIT 1; ");
        $stm = $pdo->query($stmt);
        $row = $stm->fetch(PDO::FETCH_ASSOC);

        $_SESSION['code']= $row['CODE'];
       // require_once ("mail.php");

    } catch (\Exception $e) {
        echo  '再入力してください。</br>';
    }

}else{//活動中から実施内容など編集したら更新
    $code = $_SESSION['code'];
    try {
        $stmt = $pdo->prepare('UPDATE REPORT SET CONTENTS = ?, SCHEDULE = ? , REMARKS = ?  WHERE CODE = ?');
        $stmt->execute([$Contents, $Schedule,$Remarks,$code]);
        echo "情報を更新しました。";
    }catch(\Exception $e){
        echo $e->getMessage() . PHP_EOL;
    }

}

require_once ("mail.php");


