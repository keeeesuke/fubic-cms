<?php

require('../dbconnect.php');




?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー設定</title>
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="../common.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>

<body>
    <header class="kanri_bg">
        <div class="inner">
            <h1 class="header_ttl">ユーザー設定</h1>
        </div>
    </header>

    <div class="container kanri_bg">
        <div class="inner">
            <div class="usr">
                <p>ユーザー名</p>
                <input class="input" type="password" name="password" placeholder="◯◯◯◯◯◯◯◯◯" maxlength="20">
            </div>
            <div class="pwd">
                <p>パスワード</p>
                <input class="input" type="password" name="password" placeholder="◯◯◯◯◯◯◯◯◯" maxlength="20">
            </div>
            <div class="mail">
                <p>メールアドレス</p>
                <input class="input" type="email" name="email" placeholder="info@sample.com">
            </div>
            <label>
                <a href="main_index.php"><input class="btn fas" type="submit" value="変更を保存"> </a>
            </label>
            <label>
                <a href="../Main.php"><input class="btn fas" type="submit" value="戻る"></a>
            </label>
        </div>
    </div>




</body>

</html>