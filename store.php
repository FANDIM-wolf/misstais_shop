<?php 
require 'post.php';
error_reporting(E_ALL);
function uploadImage($image){
	//get extension of the file
	$extension = pathinfo($image['name'] , PATHINFO_EXTENSION);
	$filename = uniqid().".".$extension; 
	//tmp_name  location of file in OS
	move_uploaded_file($image['tmp_name'], 'images/'.$filename);
	
	return $filename;
}

$filename = uploadImage($_FILES['image']);

echo $filename;


addPost($_POST['title'] , $_POST['description'] , $filename); 
header("Location:/misstais_shop");