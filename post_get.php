<?php
session_start();
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新規投稿</title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="art_post/post.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <base target="_blank">
</head>

<body>
    <header class="kanri_bg">
        <div class="inner">
            <h1 class="header_ttl">新規投稿</h1>
            <div class="nav">
                <a href="./Main.php"><input class="btn fas" type="submit" value="&#xf4ff; 戻る"></a>
            </div>
        </div>
    </header>

    <form action="post.php" enctype="multipart/form-data" method="post"> 
        <div class="container kanri_bg">
            <div class="inner">
                <div class="ttl">
                    <label for="view_name">タイトル</label>
                    <br>
                    <input class="input" id="view_name" type="text" name="view_name" value="" maxlength="20">
                </div>

                <div class="ttl">
                    <label for="image_data">写真</label>
                    <br>
                    <input class="input" id="image_data" type="file" name="image_data">
                </div>

                <div class="text">
                    <label for="msg">内容</label>
                    <textarea id="msg" name="msg" cols="120" rows="5"></textarea>
                </div>
                <input type="submit" name="btn_submit" class="btn fas" value="投稿する">
            </div>
        </div>
    </form>

</body>

</html>
