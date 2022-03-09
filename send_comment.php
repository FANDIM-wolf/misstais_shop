<?php

$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop" , "mikael" , "elkin");
$huruf= $pdo->query("SET NAMES 'utf8'");
$huruf2= $pdo->query("SET CHARACTER SET 'utf8'");
$huruf3= $pdo->query("SET SESSION collation_connection = 'utf8_general_ci'");

$sql_add_comment = "INSERT INTO `comments`( `id_item`, `name_of_user`, `text`) VALUES (:id_item,:name_of_user,:text_of_comment)";
		$statement_add_comment = $pdo->prepare($sql_add_comment);
		$statement_add_comment->bindParam(":id_item" , $_GET["id"]);
		$statement_add_comment->bindParam(":name_of_user" , $_COOKIE["user"]);
		$statement_add_comment->bindParam(":text_of_comment" , $_POST["item_comment"]);

		$statement_add_comment->execute();
    header("Location:".$_SERVER['HTTP_REFERER']);