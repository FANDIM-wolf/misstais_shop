<?php 
//add item function , firtstly determine user 

$process_finished = false ;
$add_item  = $_GET['id'];
$current_user = $_COOKIE["user"];	
$color = $_GET["color"];
$size = $_GET["size"];
echo "id".$add_item."name:".$current_user;
$zero =0;

$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop" , "mikael" , "elkin");
$huruf= $pdo->query("SET NAMES 'utf8'");
$huruf2= $pdo->query("SET CHARACTER SET 'utf8'");
$huruf3= $pdo->query("SET SESSION collation_connection = 'utf8_general_ci'");
$sql ="SELECT * FROM orders WHERE id_of_good = :id AND name_of_user = :name_of_user AND  color = :color AND size = :size ";
$statement =  $pdo->prepare($sql);
$statement->bindParam(":id" , $add_item);
	$statement->bindParam(":name_of_user" , $current_user);
	$statement->bindParam(":color" , $color);
	$statement->bindParam(":size",$size);
$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_ASSOC);
 foreach ($result as $result) {
 	$result["quantity"];
 }
 

//if there is item  in db , add +1 to quantity column
if(!empty($result)){
	$quantity = $result["quantity"];
	$quantity = $quantity + 1;
	echo $quantity;

	$sql_update ="UPDATE orders SET quantity =:quantity  WHERE name_of_user = :name_of_user AND id_of_good = :id_of_good AND color =:color AND size =:size" ;
$statement_update =  $pdo->prepare($sql_update);

$statement_update->execute([':name_of_user' => $current_user , ':quantity' => $quantity , ':id_of_good' => $add_item , ':color' => $color  , 'size' => $size]);
$sql_update_1 ="UPDATE orders_history SET quantity =:quantity  WHERE name_of_user = :name_of_user AND id_of_good = :id_of_good AND color =:color AND paid_order = :paid_order AND size =: size";
$statement_update_1 =  $pdo->prepare($sql_update_1);

$statement_update_1->execute([':name_of_user' => $current_user , ':quantity' => $quantity , 'id_of_good' => $add_item , 'color' => $color , 'paid_order'=> $zero , 'size' => $size]);
$process_finished = true;
	if($process_finished == true){
	header("Location:/misstais_shop/cart.php");
	}
}
else{

	$sql_update ="INSERT INTO `orders`( `name_of_user`, `id_of_good`, `quantity` , `color` , `size`) VALUES (:name_of_user,:id_of_good,1 ,:color ,:size)";
$statement_update =  $pdo->prepare($sql_update);

$statement_update->execute([':name_of_user' => $current_user , 'id_of_good' => $add_item , "color"  => $color , 'size' => $size] );
$sql_update_1 ="INSERT INTO `orders_history`( `name_of_user`, `id_of_good`, `quantity` , `color` , 	`size`) VALUES (:name_of_user,:id_of_good,1 ,:color , :size )";
$statement_update_1 =  $pdo->prepare($sql_update_1);

$statement_update_1->execute([':name_of_user' => $current_user , 'id_of_good' => $add_item , "color"  => $color , "size"=> $size] );
$process_finished = true;
	if($process_finished == true){
	header("Location:/misstais_shop/cart.php");
	}

	echo "there isn't";
}
print_r($result)
?>
