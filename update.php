<?php 

session_start();

$result = null;
$db =null;

try {
    $db=new PDO('mysql:dbname=test; host=localhost; charset=utf8', 'root', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    if(isset($_REQUEST['post_id']) && is_numeric($_REQUEST['post_id'])) {

        echo "aaaa";
        //ここに処理
        $id = $_REQUEST['post_id'];

        $memos = $db -> prepare('SELECT * FROM POST WHERE post_id = ?');
        $memos -> execute(array($id));
        $memo = $memos -> fetch();
    }

} catch(Exception $e) {
    echo '入力失敗' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>投稿編集</title>
    <link rel="stylesheet" href="./art_edit/edit.css">
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>

<body>
    <header class="kanri_bg">
        <div class="inner">
            <h1 class="header_ttl">投稿編集</h1>
            <div class="nav">
                <a href="main_index.php"><input class="btn fas" type="submit" value="&#xf4ff; 一覧に戻る"></a>
                <input class="btn fas" type="submit" value="&#xf509; ユーザー設定">
                <input class="btn fas" type="submit" value="&#xf2f5; ログアウト">
            </div>
        </div>
    </header>

    <div class="container kanri_bg">
        <div class="inner">
            <form action="update_do.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name = "post_id" value = "<?php echo($memo['post_id']); ?>">
                <div class="ttl">
                    <p>タイトル</p>
                    <input class="input" name="view_name" maxlength="20" value="<?php echo($memo['view_name']);?>" >
                </div>
                <div class="img">
                    <p>写真</p>
                    <p class="img_sml">現在の画像</p>
                    <img src="images/<?php echo($memo['image_data']);?>" class="fit_half" alt="投稿された画像">                   
                    <br>
                    <p class="img_sml">変更する画像を選択してください。</p>
                    <input class="input" type="file" name="image_data" id="image_data">
                </div>
                <div class="text">
                    <p>本文</p>
                    <textarea name="msg" cols="100" rows="10"><?php echo($memo['msg']);?></textarea>
                </div>
                <label>
                    <button class="btn fas" type="submit">編集を保存</button>
                </label>
            </form>
        </div>
    </div>

</body>

</html>