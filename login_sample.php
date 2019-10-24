<?php
require('dbconnect.php');

session_start();
print('セッションIDは '.$_COOKIE['PHPSESSID'].' 。');

$error[] = "";
$login = "";

if(!empty($_POST)) {
    //ログインの処理
    if($_POST['email'] !='' && $_POST['password'] != '') {
        $login = $db -> prepare('SELECT * FROM REGISTER WHERE email = ? AND password = ?');
        $login -> execute(array(
            $_POST['email'],
            sha1($_POST['password'])
        ));
        $member = $login -> fetch();


        if($member) {
            //ログイン成功
            $_SESSION['id'] = $member['id'];
            $_SESSION['time'] = time();
    
            header('Location: index.php'); exit();
        } else {
            $error ['login'] = 'failed';
        }
    } else {
        $error['login'] = 'blank';
    }
}
?>




<div id="lead">
    <p>メールアドレスとパスワードを記入してログインしてください</p>
    <p>入会手続きがまだの方はこちらからどうぞ</p>
    <p>&raquo;<a href="">入会手続きをする</a></p>
</div>

<form action="" method="post">
    <p>メールアドレス</p>
    <input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES); ?>" />
    <?php if($error['login'] == 'blank'): ?>
    <p>*メールアドレスとパスワードを入力してください</p>
    <?php endif; ?>
    <?php if($error['login'] = 'failed'): ?>
    <p>*ログインに失敗しました</p>
    <?php endif; ?>

    <p>パスワード</p>
    <input type="password" name="password" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>" />

    <p>ログイン情報の記録</p>
    <input id="save" type="checkbox" name="save" value="on">
    <label for="save">次回から自動でログインする</label>
</form>