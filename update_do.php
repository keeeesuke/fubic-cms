<?php 
require 'password.php';   // password_hash()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用


session_start();

$result = null;
$db =null;

define( "FILE_DIR", "images/");
$file = $_FILES['image_data'];


//元ファイル名の先頭にアップロード日時を加える（この部分は要らないかもしれない）
$newFilename = $_FILES['image_data']['name'];

//ファイルの保存先
$upload = 'images/'.$newFilename;



try {
    $db=new PDO('mysql:dbname=test; host=localhost; charset=utf8', 'root', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    //--------------------------------------------------ここからupdate_do.phpのメイン部分--------------------------------------------------------------------
    

    $image = $_FILES['image_data']['name'];
    move_uploaded_file($_FILES['image_data']['tmp_name'], 'images/' .$image);

    var_dump($image);
    echo $image;
    
    $statment = "";

    if (isset($_POST['view_name']) || isset($_POST['msg'])|| isset($_FILES['image_data']['name'])|| isset($_POST['post_id'])|| isset($_SESSION['LOGIN_ID'])) {
       
        $statment = $db -> prepare('UPDATE POST SET view_name = :view_name, msg = :msg, image_data = :image_data, login_usr = :login_usr WHERE post_id = :post_id');
        $statment->bindParam(':view_name', $_POST['view_name'], PDO::PARAM_STR);
        $statment->bindParam(':msg', $_POST['msg'], PDO::PARAM_STR);
        $statment->bindParam(':image_data', $_FILES['image_data']['name'], PDO::PARAM_STR);
        $statment->bindParam(':login_usr', $_SESSION['LOGIN_ID'], PDO::PARAM_INT);
        $statment->bindParam(':login_usr', $_SESSION['LOGIN_ID'], PDO::PARAM_INT);
        $statment->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_INT);
        // $statment -> execute(array($_POST['view_name'],$_POST['msg'],"aaaa.png" ,4, 93));
        $statment -> execute();
        echo "メモの内容を変更しました.";
        var_dump($_FILES['image_data']['name']);
        var_dump($statment->bindParam(':image_data', $_FILES['image_data']['name'], PDO::PARAM_STR));
    }


} catch(Exception $e) {
    echo '入力失敗' . $e->getMessage();
        // $statment = $db -> prepare('UPDATE POST SET view_name = ?, msg = ?, image_data = ? login_usr = ? WHERE post_id = ?');
        // $statment->debugDumpParams();    
        // var_dump($_SESSION);
        // var_dump($_POST);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test</title>
</head>
<body>



<p><a href="main_index.php">戻る</a></p>
    
</body>
</html>