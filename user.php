<!DOCTYPE html>
<html>
<head>
	 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat:wght@200;300&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<meta charset="UTF-8">
	<title>misstasis shop</title>
</head>
<body>

<?php 
if(isset($_COOKIE["user"]) == true && $_COOKIE["user"] != " "){
 ?>
 	<h3><?php echo $_COOKIE["user"]; ?></h3> 
 	<a href="log_out.php"  >Выйти</a>
 <?php } ?>

<?php 
if(isset($_COOKIE["user"]) == false || $_COOKIE["user"] == " "){
 ?>
 	<h3>Авторизируйтесь или зарегистрируйтесь пожалуйста</h3> 
 	<a href="registration.php" >Зарегистрироваться</a>
 	<a href="authorization.php" >Авторизироваться</a>
 	
 <?php } ?>



</body>
</html>

