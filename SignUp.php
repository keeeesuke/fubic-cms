<?php
require 'password.php';   // password_hash()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用
// セッション開始
session_start();

$db['host'] = "localhost";
$db['user'] = "root";
$db['pass'] = "root";
$db['dbname'] = "test";

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";
$login_msg = "";

// ログインボタンが押された場合
if (isset($_POST["signUp"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["username"])) {  // 値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    } else if (empty($_POST["password2"])) {
        $errorMessage = 'パスワードが未入力です。';
    }else if (empty($_POST["mail"])) {
        $errorMessage = 'メールアドレスが未入力です。';
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && $_POST["password"] === $_POST["password2"] && $_POST['mail']) {
        // 入力したユーザIDとパスワードを格納
        $username = $_POST["username"];
        $password = $_POST["password"];
        $mail = $_POST["mail"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("INSERT INTO REGISTER (usr_name, pwd, mail) VALUES (?, ?, ?)");

            $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT), $mail));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $signUpMessage = '登録が完了しました。あなたの登録IDは '. $userid. ' です。パスワードは '. $password. ' です。';  // ログイン時に使用するIDとパスワード
            $login_msg = "ログインする";
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            $e->getMessage(); 
            // でエラー内容を参照可能（デバッグ時のみ表示）
            echo $e->getMessage();
        }
    } else if($_POST["password"] != $_POST["password2"]) {
        $errorMessage = 'パスワードに誤りがあります。';
    }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>新規登録</title>
        <link rel="stylesheet" href="./register/style.css">
        <link rel="stylesheet" href="common.css">
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
                <form id="loginForm" name="loginForm" action="" method="POST">
                        <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                        <div><font color="#0000ff"><?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></font></div>
                        <div class="login_msg">
                            <a href="login.php"><font color=""><?php echo htmlspecialchars($login_msg, ENT_QUOTES); ?></a>
                        </div>

                        <div class="usr_name">
                            <label for="username">ユーザー名</label><input class="input" type="text" id="username" name="username" placeholder="ユーザー名を入力" value="<?php if (!empty($_POST["username"])) {echo htmlspecialchars($_POST["username"], ENT_QUOTES);} ?>">   
                        </div>
                        <div class="pwd">
                            <label for="password">パスワード</label><input class="input" type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                            <br>
                            <label for="password2">パスワード（確認用）</label><input class="input" type="password" id="password2" name="password2" value="" placeholder="再度パスワードを入力">
                        </div>
                        <div class="mail">
                            <label for="mail">メールアドレス</label><input class="input" type="mail" id="mail" name="mail" value="" placeholder="メールアドレスを入力してください">
                        </div>
                        
                        <input type="submit" id="signUp" name="signUp" value="新規登録" class="btn fas">
                </form>
                <br>
                
            </div>
        </div>
    </body>
</html>
