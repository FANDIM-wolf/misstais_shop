<?php 

require "sql_db.php";

if($_POST["email_payment"] != " " && $_POST["phone_payment"] != " " && $_POST["town_payment"] != " "){
$process_finished = false ; 
$process2_finished = false;

$town = $_POST["town_payment"];
$street = $_POST["street_payment"];
$email = $_POST["email_payment"];
$flat = $_POST["flat_payment"];
$postcode = $_POST["postcode"];
$phone = $_POST["phone_payment"];

$current_user = $_COOKIE["user"];	

// add order in depatures
$sql_insert ="INSERT INTO `depatures`( `name`, `order_status`, `town` , `street` , `email` , `flat` , `postcode` , `phone` ) VALUES (:name,:order_status,:town ,:street , :email , :flat , :postcode ,:phone)";
$statement_insert =  $pdo->prepare($sql_insert);

$statement_insert->execute([':name' => $current_user , 'order_status' => 0 , "town"  => $town , "street" => $street , "email" => $email , "flat" => $flat , "postcode" => $postcode ,"phone" => $phone]   );

$process_finished = true;

$sql_update ="UPDATE orders_history SET paid_order =:paid_order  WHERE name_of_user = :name_of_user  " ;
$statement_update =  $pdo->prepare($sql_update);

$statement_update->execute([':name_of_user' => $current_user , ':paid_order' => 1 ]);


$sql_delete ="DELETE FROM `orders` WHERE name_of_user = :name_of_user";
		$statement_delete =  $pdo->prepare($sql_delete);

		$statement_delete->execute([':name_of_user' => $current_user ]);
		$process_finished = true;
		if($process_finished == true){
			header("Location:/misstais_shop/SUCCESS.php");
		}

$process2_finished = true;	

if($process_finished == true && $process2_finished == true){
			header("Location:/misstais_shop/SUCCESS.php");
		}

}
else{

	echo "Email:".$_POST["email_payment"];
}