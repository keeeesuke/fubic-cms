<?php
// セッション管理開始
session_start();

//DBとの接続
require('dbconnect.php');

define( "FILE_DIR", "images/");

// タイムゾーン設定
date_default_timezone_set('Asia/Tokyo');

$file_handle = "";
$view_name = "";
$msg = "";
$date = "";
$image_data = "";

$file = $_FILES['image_data'];

//前回の加藤さんからのレビューを参考にして、条件分岐の順番を意識した。タイトルか本文が未入力の場合はこの時点でアラームをだす。
if(empty($_POST['view_name']) || empty($_POST['msg'])) {
    echo "タイトルとメッセージを入力してください";
} 


//元ファイル名の先頭にアップロード日時を加える（この部分は要らないかもしれない）
$newFilename = $_FILES['image_data']['name'];

//ファイルの保存先
$upload = 'images/'.$newFilename;


// アップロードが正しく完了したかチェック
if(move_uploaded_file($_FILES['image_data']['tmp_name'], $upload)) { 
  echo 'アップロード完了';
} else{
  echo 'アップロード失敗'; 
}


if(!empty($_POST['view_name'] && $_POST['msg'] && $_FILES['image_data']['tmp_name'])) {

    $image = $_FILES['image_data']['name'];
    move_uploaded_file($_FILES['image_data']['tmp_name'], 'images/' .$image);

    var_dump($image);
    echo $image;

    $contents = $db->prepare('INSERT INTO POST SET msg = ?, view_name = ?, image_data = ?, login_usr =  ?' );
    $contents->execute(array(
        $_POST['msg'],
        $_POST['view_name'],
        $_FILES['image_data']['name'],
        $_SESSION["LOGIN_ID"]
    ));

    //投稿をDBに格納したら、ページを遷都して、「投稿完了」のメッセージを表示。トップ画面と一覧画面へのリンクも設定する。
    header('Location: finish.html');
}
?>


<!-- <?php 
$ext = substr($file['name'], -4);
if($ext == '.gif' || $ext == '.png' || $ext == '.jpg') :
    $filePath = 'images/' . $file['name'];
    $success = move_uploaded_file($file['tmp_name'], $filePath);

    if($success):
?>

    <img src="<?php printf($filePath); ?>" width="300px">

    <?php else: ?>
        file upload faults.
    <?php  endif; ?>

<?php else: ?>
    file upload faults.
<?php  endif; ?> -->



