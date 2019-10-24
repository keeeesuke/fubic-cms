<?php
session_start();
// var_dump($_SESSION);

//ログイン状態チェック
// if (!isset($_SESSION["NAME"])) {
//     header("Location: Logout.php");
//     exit;
// }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>メイン</title>
        <link rel="stylesheet" href="Main.css">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    </head>
    <body style="background-color: #eee; text-align: center;">
        <!-- ユーザーIDにHTMLタグが含まれても良いようにエスケープする -->
        <p class="welcome">ようこそ<u class="you"><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></u>さん</p>  <!-- ユーザー名をechoで表示 -->
        <p>IDは<?php echo htmlspecialchars($_SESSION["LOGIN_ID"], ENT_QUOTES); ?></p>  <!-- ユーザー名をechoで表示 -->
        <ul>
            <li><a href="post_get.php"  class="btn fas">新規投稿</a></li>
            <li><a href="main_index.php" class="btn fas">記事一覧</a></li>
            <li><a href="user_confirm.php?usr_id=<?php echo htmlspecialchars($_SESSION["LOGIN_ID"], ENT_QUOTES); ?>" class="btn fas">ユーザー情報変更</a></li>
            <li><a href="Logout.php" class="btn fas">ログアウト</a></li>
        </ul>
    </body>
</html>