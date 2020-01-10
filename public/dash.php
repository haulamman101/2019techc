<?php
$dbh =new PDO('mysql:host=database-1.cl54zqktzjxt.us-east-1.rds.amazonaws.com;dbname=dash_DB', 'admin', 'adminpass');
$select_sth = $dbh->prepare('SELECT name, body, filename,  created_at FROM dash_TB ORDER BY id ASC');
$select_sth->execute();
$rows = $select_sth->fetchAll();
?>
<?php foreach ($rows as $row) : ?>
<div>
	 <span>
		(Upload Date: <?php echo $row['created_at']; ?>)<br>

		<?php if ($row['name']) { echo $row['name']; } else { echo "no name"; } ?>	
	</span>
	<p> 
        <?php echo $row['body']; ?>
    </p>
 <?php if (!empty($row['filename'])) { ?>
    <p>
        <img src="/static/upload_image/<?php echo $row['filename']; ?>" width="200px">
    </p>
    <?php } ?>
</div> 
<?php endforeach; ?>


<form method="POST" action="dash_write.php" enctype="multipart/form-data">
    <div>
        名前: <input type="text" name="name">
    </div>
    <div>
        添付画像: <input type="file" name="upload_image" >
    </div>
    <div>
        <textarea name="body" rows="5" cols="100"></textarea>
    </div>
    <input type="submit">
</form>

<form action = ""  method = "POST">
        Username <input type = "text" name = "user">
        Password <input type = "password" name ="password">
                 <button type = "submit">Submit</button>
                 </form>


