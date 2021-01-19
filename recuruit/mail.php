<?php
$id = $_SESSION['id'];
$code = $_SESSION['code'];
$name = $_SESSION['name'];
$Company =$_SESSION['Company'];
mb_language("Japanese");
mb_internal_encoding("UTF-8");

try {
    $dbh = new PDO(DSN, DB_USER, DB_PASS);
    $stmt = ("SELECT * FROM `user` WHERE ID IN('admin')");
    $stm = $dbh->query($stmt);
    $row = $stm->fetch(PDO::FETCH_ASSOC);

} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}


$to = $row['MAIL'];

//$subject = $id."の就職活動報告が更新されました";
$subject = "【就職活動報告】".$name."（企業名：".$Company."）";


$message = "管理人者様

下記URLよりご確認ください。

https://192.168.10.160/recruit_system/recuruit/company_details.php?code=".$code."&name=".urlencode($name)."&id=".$id;

$headers = $id."@nagoya-vti.ac.jp";


if(mb_send_mail($to, $subject, $message,"From:$headers")){
    echo "送信完了";
    echo '</br>';
    echo "担当の指導員に口頭で更新を伝えてください",'</br>';
}else{
    echo "送信失敗";
}
echo '<a href = "recuruit_report_top.php">戻る</a>';
?>
