<?php
session_start();
// 必須である投稿本文がない場合または非ログイン常態の場合は何もせずに閲覧画面に飛ばす
if( empty($_POST['body']) || empty($_SESSION['user_login_name'])) { 
  header("HTTP/1.1 302 Found");
  header("Location: dash.php");
  return;
}	
	// ファイルのアップロード処理
	$filename = null;
	// ファイルの存在確認
	if ($_FILES['upload_image']['size'] > 0) {
	    // 画像かどうかのチェック
	    if (exif_imagetype($_FILES['upload_image']['tmp_name'])) {
	
	        // アップロードされたファイルの元々のファイル名から拡張子を取得
	        $ext = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
	
	        // ランダムな値でファイル名を生成
	        $filename = uniqid() . "." . $ext;
	        $filepath = "/src/2019techc/public/static/upload_image/" . $filename;
	
	        // ファイルを保存
	        move_uploaded_file($_FILES['upload_image']['tmp_name'], $filepath);
	    }
	}
	
$dbh =new PDO('mysql:host=database-1.cl54zqktzjxt.us-east-1.rds.amazonaws.com;dbname=dash_DB', 'admin', 'adminpass');	
 	//INSERTする
	$insert_sth = $dbh->prepare("INSERT INTO dash_TB (name, body, filename) VALUES (:name, :body, :filename)");
	$insert_sth->execute(array(
	':name' => $_SESSION['user_login_name'],
	':body' => $_POST['body'],
	':filename' => $filename,
	));
	
	// 投稿が完了したので閲覧画面に飛ばす
	header("HTTP/1.1 303 See Other");
	header("Location: dash.php");
	?>

