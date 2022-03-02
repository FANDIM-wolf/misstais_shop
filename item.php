<?php header('Content-Type: text/html; charset=utf-8');?>


<!DOCTYPE html>
<html>
<head>
	 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat:wght@200;300&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	
	
	<?php 
	$var_id_of_item = $_GET['id'];

	$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop" , "mikael" , "elkin");
	$huruf= $pdo->query("SET NAMES 'utf8'");
	$huruf2= $pdo->query("SET CHARACTER SET 'utf8'");
	$huruf3= $pdo->query("SET SESSION collation_connection = 'utf8_general_ci'");
	$sql ="SELECT * FROM items WHERE id=".$var_id_of_item;
	$sql_get_additinal_photos = "SELECT * FROM photos WHERE item_id=".$var_id_of_item;
	$statement =  $pdo->prepare($sql);
	$statement_get_additional_photos = $pdo->prepare($sql_get_additinal_photos);
	$statement_get_additional_photos->execute();
	$statement->execute(); 

	$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
	$photos = $statement_get_additional_photos->fetchAll(PDO::FETCH_ASSOC);

	?>

	<?php foreach($posts as $post): ?>
	<h3> <?= $post['name']; ?> </h3>
	<img src="images/<?=$post['image']; ?>" class="photo_item_pro" >
	<?php endforeach; ?>
	<br>
	<?php foreach($photos as $photo): ?>
	
	<img src="images/<?=$photo['name']; ?>" class="photo_item_pro" >
	<?php endforeach; ?>

	<?php foreach($posts as $post): ?>
	<b><p><?= $post['price']; ?> РУБ</p></b>	
	<h2> <?= $post['description']; ?> </h2>

	<?php endforeach; ?>

</body>
</html>
