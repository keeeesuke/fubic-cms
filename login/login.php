<?php

//エラー内容を表示
error_reporting(E_ALL);
ini_set('display_errors', '1');


//DB接続
require('../dbconnect.php');


// セッションの有効期限を1分に設定
session_set_cookie_params(60 * 1);


// セッション管理開始
session_start();
 
// フォームから送信されてくるユーザID
$userId = "";
$userId = $_POST['userid'];
 
if (!isset($_SESSION[$userId])) {
    // 初めてのユーザはセッションにユーザIDをセット
    $_SESSION[$userId] = $userId;
    echo "ログインしました。";
} else {
    echo "ログイン済みです。";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログイン</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../common.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
                <header class="usr_bg">
                    <div class="inner">
                        <h1 class="header_ttl">ログイン</h1>
                    </div>
                </header>
                <div class="container usr_bg">
                    <form action="../main_index.php" method="post">
                        <div class="inner">
                            <div class="mail">
                                <p>メールアドレス</p>
                                <input type="text" name="userid" class="input"/><br>
                            </div>
                            <div class="pwd">
                                <p>パスワード</p>
                                <input type="password" name="passwd" class="input"/><br>
                            </div>
                            <label>
                                <button class="btn fas" type="submit">ログイン</button>
                            </label>
                        </div>
                    </form>
                    <a href="../register/index.php"><input class="btn fas" type="submit" value="&#xf4ff; 新規登録はこちら"></a>
                </div>
</body>
</html>




