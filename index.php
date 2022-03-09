<?php header('Content-Type: text/html; charset=utf-8');?>


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
<style type="text/css">
.wrapper {
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

a{
	font-family: 'Montserrat', sans-serif;
	text-decoration: none;
	color:black;
}





.item_box{
	/*width: 300px;
	height: 25px;
	border-radius: 8px;
	border-color: black;

	*/
	border:none;
	width: 300px;
	height:25px;

}
.elements{
	width:400px;
  height:35px;
  border: solid black 1px;
  border-radius:8px;
}
.elements:hover{
	width:400px;
  height:35px;
  border: solid black 1px;
  border-radius:8px;

}
body{
	
	font-family: 'Montserrat', sans-serif;
}



.photo_item{
	width: 250px;
	height: 250px;

}
.photo_item_pro{
	width: 350px;
	height: 350px;
}
.description{
	max-width: 700px;
	display: flex;
	font-size: 25px;
	font-family: 'Montserrat', sans-serif;

}
.head_goods{
display: grid; /*располагаем блоки в ряд по горизонтали*/
grid-template-columns: 400px 400px 400px;
margin-left: 10%;
/*убираем правый отступ между блоками*/
	
}
.image_logo{
	width:20px;
	height:20px;
	
}
.image_logo:hover{
	width:20px;
	height:20px;

}
.photo_panel{
	width:20px;
	height:20px;
}

.slide_image{
	border-radius: 15px;
}

/* Слайдер */
.slider{
    max-width: 70%;
    position: relative;
    margin: auto;
    height: 300px;
	margin-top:3%;
	margin-left:10%;
	
}
/* Картинка масштабируется по отношению к родительскому элементу */
.slider .item img {
    object-fit: cover;
    width: 100%;
    height: 350px;
}
/* Кнопки вперед и назад */
.slider .previous, .slider .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    margin-top: 22px;
    padding: 16px;
    color: white;
    font-weight: bold;
    font-size: 16px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
}
.slider .next {
    right: 0;
    border-radius: 3px 0 0 3px;
}
/* При наведении на кнопки добавляем фон кнопок */
.slider .previous:hover,
.slider .next:hover {
    background-color: rgba(0, 0, 0, 0.2);
}
/* Анимация слайдов */
.slider .item {
    animation-name: fade;
    animation-duration: 1.5s;
}
@keyframes fade {
    from {
        opacity: 0.4
    }
    to {
        opacity: 1
    }
}

</style>
<body>


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
    	<?php echo $_COOKIE["user"] ?>
	<?php } ?>
	<?php if(isset($_COOKIE["user"]) == false || $_COOKIE["user"] == " "){?>
		<a  href="registration.php">Sign up</a>
	<?php } ?>

	<a href="cart.php"><img class="photo_panel" src="files_for_front/shopping-cart.png"></a>
	<a href="user.php"><img class="photo_panel" src="files_for_front/user.png"></a>
	<a href="cart.php"><img class="photo_panel" src="files_for_front/heart.png"></a>
</div>
</div>
	



	
	
	<!-- Основной блок слайдера -->
<div class="slider">
  
  <!-- Первый слайд -->
  <div class="item">
	  <img src="files_for_front/image1.png" class="slide_image" >
	 
  </div>

  <!-- Второй слайд -->
  <div class="item">
	  <img src="https://s3.tproger.ru/uploads/2020/07/rose.jpg" class="slide_image">
  </div>

  <!-- Третий слайд -->
  <div class="item">
	  <img src="https://s3.tproger.ru/uploads/2020/07/leaf.jpg" class="slide_image">
  </div>

  <!-- Кнопки-стрелочки -->
  <a class="previous" onclick="previousSlide()">&#10094;</a>
  <a class="next" onclick="nextSlide()">&#10095;</a>
</div>
<br>
	<?php 
	
	
	$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop" , "mikael" , "elkin");
	$huruf= $pdo->query("SET NAMES 'utf8'");
	$huruf2= $pdo->query("SET CHARACTER SET 'utf8'");
	$huruf3= $pdo->query("SET SESSION collation_connection = 'utf8_general_ci'");
	$sql ="SELECT  * FROM items WHERE price > 200 ";
	$statement =  $pdo->prepare($sql);
	$statement->execute(); 

	

	
	
	$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
	?>

	<br>
	<div class="head_goods"> 
	
	<?php foreach($posts as $post): ?>
	<div>
	<h3> <?= $post['name']; ?> </h3>
	<a href="item.php?id=<?=$post['id']?>"><img src="images/<?=$post['image']; ?>" class="photo_item" ></a>
	<a href="add_item.php?id=<?=$post['id']?>">Купить</a>
	</div>
	<?php endforeach; ?>
	
</div>
	<script src="scripts/slider.js"></script>
</body>
</html>
