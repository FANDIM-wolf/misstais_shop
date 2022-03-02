<?php 

// add post with image
function addPost($title,$content,$filename){

	$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop" , "mikael" , "elkin");
	$sql ="INSERT INTO posts (title, description , image) VALUES(:title , :description , :image)";
	$statement =  $pdo->prepare($sql);
	$statement->bindParam(":title" , $title);
	$statement->bindParam(":description" , $content);
	$statement->bindParam(":image" , $filename);
	$statement->execute(); 
}