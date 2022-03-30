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
<style type="text/css">
main{
	margin-left: 10%;
}	
a{
	font-family: 'Montserrat', sans-serif;
	text-decoration: none;
	color:black;
}
.div_box{
	width: 300px;
	height: 200px;
	border:3px solid #000;
	border-radius: 20px;
	padding-top: 30px;
	padding-left: 20px;

	display: inline-block;
}

.round{
	width: 110px;
	height:110px;
	border-radius: 50%;
	background-color:white;
	border:3px solid #000;
	margin-right: 10px;
	padding-top: 25px;
	padding-left: 27px;
	
}
.inline { 
    display: inline-block; 
    margin:10px;
 
 		vertical-align: middle;
    }

    .data{
   margin-top: 100px; 	
  display: none;
}
.open{
  display: block;
}
.list_of_posts{
  margin-left: 10%;
}
.wrapper{
		margin-top: 10px;
		text-align: center; /*располагаем содержимое блока по центру*/
		margin-left:70px;
	}
.box {
display: inline-block; /*располагаем блоки в ряд по горизонтали*/
/*убираем правый отступ между блоками*/
margin-right: 230px;
font-weight: 400;
}
#boxs{
	margin-top:5px;
}

.item_box{
	/*width: 300px;
	height: 25px;
	border-radius: 8px;
	border-color: black;

	*/
	border: none;
	width: 300px;
	height:25px;

}
.item_box_textarea{
	/*width: 300px;
	height: 25px;
	border-radius: 8px;
	border-color: black;

	*/
	border: none;
	width: 300px;
	height:150px;

}

.item_box:hover{
	/*width: 300px;
	height: 25px;
	border-radius: 8px;
	border-color: black;

	*/
	border:none;
	width: 300px;
	height:25px;

}
</style>
<div class="wrapper">
<div class="box" id="boxa">


	<a href="/misstais_shop" ><img    src="files_for_front/logo.png"></a>

</div>
<div class="box">
	<form method="GET" action="search.php" name="search">
	<input type="text" name="item_name" class="item_box"  placeholder="Введите названия продукта" onclick="if (event.keyCode == 13) document.search.submit();">
	<input type="image" value="" src="files_for_front/loupe.png" class="image_logo" >
	
	</form>
</div>

<div class="box" id="boxs">
	<?php if($_COOKIE["user"] != " "){ ?>
    	
	<?php } ?>
	<?php if(isset($_COOKIE["user"]) == false || $_COOKIE["user"] == " "){?>
		<a  href="authorization.php">Sign in</a>
	<?php } ?>

	<a href="cart.php"><img class="photo_panel" src="files_for_front/shopping-cart.png"></a>
	<a href="user.php"><img class="photo_panel" src="files_for_front/user.png"></a>
	<a href="cart.php"><img class="photo_panel" src="files_for_front/heart.png"></a>
</div>
</div>
<main>
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
<?php 
require "sql_db.php";
$sql_get_all = "SELECT * FROM `depatures` WHERE `name` = :name ";
$user =  $_COOKIE["user"];
$statement_orders = $pdo->prepare($sql_get_all);
$statement_orders->execute([':name'=>$user]);
$orders = $statement_orders->fetchAll(PDO::FETCH_ASSOC);

?>
<br>
<br>
<div class="div_box" id="div_box_item">
	<div class="inline">
	<div class="round">
		<img src="images/group_1.png" width="80" height="80">
	</div>
	</div>
	<div class="inline"> 
	<div>	
	<h2>Заказы</h2>
	</div>
	</div>
	</div>
</div>


<div id="data" class="data">
	<h2>Мои Заказы :</h2>
	<?php foreach ($orders as $item): ?>  
	
	
  <h3>Имя:<?=  $item['name']?></h3>
  <p>Город:<?= $item['town']?></p>
	<p>Улица:<?= $item['street']?></p>
	<p>Почтовый код:<?= $item['postcode']?></p>			
	<?php if($item['order_status'] == 0) {?>
			<p>Заказ не доставлен</p>
	<?php }?>	
  <hr>

	<?php endforeach; ?>
</div>
</main>
<script type="text/javascript">
var  div_box = document.getElementById("div_box_item");
var div_data = document.getElementById("data");	

div_box.onclick = function (){
 		 	div_data.classList.toggle("open");
 		 	window.scrollTo(0, 400);
 		}

</script>
</body>
</html>

