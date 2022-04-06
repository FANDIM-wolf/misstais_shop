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
<main>	
<style type="text/css">
	a{
  font-family: 'Montserrat', sans-serif;
  text-decoration: none;
  color: black;
}
main{
	margin-left: 40%;
}
</style>
<h2>Авторизация</h2>
	<form method="GET">
	<input type="text" class="inputbox" name="login_name" id="login_input" placeholder="Имя"><br>
	<input type="password" class="inputbox" name="password" id="password_input" placeholder="Пароль"><br>
	<input type="submit"  value="Войти" class="button_misstais"  >
</form>
<?php
ini_set('display_errors',0);
$login_name = $_GET['login_name'];
$password=$_GET['password'];



$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop; charset=utf8" , "mikael" , "elkin");
$huruf= $pdo->query("SET NAMES 'utf8'");
	$huruf2= $pdo->query("SET CHARACTER SET 'utf8'");
	$huruf3= $pdo->query("SET SESSION collation_connection = 'utf8_general_ci'");


if($_GET['login_name'] != " " ){
	$sql ="SELECT * FROM users WHERE login_name = :name AND password = :password ";
	$statement =  $pdo->prepare($sql);
	$statement->bindParam(":name", $login_name);
	$statement->bindParam(":password", $password);
	

	$statement->execute();

		$fetch = $statement->fetch(PDO::FETCH_ASSOC);

	print_r($fetch);
	$name = $fetch['login_name'];
	if($name != ""){
		//set cookie
		$cookie_name = "user";
		$cookie_value = $name;
		setcookie($cookie_name, $cookie_value, time() + (31104000 * 30), ); // 86400 = 1 day
		//redirect 
		header("Location:/misstais_shop/");
		}
	else{
		
	}	
	
	
	
}		

	
?>



 
<a href="registration.php"  ><h3>Регистрация</h3> </a>
<script type="text/javascript">
	document.getElementById("login_input").value = "";
	document.getElementById("password_input").value = "";
</script>
</main>
</body>
</html>