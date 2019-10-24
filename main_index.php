<?php 
// フォームから送信されてくるユーザID
// $userId = $_POST['usr_id'];
 
// if (!isset($_SESSION[$userId])) {
    // 初めてのユーザはセッションにユーザIDをセット
//     $_SESSION[$userId] = $userId;
//     echo "ログインしました。";
// } else {
//     echo "ログイン済みです。";
// }


// try {
//     echo '②接続完了しました';
// } catch(PDOException $e) {
//     echo 'DB error' . $e->getMessage();
// }

//ページングの実装
// if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
//     $page = $_REQUEST['page'];
// } else {
//     $page = 1;
// }
// $start = 5 * ($page - 1);
// $memos = $db->prepare('SELECT * FROM ARTICLE ORDER BY art_id DESC LIMIT ?,5');
// $memos->bindParam(1, $start, PDO::PARAM_INT);
// $memos->execute();


// セッション管理開始
session_start();

//DBに接続
require('dbconnect.php');

//タイムゾーンの設定
date_default_timezone_set('UTC');


//ログインしているのが誰なのかをチェック
if(!empty($_SESSION['NAME'])) {
    $person = $_SESSION['NAME'];
    echo "現在のログイン：".$person;
} else {
    header('Location: login.php');
}

//変数を宣言
$post['view_name'] = "";
$post['image_data'] ="";
$post['msg'] = "";
$post['usr_id']="";

//sessionを使ってユーザーを特定
$login_user = $_SESSION["NAME"];
$login_user_id = $_SESSION["LOGIN_ID"];


//投稿を取得
//SELECT文の中で変数を使用する際には「""(引用符)」の場所・使い方に注意する！
$posts = $db->query("SELECT r.usr_id, r.usr_name, p.msg, p.view_name, p.post_id, p.image_data, p.create_time, p.login_usr FROM REGISTER r, POST p WHERE p.login_usr = r.usr_id AND p.login_usr = ".(int)$login_user_id);

$users = $db->query("SELECT r.usr_id FROM REGISTER r WHERE usr_name = ".$login_user);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>記事一覧</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>


<body>
    <header class="usr_bg">
        <div class="inner">
            <div class="inner">
                <h1 class="header_ttl">記事一覧</h1>
                <p class="welcome"><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?>さんの投稿一覧</p>
            </div>
            <div class="nav">
                <a href="Logout.php"><input class="btn fas" type="submit" value="&#xf4ff; ログアウト"></a>
                <a href="post_get.php"><input class="btn fas" type="submit" value="&#xf4ff; 投稿する"></a>
                <a href="user_confirm.php?usr_id=<?php echo htmlspecialchars($_SESSION["LOGIN_ID"], ENT_QUOTES); ?>"><input class="btn fas" type="submit" value="&#xf4ff; ユーザー設定"></a>
                <a href="./Main.php"><input class="btn fas" type="submit" value="&#xf4ff; 戻る"></a>
            </div>
        </div>
    </header>

    <div class="container usr_bg">
        <div class="cards">
            <?php foreach ($posts as $post) : ?>
            <?php if($post === NULL): ?>
            <div class="card">
                <p>まだ投稿はありません。</p>
            </div>
            <?php else: ?>
            <div class="card">
                <a class="my-parts" href="memo.php?post_id=<?php echo $post['post_id']; ?>">
                    <div class="my-parts-body">
                        <div class="img">
                            <img src="images/<?php echo $post['image_data'];?>" alt="投稿画像" class="fit">
                        </div>
                        <p class="small"><?php echo htmlspecialchars($post['create_time'], ENT_QUOTES); ?></p>
                        <h1 class="my-parts-title"><?php echo htmlspecialchars($post['view_name'], ENT_QUOTES); ?></h1>
                        <p><?php echo htmlspecialchars($post['msg'], ENT_QUOTES); ?></p>
                    </div>
                </a>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>