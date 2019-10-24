<?php

session_start();

//ユーザー設定画面の設計について・手順
//・現状の作成画面では、「ユーザー名」「ハッシュ化されたパスワード」を表示している。
//→実際はハッシュ化されたpassでは無意味。
//というのも、ハッシュ化されたpassは一方向性をもつので、復号はできない
//
//その為、ユーザーを特定するためには、ハッシュ化される前のpassを入力してもらい、それをハッシュ化した値が等しくなるかどうかを判断・・・①
//更に、メールアドレスを入力してもらい、その値が等しいどうかを判断する・・・②
//
//＜修正後のユーザー変更の流れ＞
//１、「ユーザー設定を変更」をクリック
//２、「ユーザー設定を変更する際には、パスワードとメールアドレスを入力してください。」の画面を表示。
//３、usr_idを基にして、①と②をDBと照合する・・・③
//４、③の認証がクリアした＝ユーザーの特定に成功
//５、「ユーザー名」「パスワード」「メールアドレス」を変更できる
//６、更した内容を確認できる画面を表示
//７、「変更を保存する」をクリックしてDBにupdateする
//８、一覧画面に遷都する
//
//



try {
    //DBへの接続
    $db=new PDO('mysql:dbname=test; host=localhost; charset=utf8', 'root', 'root');
} catch(PDOException $e) {
    echo 'DB error' . $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー変更</title>
    <link rel="stylesheet" href="../user/user.css">
    <link rel="stylesheet" href="common.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>

<body>
    <header class="kanri_bg">
        <div class="inner">
            <h1 class="header_ttl">ユーザー設定</h1>
            <h2>変更画面</h2>
            <div class="nav">
                <a href="./Main.php"><input class="btn fas" type="submit" value="&#xf4ff; 戻る"></a>
            </div>
        </div>
    </header>

    <div class="container kanri_bg">
        <p>変更する内容を入力してください。</p>
        <form  id="user_update_form" name="user_update_form" action="user_update_do.php" method="POST">
            <div class="inner">
                <div class="usr">
                    <p class="small">ユーザー名</p>
                    <input class="input" type="text" name="usr_name" placeholder="変更する名前を入力してください">
                </div>
                <div class="pwd">
                    <p class="small">パスワード</p>
                    <input class="input" type="password" name="pwd" placeholder="パスワードを入力してください" maxlength="20">
                </div>
                <div class="mail">
                    <p class="small">メールアドレス</p>
                    <input class="input" type="text" name="mail" placeholder="変更するメールアドレスを入力してください">
                </div>
                <label>
                    <a href="main_index.php?id="><input class="btn fas" type="submit" value="内容を保存"> </a>
                </label>
            </div>
        </form>
    </div>




</body>

</html>