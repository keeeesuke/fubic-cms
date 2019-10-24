<?php 

session_start();

$result = null;
$db =null;
try {
    $db=new PDO('mysql:dbname=test; host=localhost; charset=utf8', 'root', 'root');

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 


    // if(isset($_REQUEST['post_id']) && is_numeric($_REQUEST['post_id'])) {

        
    //     echo "aaaa";
    //     //ここに処理
    //     $id = $_REQUEST['post_id'];

    //     $statment = $db -> prepare('DELETE FROM POST WHERE post_id = ?');
    //     $statment -> execute(array($id));

    //     header('Location: delete.html');
    // }

} catch(Exception $e) {
    echo '入力失敗' . $e->getMessage();
    // var_dump($result);
    
}


try {
    $db=new PDO('mysql:dbname=test; host=localhost; charset=utf8', 'root', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    if(isset($_REQUEST['post_id']) && is_numeric($_REQUEST['post_id'])) {

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
    <title>投稿削除</title>
    <link rel="stylesheet" href="./art_edit/edit.css">
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>

<body>
    <header class="kanri_bg">
        <div class="inner">
            <h1 class="header_ttl">投稿削除</h1>
            <!-- <div class="nav">
                <a href="main_index.php"><input class="btn fas" type="submit" value="&#xf4ff; 一覧に戻る"></a>
                <input class="btn fas" type="submit" value="&#xf509; ユーザー設定">
                <input class="btn fas" type="submit" value="&#xf2f5; ログアウト">
            </div> -->
        </div>
    </header>

    <div class="container kanri_bg">
        <h2 class="mb0">以下の内容を削除してもよろしいですか？</h2>
        <a href="memo.php?post_id=<?php echo($memo['post_id']);?>"><input class="btn fas" type="submit" value="&#xf0e2; キャンセル"></a>
        <div class="inner">
            <form action="delete_do.php" method="POST">
                <input type="hidden" name = "post_id" value = "<?php echo($memo['post_id']); ?>">
                <div class="ttl">
                    <p class="normal">＜タイトル＞</p>
                    <h3><?php echo($memo['view_name']);?></h3>
                </div>
                <div class="img">
                    <p class="normal">＜写真＞</p>
                    <img src="images/<?php echo($memo['image_data']);?>" class="fit" alt="投稿された画像">
                </div>
                <div class="text">
                    <p class="normal">＜本文＞</p>
                    <h3><?php echo($memo['msg']);?></h3>
                </div>
                <label>
                    <button class="btn fas" type="submit">投稿を削除</button>
                </label>
            </form>
        </div>
    </div>

</body>

</html>