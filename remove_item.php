<<?php 
//remove item function , firtstly determine user
$process_finished = false ; 
$add_item  = $_GET['id'];
$current_user = $_COOKIE["user"];
$color = $_GET["color"];	
echo "id".$add_item."name:".$current_user;

$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop" , "mikael" , "elkin");
$huruf= $pdo->query("SET NAMES 'utf8'");
$huruf2= $pdo->query("SET CHARACTER SET 'utf8'");
$huruf3= $pdo->query("SET SESSION collation_connection = 'utf8_general_ci'");
$sql ="SELECT * FROM orders WHERE id_of_good = :id AND name_of_user = :name_of_user AND  color = :color ";
$statement =  $pdo->prepare($sql);
$statement->bindParam(":id" , $add_item);
	$statement->bindParam(":name_of_user" , $current_user);
	$statement->bindParam(":color" , $color);

$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_ASSOC);
 foreach ($result as $result) {
 	$result["quantity"];
 }
 

//if there is item  in db , add +1 to quantity column
if(!empty($result)){
	$quantity = $result["quantity"];
	$quantity = $quantity - 1;
	echo $quantity;
	if($quantity == 0){
		$sql_delete ="DELETE FROM `orders` WHERE id_of_good =:id_of_good AND name_of_user = :name_of_user AND color = :color";
		$statement_delete =  $pdo->prepare($sql_delete);

		$statement_delete->execute([':name_of_user' => $current_user ,  'id_of_good' => $add_item , 'color' => $color ]);
		$process_finished = true;
		if($process_finished == true){
			header("Location:/misstais_shop/cart.php");
		}
	}
	else{
		$sql_update ="UPDATE orders SET quantity =:quantity WHERE name_of_user = :name_of_user AND id_of_good = :id_of_good AND color = :color";
	
		$statement_update =  $pdo->prepare($sql_update);

		$statement_update->execute([':name_of_user' => $current_user , ':quantity' => $quantity , 'id_of_good' => $add_item ,'color' => $color  ]);
		$process_finished = true;
		if($process_finished == true){
			header("Location:/misstais_shop/cart.php");
		}
	}

}
else{
	echo "there isn't";
}
print_r($result)
?>