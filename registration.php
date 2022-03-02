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
	<h2>Регистрация</h2>
	<form method="POST">
	<input type="text" name="login_name" placeholder="Имя"><br>
	<input type="email" name="email" placeholder="Электронная Почта"><br>
	<input type="password" name="password" placeholder="Пароль"><br>
	<input type="password" name="repassword" placeholder="Введите повторно"><br>
	<input type="submit" >
</form>

<?php

if($_POST['repassword'] == $_POST['password']){
	$name = $_POST['login_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$address = " ";
$postcode = " ";
$phone = " " ;
$image = " ";	
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
	$statement->execute();
	
	
	if ($_COOKIE["user"] != " "){
		$_COOKIE["user"] = " ";
		//set cookie
		$cookie_name = "user";
		$cookie_value = $name;
		setcookie($cookie_name, $cookie_value, time() + (31104000 * 30), ); // 86400 = 1 day

	}
	
}
else{

echo "create personal account";
	

}




?>

</body>
</html>

