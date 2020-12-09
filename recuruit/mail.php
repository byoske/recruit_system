<?php
session_start();
$id = $_SESSION['id'];
mb_language("Japanese");
mb_internal_encoding("UTF-8");

$to = "stu2019_14@nagoya-vti.ac.jp";
$subject = $id."の就職活動報告が更新されました";
$message = $id."の就職活動報告が更新されました、サイトから確認をしてください
<これは自動更新です返信はされません>";
$headers = $id;


if(mb_send_mail($to, $subject, $message,"From:$headers")){
    echo "送信完了";
}else{
    echo "送信失敗";
}
echo '<a href = "recuruit_report_top.php">戻る</a>';
?>