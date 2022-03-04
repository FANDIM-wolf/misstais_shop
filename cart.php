<!DOCTYPE html>
<html>
<head>
	<title>Misstais shop</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat:wght@200;300&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<meta charset="UTF-8">
</head>
<body>
<?php 

// first of all we need to find out current user and  get his goods

$current_user = $_COOKIE["user"];

echo $current_user;

//get all goods of user 


?>

<?php 
	

	
	$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop" , "mikael" , "elkin");
	$huruf= $pdo->query("SET NAMES 'utf8'");
	$huruf2= $pdo->query("SET CHARACTER SET 'utf8'");
	$huruf3= $pdo->query("SET SESSION collation_connection = 'utf8_general_ci'");
	$sql ="SELECT * FROM orders INNER JOIN items ON orders.id_of_good = items.id WHERE name_of_user = :name_of_user  ";
	$statement =  $pdo->prepare($sql);
	$statement->execute([':name_of_user' => $current_user]); 

	//print_r($items);

	

	
	
	$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
	?>
	<?php foreach ($posts as $item): ?>  
	 <?php $cart = 2 * $item['price']; 
	 	//echo $cart;
	 ?>

  	<h3><?= $item['name']. " item" ?></h3>
	<p>Количество:<?= $item['quantity']  ?></p>
	<p>Цена:<?= $item['price']  * $item['quantity']?></p>
	<a href="item.php?id=<?=$item['id']?>"><img src="images/<?=$item['image']; ?>" class="photo_item" ></a>
	<a href="add_item.php?id=<?=$item['id']?>">Добавить</a>
	<a href="remove_item.php?id=<?=$item['id']?>">Убрать</a>
 <?php endforeach; ?>


</body>
</html>
