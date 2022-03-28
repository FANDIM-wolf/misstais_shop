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
	$goods_exist = false;
	
	//print_r($items);

	
	
	$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	// check is cart empty
	if(sizeof($posts) == 0){
		$goods_exist = false;
	}
	else{
		$goods_exist = true;
	}
	//print_r($items);


	?>
	<?php foreach ($posts as $item): ?>  
	 <?php $cart = 2 * $item['price']; 
	 	//echo $cart;
	 ?>
	
  	<h3><?= $item['name']. " item" ?></h3>
	<h4>Количество:<?= $item['quantity']  ?></h4>
	<h4>Цвет:<?= $item['color']  ?></h4>
	<h4>Цена:<?= $item['price']  * $item['quantity']?></h4>
	
	<a href="add_item.php?id=<?=$item['id']?>&color=<?=$item['color']?>"><img src="images/add.png"></a>
	<a href="remove_item.php?id=<?=$item['id']?>&color=<?=$item['color']?>"><img src="images/minus.png"></a>
	<a href="delete_item.php?id=<?=$item['id']?>&color=<?=$item['color']?>"><img src="images/x-mark.png"></a>
 <?php endforeach; ?>
  <?php if($goods_exist == true){ ?>
			<a class="link_buy" href="payment_pay.php">Оплатить</a>
  <?php } ?>

  <?php if($goods_exist == false){ ?>
			<p>Корзина пуста .</p>
  <?php } ?>
</body>
</html>
