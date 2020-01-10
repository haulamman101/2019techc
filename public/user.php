<?php
$dbh =new PDO('mysql:host=database-1.cl54zqktzjxt.us-east-1.rds.amazonaws.com;dbname=dash_DB', 'admin', 'adminpass');
$select_sth = $dbh->prepare('SELECT name, body, filename,  created_at FROM dash_TB ORDER BY id ASC');
$select_sth->execute();
$rows = $select_sth->fetchAll();
?>

<?php
<form action ="dash.php" method = "POST">
	Username <input type = "text" name = "user">
	Password <input type = "password" name ="password">
	 	 <button type = "submit">Submit</button>
		 </form>		 
		 <?>
