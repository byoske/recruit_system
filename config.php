<?php
    define('DSN','mysql:host=localhost;dbname=recuruit');//mysqlのデータベースの名前(websever)
    define('DB_USER','root');//sqlサーバーのユーザーネーム
    define('DB_PASS','root');//ユーザーのパスワード、設定していないため空白

    $purpose = array(1 => "説明会",
                     2 => "筆記試験",
                     3 => "面接",
                     4 => "なし"
    );

    $status = array(
        1 => "1次",
        2 => "2次",
        3 => "3次",
        4 => "4次",
        5 => "内定",
        6 => "不採用"
    );
?>
<style>
a:hover{
    text-decoration:none;
    color:red;
}
</style>
<html>
<head><link rel="icon"  href="/Free_File.jpg"></head>

</html>