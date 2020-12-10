<?php

$id = $_SESSION['id'];
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
$subject = $id."の就職活動報告が更新されました";
$message = $id."の就職活動報告が更新されました、サイトから確認をしてください
<これは自動更新です返信はできません>";
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