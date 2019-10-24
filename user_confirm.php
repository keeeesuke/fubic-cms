<?php

session_start();

try {
    //DBへの接続
    $db=new PDO('mysql:dbname=test; host=localhost; charset=utf8', 'root', 'root');
} catch(PDOException $e) {
    echo 'DB error' . $e->getMessage();
}

$errorMessage = "";

// //registerのusr_idからユーザー情報を取得
if(isset($_POST['pwd']) && isset($_POST['mail'])) {
    
    $id = $_REQUEST['usr_id'];
    

    $users = $db->prepare('SELECT * FROM REGISTER WHERE usr_id = ?');
    $users -> execute(array($_REQUEST['usr_id']));
    $user = $users -> fetch();

    //登録されているパスワードとアドレスを取得して変数に代入・・・①
    $check_pwd = $user['pwd'];
    $check_mail = $user['mail'];

    //ここの処理はもっと短くかけるはず
    if(password_verify($_POST['pwd'], $check_pwd) && $_POST['mail'] == $user['mail']) {
        //認証成功でユーザー設定画面へ飛ぶ
        header('Location: user_update.php');
    } elseif(!password_verify($_POST['pwd'], $check_pwd) && $_POST['mail'] == $user['mail']) {
        echo "パスワードが違います";
    } elseif(password_verify($_POST['pwd'], $check_pwd) && $_POST['mail'] !== $user['mail']) {
        echo "メールアドレスが違います";
    } else {
        echo "パスワードとメールアドレスが違います";
    }

} 

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー設定</title>
    <link rel="stylesheet" href="../user/user.css">
    <link rel="stylesheet" href="common.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>

<body>
    <header class="kanri_bg">
        <div class="inner">
            <h1 class="header_ttl">ユーザー設定</h1>
            <div class="nav">
                <a href="./Main.php"><input class="btn fas" type="submit" value="&#xf4ff; 戻る"></a>
            </div>
        </div>
    </header>

    <div class="container kanri_bg">
        <div class="inner">
            <p style="color: red;">ユーザー情報を変更する際には、登録時のパスワードとメールアドレス確認が必要です。</p>
            <form action="" name="confirm" method="post">
                <div class="usr">
                    <p class="small">パスワード</p>
                    <input class="input" id="pwd" type="password" name="pwd" value="" maxlength="20" placeholder="パスワードを入力してください。">
                </div>
                <div class="pwd">
                    <p class="small">メールアドレス</p>
                    <input class="input" id="mail" type="text" name="mail" value="" maxlength="20" placeholder="登録時のメールアドレスを入力してください。">
                </div> 
                <label>
                    <input type="submit" name="confirm" class="btn fas" value="確認する">
                </label>
            </form>
        </div>
    </div>




</body>

</html>