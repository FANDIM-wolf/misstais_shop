<!DOCTYPE html>
<html>
<head>
	<title>Misstais</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat:wght@200;300&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
<style type="text/css">
	main{
		margin-left: 40%;
	}
</style>	
<main>	
	<h2>Регистрация</h2>
	<form method="POST">
	<input type="text"  class="inputbox" name="login_name" placeholder="Имя"><br>
	<input type="email"  class="inputbox"name="email" placeholder="Электронная Почта"><br>
	<input type="password"  class="inputbox"name="password" placeholder="Пароль"><br>
	<input type="password"  class="inputbox"name="repassword" placeholder="Введите повторно"><br>
	<input type="submit" value="Создать аккаунт" class="button_misstais" >
</form>

<?php
ini_set('display_errors',0);
require 'sql_db.php';

if($_POST['repassword'] == $_POST['password']){
	$name = $_POST['login_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$address = " ";
$postcode = " ";
$phone = " " ;
$image = " ";

//find user and check for existing . if true warn user
$sql ="SELECT  * FROM users WHERE login_name = :login_name AND password =:password ";
	$statement_find_user =  $pdo->prepare($sql);
	$statement_find_user->bindParam(":login_name" , $name);
	$statement_find_user->bindParam(":password" , $password);
	$statement_find_user->execute();


	$fetch = $statement_find_user->fetch(PDO::FETCH_ASSOC);
	print_r($fetch);
	

/* if was found nothing in database */
if($fetch == NULL){	
$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop; charset=utf8" , "mikael" , "elkin");
	$sql ="INSERT INTO users (login_name, address,email ,postcode,phone , image  ,password) VALUES(:login_name , :address ,:email , :postcode , :phone , :image ,:password)";
	$statement =  $pdo->prepare($sql);
	$statement->bindParam(":login_name" , $name);
	$statement->bindParam(":address" , $address);
	$statement->bindParam(":email" , $email);
	$statement->bindParam(":postcode" , $postcode);
	$statement->bindParam(":phone" , $phone);
	$statement->bindParam(":image" , $image);
	$statement->bindParam(":password" , $password);
	
	
	if($statement->execute() == true){
		header("Location:/misstais_shop/");
	}
	
		$_COOKIE["user"] = " ";
		//set cookie
		$cookie_name = "user";
		$cookie_value = $name;
		setcookie($cookie_name, $cookie_value, time() + (31104000 * 30), ); // 86400 = 1 day
		//header("Location:/misstais_shop/");
		
	
}
else{

	echo "<p>Пользователь уже  существует!</p>";
}

	
}
else{

echo "Пароли не совподают";
	

}




?>
</main>
</body>
</html>

