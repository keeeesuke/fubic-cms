<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('../dbconnect.php');

echo 'eeeecho';
echo '<br>';

$result = null;
$db =null;
try {
    $db=new PDO('mysql:dbname=test; host=localhost; charset=utf8', 'root', 'root');

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    //index.htmlの値を取得
    $usr_name = $_POST['usr_name']; 
    var_dump($usr_name);

    $pwd = $_POST['pwd']; 
    var_dump($pwd);


    $email = $_POST['email'];
    var_dump($email);


    // INSERT文を変数に格納。:nameや:categoryはプレースホルダという、値を入れるための単なる空箱
    $sql="INSERT INTO REGISTER(usr_name, pwd, email) VALUES (:name, :pwd, :email)";
    var_dump($sql);

    //挿入する値は空のまま、SQL実行の準備をする
    $stmt = $db->prepare($sql);
    var_dump($stmt);

    
    $params = array(':name' => $usr_name, ':pwd' => $pwd, ':email' => $email);
    var_dump($params);
    $stmt->execute($params); 
    echo $stmt->queryString;
    

    $records = $db->query('SELECT count(*) FROM ARTICLE');
    while ($record = $records -> fetch()) {
        echo ($record['count(*)']);
        echo '<br>';

    }

} catch(Exception $e) {
    echo '入力失敗' . $e->getMessage();
    // var_dump($result);
    
}
echo '<br>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test</title>
    <link rel="stylesheet" href="../common.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="usr_bg">
        <div class="inner">
            <h1 class="header_ttl">新規登録</h1>
        </div>
    </header>
    <div class="container usr_bg">
        <div class="inner">
                <p>以下の内容で宜しければ「登録」ボタンをクリックしてください</p>
                <div class="pwd">
                    <p>ユーザー名</p>
                    <p><?php echo $usr_name; ?></p>
                </div>
                <div class="mail">
                    <p>パスワード</p>
                    <p><?php echo $pwd; ?></p>
                </div>
                <div class="mail">
                    <p>メールアドレス</p>
                    <p><?php echo $email; ?></p>
                </div>
                <label>
                    <a href="../main_index.php"><button class="btn fas" type="submit">登録</button></a>
                </label>
        </div>
    </div>
    
</body>
</html>