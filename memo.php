<?php


try {
    //DBへの接続
    $db=new PDO('mysql:dbname=test; host=localhost; charset=utf8', 'root', 'root');

} catch(PDOException $e) {
    echo 'DB error' . $e->getMessage();
}


//格納したデータを一覧として表示
//$memosから値を取ってきて$memoに代入する。fetchでそのデータを取り切る。
if(isset($_REQUEST['post_id']) && is_numeric($_REQUEST['post_id'])) {
    $id = $_REQUEST['post_id'];

    $memos = $db->prepare('SELECT * FROM POST WHERE post_id = ?');
    $memos -> execute(array($_REQUEST['post_id']));
    $memo = $memos -> fetch();
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>記事詳細</title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="./article/article.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>


    <header class="usr_bg">
        <div class="inner usr_bg">
            <h1 class="header_ttl">記事詳細</h1>
            <div class="nav">
                <a href="main_index.php"><input class="btn fas" type="submit" value="&#xf0e2; 一覧に戻る"></a>
                <a href="./user/index.html"><input class="btn fas" type="submit" value="&#xf509; ユーザー設定"></a>
                <a href="Logout.php"><input class="btn fas" type="submit" value="&#xf2f5; ログアウト"></a>
            </div>
        </div>

    </header>

    <div class="container usr_bg">
        <div class="inner">
            <div class="cards">
                <div class="card w100">
                    <div class="my-parts" href="#">
                        <div class="my-parts-img">
                        <img src="images/<?php echo $memo['image_data']; ?>">
                        </div>
                        <div class="my-parts-body">
                            <p class="small"><?php echo htmlspecialchars($memo['create_time'], ENT_QUOTES); ?></p>
                            <h1 class="my-parts-title"><?php echo $memo['view_name'];?></h1>
                            <p><?php echo $memo['msg']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-group">
                <div class="inner">
                    <form action="delete.php?post_id=<?php echo($memo['post_id']); ?>" method="POST" class="delete-btn">
                        <label>
                            <input class="btn fas" type="submit" value="&#xf2ed; 削除">
                        </label>
                    </form>
                    <form action="update.php?post_id=<?php echo($memo['post_id']); ?>" method="POST" class="edit-btn">
                        <label>
                            <input class="btn fas" type="submit" value="&#xf044; 編集">
                        </label>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>