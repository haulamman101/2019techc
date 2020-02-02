<?php
session_start();
$dbh =new PDO('mysql:host=database-1.cl54zqktzjxt.us-east-1.rds.amazonaws.com;dbname=dash_DB', 'admin', 'adminpass');
$select_sth = $dbh->prepare('SELECT name, body, filename,  created_at FROM dash_TB ORDER BY id ASC');
$select_sth->execute();
$rows = $select_sth->fetchAll();
?>
<?php foreach ($rows as $row) : ?>
<div>
	 <span>
		(Upload Date: <?php echo $row['created_at']; ?>)<br>

	User =	<?php if ($row['name']) { echo $row['name']; } else { echo "no name"; } ?>	
	</span>
	<p> 
       Comment = <?php echo $row['body']; ?>
    </p>
 <?php if (!empty($row['filename'])) { ?>
    <p>
        <img src="/static/upload_image/<?php echo $row['filename']; ?>" width="200px">
    </p>
    <?php } ?>
</div> 
<?php endforeach; ?>

<?php if(empty($_SESSION['user_login_name'])):
?>
Join membership and upload <a href="./login_form.php">Click here!</a>
<?php else: ?>
<form method="POST" action="/dash_write.php" enctype="multipart/form-data">
    <div>
        Name <?php echo($_SESSION['user_login_name']) ?>
        <input type="file" name="upload_image">
    </div>
    <div>
        <textarea name="body" rows="5" cols="100" required></textarea>
    </div>
    <input type="submit">

</form>
<?php endif; ?>
