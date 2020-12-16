<?php

session_start();
require_once('../config.php');
require_once ('droplist.php');
require_once ('../style.php');
$id = $_SESSION['id'];
try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $stmt = $pdo->prepare('select * from USER where ID = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

// フォームから送信されたデータを各変数に格納

$name = $row['NAME'];
$_SESSION['Company'] = $_POST['company'];
$_SESSION['Company2'] = $_POST['company2'];
$_SESSION['address_re'] = $_POST['address'];
$_SESSION['tel'] = $_POST['tel'];
$_SESSION['date'] = $_POST['date'];
$_SESSION['taime1'] = $_POST['hour1'];
$_SESSION['taime2'] = $_POST['hour2'];
$_SESSION['min1'] = $_POST['min1'];
$_SESSION['min2'] = $_POST['min2'];
if($_POST["Contents"] == "NULL"){//新規作成
    if(!empty($_POST['code'])){
        $_SESSION['code2'] = $_POST['code'];
    }else{
        $_SESSION['code2'] = null;
    }
    $_SESSION['pur1'] = $purpose[$_POST['purpose1']];
    $_SESSION['pur2'] = $purpose[$_POST['purpose2']];
    $_SESSION['pur3'] = $purpose[$_POST['purpose3']];
    $_SESSION['Contents']  = null;
    $_SESSION['Schedule']  = null;
    $_SESSION['Remarks'] = null;
}
if($_POST["Contents"] != "NULL"){//実施内容等編集
    $_SESSION['code'] = $_POST['code'];
    $_SESSION['pur1'] = $_POST['purpose1'];
    $_SESSION['pur2'] = $_POST['purpose2'];
    $_SESSION['pur3'] = $_POST['purpose3'];
    $_SESSION['Contents']  = $_POST["Contents"];
    $_SESSION['Schedule']  = $_POST["Schedule"];
    $_SESSION['Remarks'] = $_POST["Remarks"];
}
//配列の値の入れ直し




// 送信ボタンが押されたら

?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>内容確認</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div>
    <form action="recuruit_send.php" method="post">
            <input type="hidden" name="name" value="<?php echo $name; ?>">



            <p>内容はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
            <div>
               <div class="element_wrap">
                    <label>お名前</label>
                    <p><?php echo $name; ?></p>
                </div>
                <div class="element_wrap">
                    <label>企業名</label>
                    <p><?php echo $_SESSION['Company']; ?></p></br>
                    <label>フリガナ</label>
                    <p><?php echo $_SESSION['Company2']; ?></p>
                </div>
                 <div class="element_wrap">
                    <label>住所</label>
                    <p><?php echo $_SESSION['address_re']; ?></p>
                </div>
                 <div class="element_wrap">
                    <label>電話番号</label>
                    <p><?php echo $_SESSION['tel']; ?></p>
                </div>
                <div class="element_wrap">
                    <label>日付</label>
                    <p><?php echo $_SESSION['date']; ?></p>
                </div>
                <div class="element_wrap">
                    <label>時間</label>
                    <p><?php echo  $_SESSION['taime1'].'時'. $_SESSION['min1'].'分～'. $_SESSION['taime2'].'時'. $_SESSION['min2'].'分'; ?>
                </div>
                <div class="element_wrap">
                    <label>目的</label>
                    <p><?php echo  $_SESSION['pur1']."　　". $_SESSION['pur2']."　　". $_SESSION['pur3']; ?></p>
                </div>

                <?php if($_POST["Contents"] != "NULL"){?>
                <div class="element_wrap">
                    <label>実施内容</label>
                    <p><?php echo nl2br( $_SESSION['Contents']); ?></p>
                </div>
                <div class="element_wrap">
                    <label>今後のスケジュール</label>
                    <p><?php echo nl2br( $_SESSION['Schedule']); ?></p>
                </div>
                <div class="element_wrap">
                    <label>備考</label>
                    <p><?php echo nl2br( $_SESSION['Remarks']); ?></p>
                </div><?php }?>
            </div>
        <input type="button" name = "back"value="内容を修正する" onclick="history.back()">
        <button type="submit" name="submit">送信する</button>
    </form>
</div>
</body>
</html>