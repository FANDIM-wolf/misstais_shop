<?php 
session_start();
header('Content-Type: text/html; charset=utf-8');?>


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
	$var_id_of_item = $_GET['id']; //id of item
	$user = $_COOKIE["user"];
	$color =  $_GET["color"];
	//echo $color;
	$comment_id=2343;
	//show item 
	$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop" , "mikael" , "elkin");
	$huruf= $pdo->query("SET NAMES 'utf8'");
	$huruf2= $pdo->query("SET CHARACTER SET 'utf8'");
	$huruf3= $pdo->query("SET SESSION collation_connection = 'utf8_general_ci'");
	$sql ="SELECT * FROM items WHERE id=".$var_id_of_item;
	$sql_get_additinal_photos = "SELECT * FROM photos WHERE item_id=".$var_id_of_item;
	$sql_colors = "SELECT * FROM colors WHERE id_item=".$var_id_of_item;
	$sql_current_photo = "SELECT * FROM `photos` WHERE name = :name";
	$statement_current_photo = $pdo->prepare($sql_current_photo);
	$statement_colors = $pdo->prepare($sql_colors);
	$statement =  $pdo->prepare($sql);
	$statement_get_additional_photos = $pdo->prepare($sql_get_additinal_photos);
	$statement_get_additional_photos->execute();
	$statement->execute(); 
	$statement_colors->execute();
	$statement_current_photo->execute([':name'=>$color]);
	$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
	$photos = $statement_get_additional_photos->fetchAll(PDO::FETCH_ASSOC);
	$colors = $statement_colors->fetchAll(PDO::FETCH_ASSOC);
	$current_photo = $statement_current_photo->fetchAll(PDO::FETCH_ASSOC);
	//show comments for this item
	
	//print_r($current_photo);

	

	$sql_get_comments ="SELECT * FROM comments INNER JOIN items ON comments.id_item = items.id WHERE items.id=".$var_id_of_item;
	$statement_comments =  $pdo->prepare($sql_get_comments);
	$statement_comments->execute(); 
	
	//print_r($items);

	$comments = $statement_comments->fetchAll(PDO::FETCH_ASSOC);
	

	?>

	
	<?php foreach($posts as $post): ?>
	<h3> <?= $post['name']; ?> </h3>
	<?php
	 $name = $post['name'];
	 //$color = $post["default_color"];
	 ?>
	
	<?php endforeach; ?>
	
	<br>
	<?php foreach($current_photo as $item_current_photo): ?>
	
	<img  src="images/<?= $item_current_photo["photo"];?>" class="photo_item_pro" >
	<?php endforeach; ?>
	<?php foreach($photos as $photo): ?>
	
	<a href="item.php?id=<?=$photo['item_id']?>&color=<?=$photo['name'] ?>"><img  src="images/<?= $photo["photo"];?>" width="50" height="50" ></a>
	<?php endforeach; ?>

	<?php foreach($posts as $post): ?>
	<b><p><?= $post['price']; ?> РУБ</p></b>	
	<h2> <?= $post['description']; ?> </h2>
	<?php $post_id_selected = $post['id']; ?>

	<div>
	
	</div>

	
	<a  class="link_buy"  href="add_item.php?id=<?=$post['id']?>&color=<?=$color?>">Купить</a>
	<br>

	
	<?php endforeach; ?>
	<br>
	<button id="review_button" class="button_misstais" >Оставить отзыв</button>
	<div class="review_div" id = "review_div" >
	<form method="POST" action="send_comment.php?id=<?=$_GET['id']?>" name="form_create_comment" >
	<br>	
	<textarea  name="item_comment" class="item_box" id="textarea_comment"  placeholder="Ваш отзыв" onclick="if (event.keyCode == 13) document.search.submit();"></textarea>
	<br>
	<input type="submit" value="Отправить"  class="button_misstais_send" class="image_logo" >
	
	</form>
	</div>
	<?php foreach($comments as $comment): ?>
	<b><p><?= $comment['name_of_user']; ?> </p></b>	
	<h4> <?= $comment['text']; ?> </h4>

	<?php endforeach; ?>

	<script src="scripts/clear_rows.js"></script>
	<script text="javascript">
		var  review_button = document.getElementById("review_button");
		var  review_div = document.getElementById("review_div");
		console.log("review_div");
		console.log("review_button");

 		review_button.onclick = function (){
 		 	review_div.classList.toggle("open");
 		}

	</script>	
</body>
</html>
