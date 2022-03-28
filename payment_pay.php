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
<style type="text/css">
	.list_of_posts{
  margin-left: 10%;
}
	 .inputbox {

  width: 600px;
  height: 25px;
  margin-bottom: 30px;
  font-size: 16px;
  font-family: 'Montserrat', sans-serif;
}
 .inputbox input {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  border: 2px solid #000;
  outline: none;
  background: none;
  padding: 10px;
  border-radius: 10px;
  font-size: 1.2em;

}
 .inputbox:last-child {
  margin-bottom: 0;
}
 .inputbox span {
  position: absolute;
  top: 14px;
  left: 20px;
  font-size: 1em;
  transition: 0.6s;
  font-family: sans-serif;
}
 .inputbox input:focus ~ span,
 .inputbox input:valid ~ span {
  transform: translateX(-13px) translateY(-35px);
  font-size: 1em;
}
 
.class_button{
	background-color: pink;
	width: 400px;
	height: 40px;
	border-color:rgb(255,255,255);
	border-radius: 10px;
	color: snow;
	font-size: 20px;

}
.button_misstais{
  width: 20%;
  height: 35px;
  color: white;
  background-color:#998376;
  border-radius:4px;
  border-color:#998376;
  font-size: 18px;
}

</style>

<?php 

// first of all we need to find out current user and  get his goods

$current_user = $_COOKIE["user"];

echo $current_user;

//get all goods of user 


?>

<?php 
	
	$total_price = 0;
	$delivery  = 220;
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
	<div class="list_of_posts">
	<?php foreach ($posts as $item): ?>  
	<?php if($item['paid_order'] != 1){ ?>	
	 <?php $cart = 2 * $item['price']; 
	 	//echo $cart;
	 
	 	$total_price += $item['price'] * $item["quantity"];
	 ?>

  	<h3><?=  $item['name']. " item" ?></h3>
	<h4>Количество:<?= $item['quantity']  ?></h4>
	<h4>Цена:<?= $item['price']  * $item['quantity']?></h4>
	
	<a href="add_item.php?id=<?=$item['id']?>"><img src="images/add.png"></a>
	<a href="remove_item.php?id=<?=$item['id']?>"><img src="images/minus.png"></a>
	<a href="delete_item.php?id=<?=$item['id']?>&color=<?=$item['color']?>"><img src="images/x-mark.png"></a>
		<?php } ?>
	 <?php endforeach; ?>
	<br>
	<br>
	<h3>Доставка : <?php echo $delivery; ?>RUB </h3>
	<h3>Итого к оплате : <?php echo $total_price+$delivery; ?>RUB </h3>

	<form method="POST" action="pay_order.php">
		<p>Город</p>
		<input class="inputbox" type="text" placeholder="Город"  name="town_payment">
		<p>Улица</p>
		<input class="inputbox" type="text" placeholder="Улица"  name="street_payment">
		<p>Email , почта</p>
		<input class="inputbox" type="email" placeholder="Email , почта"   name="email_payment">
		<p>Квартира</p>
		<input class="inputbox" type="text" placeholder="Квартира"   name="flat_payment">
		<p>Номер телефона</p>
		<input class="inputbox" type="text" placeholder="Номер телефона"    name="phone_payment">
		<p>Почтовый код</p>
		<input class="inputbox"  type="text" placeholder="Почтовый код"   name="postcode"><br>
		<input value="Оплатить" class="button_misstais" type="submit" name="submit"> 
	</form>	
	</div>	
</body>
</html>