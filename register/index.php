<?php
try {

    //DBへの接続
    $db=new PDO('mysql:dbname=test; host=localhost; charset=utf8', 'root', 'root');
    echo '①接続完了しました';
    echo '<br>';

} catch(PDOException $e) {
    echo 'DB error' . $e->getMessage();
}


session_start();
if(!empty($_POST)) {
    //error check
    if($_POST['usr_name'] == "") {
        $error['usr_name'] = "blank";
    }
    if($_POST['email'] == "") {
        $error['email'] = "blank";
    }
    if($_POST['pwd'] < 4) {
        $error['pwd'] = "length";
    }
    if($_POST['pwd'] == "") {
        $error['pwd'] = "blank";
    }

    if(empty($error)){
        $_SESSION['join'] = $_POST;
        header('Location: check.php');
        exit();
    }
 }

 echo zend_version();



?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新規登録</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../common.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>

<body>
    <header class="usr_bg">
        <div class="inner">
            <h1 class="header_ttl">新規登録</h1>
        </div>
    </header>
    <div class="container usr_bg">
        <div class="inner">
        <form action="./input_do.php" method="post"> 
                <div class="pwd">
                    <p>ユーザー名</p>
                    <input class="input" name="usr_name" maxlength="20">
                </div>
                <div class="mail">
                    <p>パスワード</p>
                        <input class="input" type="pwd" name="pwd" maxlength="20">
                </div>
                <div class="mail">
                    <p>メールアドレス</p>
                        <input class="input" type="email" name="email">
                </div>
                <label>
                    <button class="btn fas" type="submit">入力内容を確認する</button>
                </label>
            </form>

        </div>
    </div>

</body>

</html>