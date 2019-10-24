<?php

session_start();

//registerのusr_idからユーザー情報を取得
// if(isset($_REQUEST['pwd']) && isset($_REQUEST['mail'])) {

//     $pwd = $_REQUEST['pwd'];
//     var_dump($_REQUEST['pwd']);

//     // if($pwd==)
//     var_dump($pwd);

//     $users = $db->prepare('SELECT * FROM REGISTER WHERE pwd = ?');
//     $users -> execute(array($_REQUEST['pwd']));
//     $user = $users -> fetch();
// } else {
//     echo "パスワード、もしくはメールアドレスが正しくありません。";
// }

try {
    $db=new PDO('mysql:dbname=test; host=localhost; charset=utf8', 'root', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    //--------------------------------------------------ここからuser_update_do.phpのメイン部分--------------------------------------------------------------------
    
    $statment = "";
    $password =$_POST['pwd'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    if (isset($_POST['usr_name']) || isset($_POST['pwd'])|| isset($_POST['mail'])|| isset($_SESSION['LOGIN_ID'])) {
       
        $statment = $db -> prepare('UPDATE REGISTER SET usr_name = :usr_name, pwd = :pwd, mail = :mail WHERE usr_id = :usr_id');
        $statment->bindParam(':usr_name', $_POST['usr_name'], PDO::PARAM_STR);
        $statment->bindParam(':pwd', $hash, PDO::PARAM_STR);
        $statment->bindParam(':mail', $_POST['mail'], PDO::PARAM_STR);
        $statment->bindParam(':usr_id', $_SESSION['LOGIN_ID'], PDO::PARAM_INT);
        $statment -> execute();
        echo "ユーザー情報を変更しました。";

        //セッションの変更
        $_SESSION['NAME'] = $_POST['usr_name'];


    }


} catch(Exception $e) {
    echo '入力失敗' . $e->getMessage();
        // $statment = $db -> prepare('UPDATE POST SET view_name = ?, msg = ?, image_data = ? login_usr = ? WHERE post_id = ?');
        // $statment->debugDumpParams();    
        // var_dump($_SESSION);
        // var_dump($_POST);
}


// if(isset($_POST['submit'])){
//     echo "ok";
    
//     if(isset($_POST['pwd'])) {
//         $_POST['pwd'] == $users['pwd'];
//         echo "ok2";
//     }
//     if(isset($_POST['mail'])){
//         $_POST['mail'] == $users['mail'];
//         echo "ok3";
//     }
    
// }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="Main.php">戻る</a>

    
</body>
</html>