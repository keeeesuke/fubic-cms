<?php
//各ファイルの先頭に記入する。DBに接続する
//require('dbconnect.php');

try {

    //DBへの接続
    $db=new PDO('mysql:dbname=test; host=localhost; charset=utf8', 'root', 'root');
    // echo '①接続完了しました';
    // echo '<br>';

} catch(PDOException $e) {
    echo 'DB error' . $e->getMessage();
}

?>