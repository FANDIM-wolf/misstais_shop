<?php header('Content-Type: text/html; charset=utf-8');?>
<?php 
function find_item_by_title(PDO $pdo, string $keyword): array
{
    $pattern = '%' . $keyword . '%';

    $sql = 'SELECT *
        FROM items 
        WHERE name LIKE :pattern';

    $statement = $pdo->prepare($sql);
    $statement->execute([':pattern' => $pattern]);

    return  $statement->fetchAll(PDO::FETCH_ASSOC);
}
?>

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
		
	}
.box {
display: inline-block; /*располагаем блоки в ряд по горизонтали*/
/*убираем правый отступ между блоками*/
margin-right: 195px;
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



.list_of_post{
	margin-left: 10%;
	display: grid; /*располагаем блоки в ряд по горизонтали*/
	grid-template-columns: 400px 400px 400px 400px ;
	
/*убираем правый отступ между блоками*/
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
	width: 450px;
	height:40px;
	border-radius: 8px;
	border-color: red;
	border-width:1px
}
.elements:hover{
	width: 450px;
	height:40px;
	border-radius: 8px;

	border-width:1px
	color:red;
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
</style>
<body>


<div class="wrapper">
<div class="box" id="boxa">


	<a href="/misstais_shop" ><img    src="files_for_front/logo.png"></a>

</div>
<div class="box">

<form method="GET" action="search.php?id=<?=$_GET['item_name']?>">
<div class="elements">
	<input type="text" name="item_name" class="item_box"  placeholder="Введите названия продукта" onclick="if (event.keyCode == 13) document.search.submit();" >
	<input type="image" value="" src="files_for_front/loupe.png" class="image_logo" >
</div>		
</form>

</div>

<div class="box" id="boxs">
	<?php if($_COOKIE["user"] != " "){ ?>
    	<?php echo $_COOKIE["user"] ?><?php } ?>
	<?php if(isset($_COOKIE["user"]) == false){?>
		<a  href="registration.php">Sign up</a>
	<?php } ?>

	<a href="cart.php"><img  src="files_for_front/shopping-cart.png"></a>
	<a href="cart.php"><img  src="files_for_front/user.png"></a>
	<a href="cart.php"><img  src="files_for_front/heart.png"></a>
</div>
</div>


<?php 
	
	
	$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop" , "mikael" , "elkin");
	$huruf= $pdo->query("SET NAMES 'utf8'");
	$huruf2= $pdo->query("SET CHARACTER SET 'utf8'");
	$huruf3= $pdo->query("SET SESSION collation_connection = 'utf8_general_ci'");
	$sql ="SELECT  * FROM items WHERE price > 200 ";
	$statement =  $pdo->prepare($sql);
	$statement->execute(); 

	$name_of_item = $_GET['item_name'];
	//echo $name_of_item;
	if(!empty($_GET['item_name'])){
   	$items = find_item_by_title($pdo , $name_of_item);
	//print_r($items);

	}

	
	
	$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
	?>
	<div class="list_of_post">
	<?php foreach ($items as $item): ?> 
	<div>
  	<p><?= $item['name'] ?></p>
	<a href="item.php?id=<?=$item['id']?>&color=<?=$item['default_color']?>"><img src="images/<?=$item['image']; ?>" class="photo_item" ></a>
	<a  class="link_buy"  href="add_item.php?id=<?=$item['id']?>&color=<?=$item['default_color']?>">Купить</a>
	</div> 
<?php endforeach; ?>
</div>