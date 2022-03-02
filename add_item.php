<?php 
//add item function , firtstly determine user 
$add_item  = $_GET['id'];
$current_user = $_COOKIE["user"];	
echo "id".$add_item."name:".$current_user;

$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop" , "mikael" , "elkin");
$huruf= $pdo->query("SET NAMES 'utf8'");
$huruf2= $pdo->query("SET CHARACTER SET 'utf8'");
$huruf3= $pdo->query("SET SESSION collation_connection = 'utf8_general_ci'");
$sql ="SELECT * FROM orders WHERE id_of_good = :id AND name_of_user = :name_of_user ";
$statement =  $pdo->prepare($sql);
$statement->bindParam(":id" , $add_item);
	$statement->bindParam(":name_of_user" , $current_user);
	
$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_ASSOC);

//if there is item  in db , add +1 to quantity column
if(!empty($result)){
	$quantity = $result['quantity'];
	$quantity = $quantity+1;
	echo "there is";
	$sql ="UPDATE `orders` SET`quantity`=:quantity WHERE name_of_user = :name_of_user AND id_of_good = :id_of_good";
$statement_update =  $pdo->prepare($sql);
$statement_update->bindParam(":quantity" , $quantity);
$statement_update->bindParam(":name_of_user" , $current_user);
$statement_update->bindParam(":id_of_good" , $add_item);	
$statement_update->execute();
}
else{
	echo "there isn't";
}
print_r($result)
?>