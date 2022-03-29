<?php

require "sql_db.php";

$add_item  = $_GET['id'];
$current_user = $_COOKIE["user"];
$color = $_GET["color"];
$size = $_GET["size"];
echo "Item:".$item;
echo "Color:".$color;
echo "User:".$current_user;
$process_finished = false;

$sql_delete ="DELETE FROM `orders` WHERE id_of_good =:id_of_good AND name_of_user = :name_of_user AND color = :color AND size = :size";
		$statement_delete =  $pdo->prepare($sql_delete);

		$statement_delete->execute([':name_of_user' => $current_user ,  'id_of_good' => $add_item , 'color' => $color , 'size' => $size]);
		$process_finished = true;
		if($process_finished == true){
			header("Location:/misstais_shop/cart.php");
		}