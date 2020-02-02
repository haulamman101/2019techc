<?php
$dbh =new PDO('mysql:host=database-1.cl54zqktzjxt.us-east-1.rds.amazonaws.com;dbname=dash_DB', 'admin', 'adminpass');
$select_sth = $dbh->prepare('SELECT name, body, filename,  created_at FROM dash_TB ORDER BY id ASC');
$select_sth->execute();
$rows = $select_sth->fetchAll();
?>
<form>
	<div>
	Name <?php echo($_SESSION['user_login_name'])?>
	<p>Gender : <br>
	<select>
	<option value = "B">BOY</option>
	<option value = "G">GIRL</option>
	</select>
	<input type="submit" value="submit"><input type="reset" value="reset">
	</div>
</form>
