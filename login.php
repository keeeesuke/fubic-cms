<?php

//usr_idとpwdを入力
//DBにリクエストを送信
//usr_idの行に該当するpwdを取得する
//取得した値をプログラム側に返す

//DBからusr_idとpwdを受け取る
//受け取れたかどうかの確認

//ユーザが入力したpwdとDBから帰ってきたpwdが一致しているか判定(条件分岐)
//T：ログイン許可→一覧画面に遷都
//F：エラーメッセージを表示


// require 'password.php';   // password_verfy()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用
// セッション開始
session_start();


$db['host'] = "localhost";
$db['user'] = "root";
$db['pass'] = "root";
$db['dbname'] = "test";

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDとパスワードが入力されているのかチェック。それぞれで条件分岐する。
    if (empty($_POST["usr_id"])) {  
        $errorMessage = 'ユーザーIDが未入力です。';
    } 
    
    if (empty($_POST["pwd"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    //上記の条件分岐をクリアした後
    if (!empty($_POST["usr_id"]) && !empty($_POST["pwd"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["usr_id"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
        
        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass']);
            
            //PDOのエラーレポートを表示
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //usr_idに紐付くpwdをDB内で検索して取得
            $stmt = $pdo->prepare('SELECT * FROM REGISTER WHERE usr_id = ?');
            $stmt->execute(array($userid));
           
            //入力されたpwdを$passwordに代入
            $password = $_POST["pwd"];
            
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['pwd'])) {
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $id = $row['usr_id'];
                    $sql = "SELECT * FROM REGISTER WHERE usr_id = $id";  //入力したIDからユーザー名を取得
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $row['usr_name'];  // ユーザー名
                    }
                    
                    $_SESSION["NAME"] = $row['usr_name'];
                    $_SESSION["LOGIN_ID"] = $row['usr_id'];

                    header("Location: Main.php");  // メイン画面へ遷移
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
                }
            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードがありません。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            $errorMessage = $sql;
            $e->getMessage();
            // でエラー内容を参照可能（デバッグ時のみ表示）
            echo $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>ログイン</title>
            <link rel="stylesheet" href="./login/style.css">
            <link rel="stylesheet" href="common.css">
            <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    </head>
    <body>
    <header class="usr_bg">
        <div class="inner">
            <h1 class="header_ttl">ログイン</h1>
        </div>
    </header>
    <div class="container usr_bg">
        <form  id="loginForm" name="loginForm" action="" method="POST">
        <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
            <div class="inner">
                <div class="mail">
                    <p>ユーザーID</p>
                    <input type="text" class="input" id="userid" name="usr_id" placeholder="ユーザーIDを入力" value=""/><br>
                </div>
                <div class="pwd">
                    <p>パスワード</p>
                    <input type="password" id="password" name="pwd" value="" class="input"/><br>
                </div>
                <label>
                    <input class="btn fas" type="submit" id="login" name="login" value="ログイン">
                </label>
            </div>
        </form>
        <a href="SignUp.php"><input class="btn fas" type="submit" value="&#xf4ff; 新規登録はこちら"></a>
    </div>
    </body>
</html>