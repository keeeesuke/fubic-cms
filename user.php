<?php

session_start();

try {
    //DBへの接続
    $db=new PDO('mysql:dbname=test; host=localhost; charset=utf8', 'root', 'root');
} catch(PDOException $e) {
    echo 'DB error' . $e->getMessage();
}


//registerのusr_idからユーザー情報を取得
if(isset($_REQUEST['usr_id']) && is_numeric($_REQUEST['usr_id'])) {
    
    $id = $_REQUEST['usr_id'];
    var_dump($id);

    $users = $db->prepare('SELECT * FROM REGISTER WHERE usr_id = ?');
    $users -> execute(array($_REQUEST['usr_id']));
    $user = $users -> fetch();
    var_dump($user);
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
            <div class="usr">
                <p class="small">ユーザー名</p>
                <p><?php echo $_SESSION["NAME"]; ?></p>
            </div>
            <div class="pwd">
                <p class="small">パスワード</p>
                <p><?php echo $user['pwd']; ?></p>
            </div>
            <label>
                <a href="user_update.php?usr_id=<?php echo $user['usr_id'];?>""><input class="btn fas" type="submit" value="内容を変更"> </a>
            </label>
        </div>
    </div>




</body>

</html>