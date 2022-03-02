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
<a href="registration.php">Sign up</a>
<body>
	<form method="GET">
	<input type="text" name="item_name" placeholder="Введите названия продукта">
	<input type="submit" >
	</form>
	<?php if($_COOKIE["user"] != " "){ ?>
    	<?php echo $_COOKIE["user"] ?>
	<?php } ?>
	<?php if(isset($_COOKIE["user"]) == false){?>
		 <p>login</p>
	<?php } ?>	
	<?php 
	
	
	$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop" , "mikael" , "elkin");
	$huruf= $pdo->query("SET NAMES 'utf8'");
	$huruf2= $pdo->query("SET CHARACTER SET 'utf8'");
	$huruf3= $pdo->query("SET SESSION collation_connection = 'utf8_general_ci'");
	$sql ="SELECT * FROM items";
	$statement =  $pdo->prepare($sql);
	$statement->execute(); 

	$name_of_item = $_GET['item_name'];
	echo $name_of_item;
	if(!empty($_GET['item_name'])){
   	$items = find_item_by_title($pdo , $name_of_item);
	//print_r($items);

	}

	
	
	$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
	?>
	<?php foreach ($items as $item): ?>  
  	<p><?= $item['name']. " item" ?></p>
	<a href="item.php?id=<?=$item['id']?>"><img src="images/<?=$item['image']; ?>" class="photo_item" ></a>
 <?php endforeach; ?>

	<?php foreach($posts as $post): ?>
	<h3> <?= $post['name']; ?> </h3>
	<a href="item.php?id=<?=$post['id']?>"><img src="images/<?=$post['image']; ?>" class="photo_item" ></a>

	<?php endforeach; ?>

</body>
</html>
