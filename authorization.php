<?php

?>
<html>
<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat:wght@200;300&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<meta charset="UTF-8">
</head>
<body>
<h2>Авторизация</h2>
	<form method="GET">
	<input type="text" name="login_name" placeholder="Имя"><br>
	<input type="password" name="password" placeholder="Пароль"><br>
	<input type="submit" >
</form>
<?php
$login_name = $_GET['login_name'];
$password=$_GET['password'];



$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop; charset=utf8" , "mikael" , "elkin");
$huruf= $pdo->query("SET NAMES 'utf8'");
	$huruf2= $pdo->query("SET CHARACTER SET 'utf8'");
	$huruf3= $pdo->query("SET SESSION collation_connection = 'utf8_general_ci'");
if($_GET['login_name'] != " " ){
	$sql ="SELECT  * FROM users WHERE login_name = :login_name AND password =:password ";
	$statement =  $pdo->prepare($sql);
	$statement->bindParam(":login_name", $login_name);
	$statement->bindParam(":password", $password);
	$statement->execute();

	$fetch = $statement->fetch();
	print_r($fetch);
	$name = $fetch['login_name'];
		
	//set cookie
	$cookie_name = "user";
	$cookie_value = $name;
	setcookie($cookie_name, $cookie_value, time() + (31104000 * 30), ); // 86400 = 1 day	

}		

	
?>

<?php 
if($_COOKIE["user"] != " " ){
 ?>
 	<h3>Вы успешно авторизировались</h3> 
 	<a href="/misstais_shop" > Перейти на главную </a>
 <?php } ?>

</body>
</html>