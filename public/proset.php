<?php
session_start();
// 必須である投稿本文がない場合または非ログイン常態の場合は何もせずに閲覧画面に飛ばす
if( empty($_POST['body']) || empty($_SESSION['user_login_name'])) { 
  header("HTTP/1.1 302 Found");
  header("Location: dash.php");
  return;
}
	//image
		$upload_image = $_FILES['image'];
		$ext = pathinfo($upload_image['name'],PATHINFO_EXTENSION);
	
		$image_filename=uniqid().".".$ext;
	
		$image_filepath = '/src/2019techc/public/static/proimg/'.$filename;
	
			move_uploaded_file($upload_image['tmp_name'],$image_filepath);
	
				$_SESSION['proimg'] = $_SESSION['user_login_name'];

				$user = $_SESSION['user_login_name'] ;

	//DB
		$dbh = new PDO('mysql:host=database-1.cl54zqktzjxt.us-east-1.rds.amazonaws.com;dbname=dash_DB','admin','adminpass');
				$image_path = null;

		$select_id = $dbh->prepare('SELECT id FROM users WHERE name = (:name)');
			$select_id->execute(array(
				':name' => $user,
			));

		$id = $select_id->fetchAll();		

		$insert_sth = $dbh->prepare('UPDATE users SET pro_img=(:filename) WHERE name = (:name)');

		//INSERT
		$insert_sth->execute(array(
			':filename' => $image_filename,
			':name' => $user,
		));

	header("Location:  ");
?>


