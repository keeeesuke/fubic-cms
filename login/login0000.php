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
$userId = $_POST['userid'];
 
if (!isset($_SESSION[$userId])) {
    // 初めてのユーザはセッションにユーザIDをセット
    $_SESSION[$userId] = $userId;
    echo "ログインしました。";
} else {
    echo "ログイン済みです。";
}
?>


<!-- ------------------------------------------------------------------------------- -->

<?php 


$error[] = "";
$error['login'] = "";


// if(!empty($_POST)) {

    //login start
    if(($_POST['email'] != '' && $_POST['pwd'] != '')) {
        $login = $db -> prepare('SELECT * FROM REGISTER WHERE pwd = ? AND email = ?');
        $login -> execute(array(
            sha1($_POST['pwd']),
            $_POST['email']
        ));

        $member = $login -> fetch();
        var_dump($member);
    
        echo($db->errorInfo());
        echo "<br>";
        echo "<br>";

        var_dump($member);
        echo "<br>";


    if($member) {
        //login clear
        $_SESSION['id'] = $member[''];
        $_SESSION['time'] = time();

        header('Location: ../index.php');
        exit();
    } else {
        $error['login'] = 'failed';
    }


    } else {
        $error['login'] = 'blank';
    }

// }

?>


<!DOCTYPE html>
<html lang="ja">

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
        <form action="../main_index.php" method="POST"> 
            <div class="inner">
                <div class="mail">
                    <p>メールアドレス</p>
                    <input class="input" type="text" name="email" placeholder="info@sample.com" 
                    value="<?php echo htmlspecialchars($_GET['email'],ENT_QUOTES); ?>">
                    <?php if($error['login'] == 'blank'): ?>
                    <p class="error">*メールアドレスとパスワードをご記入ください</p>
                    <?php endif; ?>
                    <?php if($error['login'] == 'failed'): ?>
                    <p class="error">*ログインに失敗しました。正しくご記入ください。</p>
                    <?php endif; ?>
                </div>
                <div class="pwd">
                    <p>パスワード</p>
                    <input class="input" type="password" name="pwd" maxlength="20"
                    value="<?php echo htmlspecialchars($_GET['pwd'], ENT_QUOTES); ?>"> 
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