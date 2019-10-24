<?php 

session_start();

$result = null;
$db =null;
try {
    $db=new PDO('mysql:dbname=test; host=localhost; charset=utf8', 'root', 'root');
    echo '①接続完了しました';
    echo '<br>';

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 


    if(isset($_REQUEST['post_id']) && is_numeric($_REQUEST['post_id'])) {

        
        echo "aaaa";
        //ここに処理
        $id = $_REQUEST['post_id'];

        $statment = $db -> prepare('DELETE FROM POST WHERE post_id = ?');
        $statment -> execute(array($id));

        header('Location: main_index.php');
    }

} catch(Exception $e) {
    echo '入力失敗' . $e->getMessage();
    // var_dump($result);
    
}

?>